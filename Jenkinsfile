def createNamespace (namespace) {
	echo "hhCreating namespace1 ${namespace}"
	sh "kubectl create ns ${namespace}"
}

def deleteNamespace (namespace) {
    	echo "Deleating namespace ${namespace} if needed"
    	sh "kubectl delete ns ${namespace} --ignore-not-found"
}

def deleteNamespaceContent (namespace) {
	sh "kubectl delete all --all -n ${namespace}"
}

/*
    Run a curl against a given url
 */
def curlRun (url, out) {
    echo "Running curl on ${url}"

    script {
        if (out.equals('')) {
            out = 'http_code'
        }
        echo "Getting ${out}"
            def result = sh (
                returnStdout: true,
                script: "curl --output /dev/null --silent --connect-timeout 5 --max-time 5 --retry 5 --retry-delay 5 --retry-max-time 30 --write-out \"%{${out}}\" ${url}"
        )
        echo "Result (${out}): ${result}"
    }
}

/*
    Test with a simple curl and check we get 200 back
 */
def curlTest (namespace, out) {
    echo "Running tests in ${namespace}"

    script {
        if (out.equals('')) {
            out = 'http_code'
        }

        // Get deployment's service IP
        def svc_port = sh (
                returnStdout: true,
                script: "kubectl get svc -n ${namespace}  | awk \'{print \$5}\' | grep -iPo \'(?<=:).*(?=/)\'"
        )

        if (svc_port.equals('')) {
            echo "ERROR: Getting service IP failed"
            sh 'exit 1'
        }

        echo "svc_port is ${svc_port}"
        url = clusterIP + ':' + svc_port
        curlRun (url, out)
    }
}




pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
		clusterURL = "https://172.17.0.3:8443"
		clusterIP = "172.17.0.3"
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
			steps{
				script{
					
					namespace = 'development'
					withKubeConfig([credentialsId: 'kubeconfig']) {
						sh "kubectl config view"
						deleteNamespaceContent (namespace)
						deleteNamespace (namespace)
						echo "Deploying application to ${namespace} namespace"
						createNamespace (namespace)
						sh "kubectl patch serviceaccount default -p \"{\\\"imagePullSecrets\\\": [{\\\"name\\\": \\\"dh-secret\\\"}]}\" --namespace ${namespace}"
						dir("k8s") {
							sh "kubectl apply -f  db.yaml --namespace ${namespace}"
							sh "kubectl apply -f  web.yaml --namespace ${namespace}"
						}
					}
				}
			}
		}
		stage('Dev tests') {
			steps{
				script{
					curlTest (namespace, 'http_code')
				}
			}
            		/*parallel {
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
            		}*/
        	}
	}
}
