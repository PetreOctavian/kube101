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


}
