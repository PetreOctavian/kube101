pipeline {

  agent { label 'jenslave' }

  stages {

    stage('Checkout Source') {
      steps {
        git url:'https://github.com/PetreOctavian/kube101.git', branch:'master'
      }
    }

    stage('Deploy App') {
      steps {
        script {
          kubernetesDeploy(configs: "core/a.yaml", kubeconfigId: "mykubeconfig")
        }
      }
    }

  }

}
