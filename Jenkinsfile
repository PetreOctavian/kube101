def prepareNamespace (namespace) {
	echo "Deleating namespace ${namespace} and it's content if needed"
	sh "kubectl delete all --all -n ${namespace} --ignore-not-found"
    	sh "kubectl delete ns ${namespace} --ignore-not-found"
	echo "Creating namespace ${namespace}"
	sh "kubectl create ns ${namespace}"
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

        // Get deployment's service IP
        def svc_IP = sh (
                returnStdout: true,
                //script: "kubectl get svc -n ${namespace}  | awk \'{print \$5}\' | grep -iPo \'(?<=:).*(?=/)\'"
		script: "kubectl get svc -n ${namespace} | grep web | awk \'{print \$3}\'"
        )

        if (svc_IP.equals('')) {
            echo "ERROR: Getting service IP failed"
            sh 'exit 1'
        }

        echo "svc_port is ${svc_IP}"
        //url = clusterIP + ':' + svc_port
	//url = 'http://' + svc_IP
	url = svc_IP
        curlRun (url, out)
    }
}


pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
  	}

  	agent any

  	stages {
		stage('Cloning our Git') {
      			steps {
            			git 'https://github.com/PetreOctavian/kube101.git'
      			}
    		}
    		stage('Building image') {
        		steps{
          			script {
					WEB = docker.build("${env.registry}:webimage")
				}
			}
		}
		stage('Testing image'){
			steps{
				script{
					WEB.inside {
						sh "ls /app/public"
					}
				}
			}	
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
               					WEB.push()
              				}
				}
			}
		}
		stage('Deploy to dev'){
			//agent { label slave }
			steps{
				script{
					withKubeConfig([credentialsId: 'kubeconfig']) {
						namespace = 'dev'
						prepareNamespace (namespace)
						//sh "kubectl apply -f  db_dev.yaml"
						dir("k8s") {
							sh "kubectl apply -f  db_dev.yaml"
							//sh "kubectl apply -f  web.yaml"
						}
						sh "kubectl apply -f  web.yaml -n ${namespace}"
					}
					sh "sleep 60"
					
				}
			}
		}
		stage('Dev tests') {
			parallel {
                		stage('Curl http_code') {
                    			steps {
						//sh "sleep 10"
                        			curlTest (namespace, 'http_code')
                    			}
                		}
                		stage('Curl total_time') {
                    			steps {
						//sh "sleep 10"
                        			curlTest (namespace, 'time_total')
                    			}
                		}
                		stage('Curl size_download') {
                    			steps {
						//sh "sleep 10"
                        			curlTest (namespace, 'size_download')
                    			}
                		}
            		}
        	}

	}
}
