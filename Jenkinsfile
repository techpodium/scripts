pipeline {
  agent any
  stages {
    stage('CI-Cheks') {
      steps {
        sh '''#!/bin/bash -e
phpcs --standard=WordPress-VIP --warning-severity=0 $WORKSPACE
'''
      }
    }
  }
}
