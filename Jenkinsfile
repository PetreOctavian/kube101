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
          agent { label 'docker' }
          script {
              echo "workspace directory is ${env.WORKSPACE}/mysql/dockerfile"
              echo "build URL is ${env.BUILD_URL}"
              docker.withRegistry( 'https://hub.docker.com/repository/docker/petreocty1998/octav_rep', registryCredential ) {
              def DB = docker.build("my-image:${env.BUILD_ID}","-f ${env.WORKSPACE}/mysql/dockerfile .")
              def WEB = docker.build("my-image:${env.BUILD_ID}","-f ${env.WORKSPACE}/apache/dockerfile .")
              DB.push('dbster')
              WEB.push('webster')
              }
          }
        }
    }
  }
}
