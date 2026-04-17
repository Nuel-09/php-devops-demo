pipeline {
    agent any

    environment {
        GIT_EXE = 'C:\\Users\\YourName\\AppData\\Local\\Programs\\Git\\cmd\\git.exe'
        REPO_URL = 'https://github.com/YOUR-USERNAME/php-devops-demo.git'
        REPO_BRANCH = 'main'
        DEV_PATH = 'C:\\laragon\\www\\php-devops-demo\\dev'
        TEST_PATH = 'C:\\laragon\\www\\php-devops-demo\\test'
        STAGING_PATH = 'C:\\laragon\\www\\php-devops-demo\\staging'
        PROD_PATH = 'C:\\laragon\\www\\php-devops-demo\\prod'
        PHP_EXE = 'C:\\laragon\\bin\\php\\php-8.3.30-Win32-vs16-x64\\php.exe'
    }

    stages {
        stage('Checkout from GitHub') {
            steps {
                bat '''
                if exist .git (
                    "%GIT_EXE%" fetch --all
                    "%GIT_EXE%" reset --hard origin/%REPO_BRANCH%
                ) else (
                    "%GIT_EXE%" clone -b %REPO_BRANCH% %REPO_URL% .
                )
                '''
            }
        }

        stage('Validate PHP Syntax') {
            steps {
                bat "\"%PHP_EXE%\" -l index.php"
            }
        }

        stage('Prepare Dev') {
            steps {
                bat 'echo DEV > environment.txt'
            }
        }

        stage('Deploy to Dev') {
            steps {
                bat 'xcopy /E /I /Y .\\* "%DEV_PATH%\\"'
            }
        }

        stage('Approve for Test') {
            steps {
                input message: 'Promote build to TEST?'
            }
        }

        stage('Prepare Test') {
            steps {
                bat 'echo TEST > environment.txt'
            }
        }

        stage('Deploy to Test') {
            steps {
                bat 'xcopy /E /I /Y .\\* "%TEST_PATH%\\"'
            }
        }

        stage('Approve for Staging') {
            steps {
                input message: 'Promote build to STAGING?'
            }
        }

        stage('Prepare Staging') {
            steps {
                bat 'echo STAGING > environment.txt'
            }
        }

        stage('Deploy to Staging') {
            steps {
                bat 'xcopy /E /I /Y .\\* "%STAGING_PATH%\\"'
            }
        }

        stage('Approve for Production') {
            steps {
                input message: 'Promote build to PRODUCTION?'
            }
        }

        stage('Prepare Production') {
            steps {
                bat 'echo PRODUCTION > environment.txt'
            }
        }

        stage('Deploy to Production') {
            steps {
                bat 'xcopy /E /I /Y .\\* "%PROD_PATH%\\"'
            }
        }
    }

    post {
        success {
            echo 'Pipeline completed successfully.'
        }
        failure {
            echo 'Pipeline failed. Deployment stopped.'
        }
    }
}