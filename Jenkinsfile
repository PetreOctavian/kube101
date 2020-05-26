pipeline{

	environment{
		registry = "petreocty1998/octav_rep"
		registryCredential = "dockerhub"
	}

	agent any

	stages{
		stage("stage0"){
			steps{
				git 'https://github.com/PetreOctavian/kube101.git'
			}
		}
	}
	
}
