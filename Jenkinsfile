pipeline {
    agent any

    environment {
        DOCKER_TAG_PREFIX  = 'build'
        //
        DOCKER_IMAGE = 'vilar-temp'
        //
	//DOCKER_REPO = ''
        DOCKER_URI = "$DOCKER_REPO$DOCKER_IMAGE"
    }

    stages {
        stage('Building Docker image') {
            steps {
  		// Tag with build number
                sh 'docker build -t $DOCKER_URI:$DOCKER_TAG_PREFIX$BUILD_NUMBER .'
                // Tag Latest
                sh 'docker tag $DOCKER_URI:$DOCKER_TAG_PREFIX$BUILD_NUMBER $DOCKER_URI:latest'
            }
        }
        stage('Sending image to registry') {
            steps {
                sh '$(aws ecr get-login --no-include-email --region us-east-1)'
                sh 'docker push $DOCKER_URI:$DOCKER_TAG_PREFIX$BUILD_NUMBER'
                sh 'docker push $DOCKER_URI:latest'
            }
        }
        stage('Updating the image in Kubernetes deployment') {
            steps {
                sh 'kubectl set image deployments/webapp webapp=$DOCKER_URI:$DOCKER_TAG_PREFIX$BUILD_NUMBER'
            }
        }
    }
}
