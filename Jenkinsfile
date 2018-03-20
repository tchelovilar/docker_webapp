pipeline {
    agent any

    environment {
        DOCKER_TAG_PREFIX  = 'build'
        //
	//DOCKER_REPO = ''
        DOCKER_IMAGE = '485164690107.dkr.ecr.us-east-1.amazonaws.com/vilar-temp'
        DOCKER_URI = '$DOCKER_REPO$DOCKER_IMAGE'
    }

    stages {
        stage('Building Docker image') {
            steps {
  		// Tag with build number
                sh 'docker build -t $DOCKER_IMAGE:$DOCKER_TAG_PREFIX$BUILD_NUMBER .'
                // Tag Latest
                sh 'docker tag $DOCKER_IMAGE:$DOCKER_TAG_PREFIX$BUILD_NUMBER $DOCKER_IMAGE:latest'
                //
                sh '$DOCKER_URI'
            }
        }
        stage('Sending image to registry') {
            steps {
                sh '$(aws ecr get-login --no-include-email --region us-east-1)'
                sh 'docker push $DOCKER_IMAGE:$DOCKER_TAG_PREFIX$BUILD_NUMBER'
                sh 'docker push $DOCKER_IMAGE:latest'
            }
        }
        stage('Updating the image in Kubernetes deployment') {
            steps {
                sh 'kubectl set image deployments/webapp webapp=$DOCKER_IMAGE:$DOCKER_TAG_PREFIX$BUILD_NUMBER'
            }
        }
    }
}
