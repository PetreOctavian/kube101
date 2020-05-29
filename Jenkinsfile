pipeline {

  environment {
    registry = "petreocty1998/octav_rep"
    registryCredential = 'dockerhub'
  }

  agent any

  stages {
  	stage('Git clone and setup') {
      steps {
            git 'https://github.com/PetreOctavian/kube101.git'
      }
    }
    stage('Push docker image') {
        steps{
          script {
              echo "workspace directory is ${env.WORKSPACE}/mysql/dockerfile"
              echo "build URL is ${env.BUILD_URL}"
	      dir("mysql") {
       	      	def DB = docker.build("my-image:${env.BUILD_ID}","-f dockerfile .")
	      }
              dir("apache"){
              	def WEB = docker.build("my-image:${env.BUILD_ID}","-f dockerfile .")
	      }
              

              docker.withRegistry( '', registryCredential ) {
                DB.push('dbster')
                WEB.push('webster')
              }
          }
        }
    }
  }
}
