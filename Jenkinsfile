def createNamespace (namespace) {
    echo "Creating namespace ${namespace}"

    sh "[ ! -z \"\$(kubectl get ns ${namespace} -o name 2>/dev/null)\" ] || kubectl create ns ${namespace}"
}

def deleteNamespace (namespace) {
    echo "Deleating namespace ${namespace} if needed"

    sh "[ ! -z \"\$(kubectl get ns ${namespace} -o name 2>/dev/null)\" ] || kubectl delete ns ${namespace}"
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
              				
	      				/*dir("D_mysql") {
						DB = docker.build("${env.registry}:dbster")
	      				}
              				dir("D_apache"){
              					WEB = docker.build("${env.registry}:webster","-f dockerfile .")
	      				}*/
					WEB = docker.build("${env.registry}:webimage")
				}
			}
		}
		stage('Testing image'){
			steps{
				script{
					/*DB.inside {
            					sh 'echo "Tests DB passed"'
					}*/
					WEB.inside {
						sh 'ls /app/public'
					}
				}
			}	
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
                				//DB.push()
               					WEB.push()
              				}
				}
			}
		}
		stage('Deploy to dev'){
			steps{
				script{
					namespace = 'development'
                    			echo "Deploying application ${ID} to ${namespace} namespace"
                    			createNamespace (namespace)
					withKubeConfig([credentialsId: 'kubeconfig']) {
      						sh 'kubectl config view'
						dir("K8s") {
							sh 'kubectl apply -f  db.yaml --namespace ${namespace}'
							sh 'kubectl apply -f  web.yaml --namespace ${namespace}'
	      					}
    					}
				}
			}
		}
	}
}
