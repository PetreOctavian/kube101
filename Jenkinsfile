def prepareNamespace (namespace) {
	echo "Deleating namespace ${namespace} and it's content if needed"
	sh "kubectl delete all --all -n ${namespace} --ignore-not-found"
    	sh "kubectl delete ns ${namespace} --ignore-not-found"
	echo "Creating namespace ${namespace}"
	sh "kubectl create ns ${namespace}"
	//sh "kubectl apply -f pullsecret.yaml -n ${namespace}"
	//sh "kubectl patch serviceaccount default -p \"{\\\"imagePullSecrets\\\": [{\\\"name\\\": \\\"dh-secret\\\"}]}\" -n ${namespace}"
}

def clearNamespace (namespace) {
    echo "Deleating namespace ${namespace}"
	sh "kubectl delete all --all -n ${namespace} --ignore-not-found"
    sh "kubectl delete ns ${namespace} --ignore-not-found"
}

def curlRun (url, out) {
    echo "Running curl on ${url}"

    script {
        if (out.equals('')) {
            out = 'http_code'
        }
        echo "Getting ${out}"
            def result = sh (
                returnStdout: true,
                script: "curl --output /dev/null --silent --connect-timeout 5 --max-time 5 --retry 5 --retry-delay 5 --retry-max-time 30 --write-out \'%{${out}}\' ${url}"
        )
        echo "Result (${out}): ${result}"
    }
}

def curlTest (namespace, out) {
    echo "Running tests in ${namespace}"

    script {
        if (out.equals('')) {
            out = 'http_code'
        }
        def svc_IP = sh (
                returnStdout: true,
		script: "kubectl get svc -n ${namespace} | grep web | awk \'{print \$3}\'"
        )

        if (svc_IP.equals('')) {
            echo "ERROR: Getting service IP failed"
            sh 'exit 1'
        }

        echo "svc_port is ${svc_IP}"
	url = svc_IP
        curlRun (url, out)
    }
}


pipeline {

	environment {
    		registry = "petreoctav/licenta"
    		registryCredential = 'dockerhub'
    		//workspace = env.WORKSPACE
  	}

  	parameters {
        	string (name: 'GIT_BRANCH',           defaultValue: 'master',  description: 'Git branch to build')
        	booleanParam (name: 'DEPLOY_TO_PROD', defaultValue: false,     description: 'If build and tests are good on dev and reprod stages, proceed and deploy to production without manual approval')
    	}

  	agent any

  	stages {
		stage('Cloning our Git') {
      			steps {
            			git 'https://github.com/PetreOctavian/kube101.git'
      			}
    		}
    		stage('Building images') {
        		steps{
          			script {
					WEB = docker.build("${env.registry}:webimageBN${env.BUILD_NUMBER}")
					DB = docker.build("${env.registry}:dbimageBN${env.BUILD_NUMBER}","./dockerfile_aux/db")
				}
			}
		}
		stage('Testing images'){
			steps{
				script{
					WEB.inside {
						sh "ls /app/public"
					}
					DB.inside {
						sh "ls /docker-entrypoint-initdb.d"
						
					}
				}
			}	
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
               					WEB.push()
               					DB.push()
              				}
					sh "sleep 45"
				}
			}
		}
		stage('Deploy to dev'){
			steps{
				script{
					namespace = 'dev'
					withKubeConfig([credentialsId: 'kubeconfig']) {
						prepareNamespace (namespace)
						sh "kubectl apply -f  db.yaml -n ${namespace}"
						sh "kubect set image deployments/db-deployment petreoctav/licenta:dbimage=petreoctav/licenta:dbimageBN${env.BUILD_NUMBER} -n ${namespace}"
						sh "kubectl apply -f  web.yaml -n ${namespace}"
						sh "kubect set image deployments/web-deployment petreoctav/licenta:webimage=petreoctav/licenta:webimageBN${env.BUILD_NUMBER} -n ${namespace}"
					}
					sh "sleep 60"
				}
			}
		}
		stage('Dev tests') {
			parallel {
             			stage('Curl http_code') {
                    			steps {
                        			curlTest (namespace, 'http_code')
                    			}
                		}
                		stage('Curl total_time') {
                    			steps {
                        			curlTest (namespace, 'time_total')
                    			}
                		}
                		stage('Curl size_download') {
                    			steps {
                        			curlTest (namespace, 'size_download')
                    			}
                		}
			}
            	}
        	stage('Cleanup dev') {
            		steps {
                		script {
                    			withKubeConfig([credentialsId: 'kubeconfig']) {
											clearNamespace(namespace)
					}
                		}
			}
		}
		stage('Deploy to preprod'){
			steps{
				script{
					namespace = 'preprod'
					withKubeConfig([credentialsId: 'kubeconfig']) {
						prepareNamespace (namespace)
						sh "kubectl apply -f  db.yaml -n ${namespace}"
						sh "kubectl apply -f  web.yaml -n ${namespace}"
					}
					sh "sleep 60"
				}
			}
		}
		stage('Preprod tests') {
			parallel {
                		stage('Curl http_code') {
                    			steps {
                        			curlTest (namespace, 'http_code')
                    			}
                		}
                		stage('Curl total_time') {
                    			steps {
                        			curlTest (namespace, 'time_total')
                    			}
                		}
                		stage('Curl size_download') {
                    			steps {
                        			curlTest (namespace, 'size_download')
                    			}
                		}
            		}
        	}
        	stage('Cleanup preprod') {
            		steps {
                		script {
                    			withKubeConfig([credentialsId: 'kubeconfig']) {
											clearNamespace(namespace)
					}
                		}
            		}
        	}
		stage('Go for Production?') {
            		when {
                		allOf {
					environment name: 'GIT_BRANCH', value: 'master'
                    			environment name: 'DEPLOY_TO_PROD', value: 'false'
                		}
            		}
            		steps {
				// Prevent any older builds from deploying to production
				milestone(1)
				input 'Proceed and deploy to Production?'
				milestone(2)
                		script {
                    				DEPLOY_PROD = true
                			}
            		}
        	}
        	stage('Deploy to prod'){
        		when {
                		anyOf {
					expression { DEPLOY_PROD == true }
				    	environment name: 'DEPLOY_TO_PROD', value: 'true'
                		}
            		}
			steps{
				script{
					DEPLOY_PROD = true
					namespace = 'prod'
					withKubeConfig([credentialsId: 'kubeconfig']) {
						prepareNamespace (namespace)
						sh "kubectl apply -f  db.yaml -n ${namespace}"
						sh "kubectl apply -f  web.yaml -n ${namespace}"
					}
					sh "sleep 60"
				}
			}
		}
		stage('Prod tests') {
			when {
                		expression { DEPLOY_PROD == true }
            		}
			parallel {
             			stage('Curl http_code') {
                    			steps {
                        			curlTest (namespace, 'http_code')
                    			}
                		}
                		stage('Curl total_time') {
                    			steps {
                        			curlTest (namespace, 'time_total')
                    			}
                		}
                		stage('Curl size_download') {
                    			steps {
                        			curlTest (namespace, 'size_download')
                    			}
                		}
            		}
		}
	}
}
