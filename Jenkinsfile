pipeline {

  environment {
    registry = "petreocty1998/octav_rep"
    registryCredential = 'dockerhub'
    dockerImage = ""
  }

  agent any

  stages {
  	stage('Clone repository') {
      steps {
        git 'https://github.com/PetreOctavian/kube101.git'
      }
    }
    stage('Initialize'){
      steps{
        def dockerHome = tool 'myDocker'
        env.PATH = "${dockerHome}/bin:${env.PATH}"
      }
    }
    stage('Build docker image') {
      steps {
        echo 'Starting to build docker image DB'
          script {
            def DB = docker.build("my-image:${env.BUILD_ID}","mysql")
            def WEB = docker.build("my-image:${env.BUILD_ID}","apache")          
          }
      }
    }
    stage('Push docker image') {
      steps{
        script {
        	docker.withRegistry( '', registryCredential ) {
        		DB.push('dbster')
            	WEB.push('webster')
        	}
        }
      }
    }
  }

}
