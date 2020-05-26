pipeline{

	enviroment{
		registry = "petreocty1998/octav_rep"
		registryCredential = "dockerhub"
	}

	agent any

	stages{

		stage("stage0"){
			git 'https://github.com/PetreOctavian/kube101.git'
		}
	}
}
