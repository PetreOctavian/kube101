pipeline {

  environment {
    registry = "petreocty1998/octav_rep"
    registryCredential = 'dockerhub'
    dockerImage = ""
    DEPLOY_PROD = false
  }

  parameters {
    string (name: 'GIT_BRANCH',           defaultValue: 'master',  description: 'Git branch to build')
    booleanParam (name: 'DEPLOY_TO_PROD', defaultValue: false,     description: 'If build and tests are good, proceed and deploy to production without manual approval')
   }

  agent any

  stages {
  	stage('Git clone and setup') {
      steps {
        git 'https://github.com/PetreOctavian/kube101.git'
        sh "kubectl cluster-info"
      }
    }

 

    stage('Push docker image') {
        agent {
          docker { image 'jenkinsci/jnlp-slave' }
        }
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
