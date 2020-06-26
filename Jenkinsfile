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
						sh "kubectl apply -f  db_dev.yaml"
						sh "kubectl apply -f  web.yaml -n ${namespace}"
					}
					
				}
			}
		}

	}
}
