pipeline {

  environment {
    registry = "petreocty1998/octav_rep"
    registryCredential = 'dockerhub'
  }

  agent any

  stages {
  	stage('Git clone and setup') {
      steps {
        git clone 'https://github.com/PetreOctavian/kube101.git'
        sh "kubectl cluster-info"
      }
    }

 
    stage('Push docker image') {
        agent { label 'slave-pod'}
        steps{
          script {
            def DB = docker.build("my-image:${env.BUILD_ID}","-f mysql/dockerfile .")
            def WEB = docker.build("my-image:${env.BUILD_ID}","-f apache/dockerfile .")
            docker.withRegistry( '', registryCredential ) {
              DB.push('dbster')
              WEB.push('webster')
            }
          }
        }
    }
}
