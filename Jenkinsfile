pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
		DB = ''
		WEB = ''
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
						DB = docker.build("${env.registry}:${env.BUILD_ID}","-f ./dockerfile .")
	      				}
              				dir("apache"){
              					WEB = docker.build("${env.registry}:${env.BUILD_ID}","-f ./dockerfile .")
	      				}
				}
			}
		}
		stage('Testing image'){
			DB.inside {
            			sh 'echo "Tests DB passed"'
        		}
			WEB.inside {
            			sh 'echo "Tests WEB passed"'
        		}
			
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
                				DB.push('dbster')
               					WEB.push('webster')
              				}
				}
			}
		}
		stage('Deploying to K8s'){
			withKubeConfig([credentialsID:kubeconfig]){
				sh 'kubectl get pod'
			}	
		}
	}
              
}

