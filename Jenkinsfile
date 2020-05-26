pipeline{

	environment{
		registry = "petreocty1998/octav_rep"
		registryCredential = "dockerhub2"
		DEPLOY_PROD = false
	}
	
	parameters {
    		string (name: 'GIT_BRANCH',           defaultValue: 'master',  description: 'Git branch to build')
    		booleanParam (name: 'DEPLOY_TO_PROD', defaultValue: false,     description: 'If build and tests are good, proceed and deploy to production without manual approval')
   	}

	agent { label 'slave-pod' }

	stages{
		stage("stage0"){
			steps{
				git 'https://github.com/PetreOctavian/kube101.git'
				sh "kubectl cluster-info"
			}
		}
	}
	
}
