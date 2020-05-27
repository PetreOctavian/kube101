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
              echo "workspace directory is ${env.WORKSPACE}"
              echo "build URL is ${env.BUILD_URL}"
              docker.withRegistry( 'https://registry.hub.docker.com/', registryCredential ) {
              def DB = docker.build("my-image:${env.BUILD_ID}","-f mysql/dockerfile .")
              def WEB = docker.build("my-image:${env.BUILD_ID}","-f apache/dockerfile .")
              DB.push('dbster')
              WEB.push('webster')
              }
          }
        }
    }
  }
}
