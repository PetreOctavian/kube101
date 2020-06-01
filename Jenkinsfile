def createNamespace (namespace) {
    echo "Creating namespace ${namespace}"

    sh "[ ! -z \"\$(kubectl get ns ${namespace} -o name 2>/dev/null)\" ] || kubectl create ns ${namespace}"
}

def deleteNamespace (namespace) {
    echo "Deleating namespace ${namespace} if needed"

    sh "[ ! -z \"\$(kubectl get ns ${namespace} -o name 2>/dev/null)\" ] || kubectl delete ns ${namespace}"
}

pipeline {

	environment {
    		registry = "petreocty1998/octav_rep"
    		registryCredential = 'dockerhub'
		DB = ''
		WEB = ''
		Ass = ''
  	}

  	agent any

  	stages {
  		stage('Cloning our Git') {
      			steps {
            			git 'https://github.com/PetreOctavian/kube101.git'
      			}
    		}
    		/*stage('Building image') {
        		steps{
          			script {
              				//echo "workspace directory is ${env.WORKSPACE}/mysql/dockerfile"
              				//echo "build URL is ${env.BUILD_URL}"
	      				dir("D_mysql") {
						DB = docker.build("${env.registry}:dbster")
	      				}
              				dir("D_apache"){
              					WEB = docker.build("${env.registry}:webster","-f dockerfile .")
	      				}
				}
			}
		}
		stage('Testing image'){
			steps{
				script{
					DB.inside {
            					sh 'echo "Tests DB passed"'
					}
					WEB.inside {
						sh 'echo "Tests WEB passed"'
					}
				}
			}	
		}
		stage('Pushing image'){
			steps{
				script{	
              				docker.withRegistry( '', registryCredential ) {
                				DB.push()
               					WEB.push()
              				}
				}
			}
		}*/
		stage('Prepare K8s'){
			steps{
				script{
					/*sh 'curl -LO https://storage.googleapis.com/kubernetes-release/release/`curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt`/bin/linux/amd64/kubectl' 
					sh 'chmod +x ./kubectl' 
					sh 'mv ./kubectl /usr/local/bin/kubectl'*/
					withKubeConfig([credentialsId: 'kubeconfig', serverUrl: 'https://192.168.99.100:8443']) {
      						sh 'kubectl config view'
						dir("K_support") {
							sh 'kubectl create -f  azure_secrets.yaml'
							sh 'kubectl create -f  azurestorages.yaml'
							sh 'kubectl create -f  configmaps.yaml'
	      					}
						dir("K_core") {
							sh 'kubectl create -f  aphp.yaml'
							sh 'kubectl create -f  db.yaml'
							sh 'kubectl create -f  a.yaml'
	      					}
    					}
				}
			}
		}
		/*stage('Deploy to dev'){
			steps{
				script{
					namespace = 'development'
                    			echo "Deploying application ${ID} to ${namespace} namespace"
                    			createNamespace (namespace)
              				withKubeConfig([credentialsId: 'kubeconfig', serverUrl: 'https://192.168.99.100:8443']) {
						dir("K_support") {
							sh 'kubectl create -f  azure_secrets.yaml -n ${namespace}'
							sh 'kubectl create -f  azurestorages.yaml -n ${namespace}'
							sh 'kubectl create -f  configmaps.yaml -n ${namespace}'
	      					}
						dir("K_core") {
							sh 'kubectl create -f  aphp.yaml -n ${namespace}'
							sh 'kubectl create -f  db.yaml -n ${namespace}'
							sh 'kubectl create -f  a.yaml -n ${namespace}'
	      					}
						sh 'kubectl get pod -n ${namespace}'
					}
				}
			}
		}*/
	}
              
}

