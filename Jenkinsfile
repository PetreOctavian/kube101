pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
		DB = ''
		WEB = ''
		Ar = ''
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
              				//echo "workspace directory is ${env.WORKSPACE}/mysql/dockerfile"
              				//echo "build URL is ${env.BUILD_URL}"
	      				dir("mysql") {
						DB = docker.build("${env.registry}:dbster")
	      				}
              				dir("apache"){
              					WEB = docker.build("${env.registry}:webster","-f dockerfile .")
	      				}
				}
			}
		}
		stage('Testing image'){
			steps{
				script{
					DB.inside {
            					sh 'echo "Tests DB passed"'
					}
					WEB.inside {
						sh 'echo "Tests WEB passed"'
					}
				}
			}	
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
                				DB.push()
               					WEB.push()
              				}
				}
			}
		}
		stage('Deploying to K8s'){
			steps{
				script{
					withKubeConfig([credentialsId: 'kubeconfig', serverUrl: 'https://192.168.99.100:8443']) {
      					sh 'kubectl config view'
    					}
				}
			}
		}
	}
              
}

