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
              def DB = docker.build("my-image:${env.BUILD_ID}","-f ./mysql/dockerfile .")
              def WEB = docker.build("my-image:${env.BUILD_ID}","-f ./apache/dockerfile .")
              docker.withRegistry( '', registryCredential ) {
                DB.push('dbster')
                WEB.push('webster')
              }
          }
        }
    }
  }
}
