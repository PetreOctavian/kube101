pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
		DB = ''
		WEB = ''
		repoName = 'petreocty1998/octav_rep'
  	}

  	agent any

  	stages {
  		stage('Cloning our Git') {
      			steps {
            			git 'https://github.com/PetreOctavian/kube101.git'
      			}
    		}
    		stage('Building our image') {
        		steps{
          			script {
              				//echo "workspace directory is ${env.WORKSPACE}/mysql/dockerfile"
              				//echo "build URL is ${env.BUILD_URL}"
	      				dir("mysql") {
						DB = docker.build("${env.repoName}:${env.BUILD_ID}","-f ./dockerfile .")
	      				}
              				dir("apache"){
              					WEB = docker.build("${env.repoName}:${env.BUILD_ID}","-f ./dockerfile .")
	      				}
				}
			}
		}
		stage('Pushing our image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
                				DB.push('dbster')
               					WEB.push('webster')
              				}
				}
			}
		}
	}
              
}

