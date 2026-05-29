pipeline {
    agent any

    environment {
        // -------------------------------------------------------
        // EDIT THESE VALUES BEFORE RUNNING THE PIPELINE
        // -------------------------------------------------------

        // Your Windows username (the part in C:\Users\YourName)
        WIN_USER = "emman"

        // Full path to your Laragon PHP executable
        // Find it by running: Get-ChildItem C:\laragon\bin\php -Recurse -Filter php.exe
        PHP_EXE  = "C:\\laragon\\bin\\php\\php-8.3.14-Win32-vs16-x64\\php.exe"

        // Full path to your Git executable (confirmed on this machine)
        GIT_EXE  = "C:\\Program Files\\Git\\cmd\\git.exe"

        // GitHub repo URL — replace YOUR-USERNAME with your actual GitHub username
        REPO_URL = "https://github.com/Nuel-09/php-devops-demo.git"

        // Root deployment path inside Laragon www
        DEPLOY_ROOT = "C:\\laragon\\www\\php-devops-demo"
    }

    stages {

        // -------------------------------------------------------
        // STAGE 1 — Checkout
        // Pull the latest code from GitHub
        // -------------------------------------------------------
        stage('Checkout') {
            steps {
                echo "Cloning source from GitHub..."
                git url: "${env.REPO_URL}", branch: 'main'
            }
        }

        // -------------------------------------------------------
        // STAGE 2 — Validate
        // Use PHP's built-in lint checker (-l flag) to confirm
        // index.php has no syntax errors before deploying anywhere
        // -------------------------------------------------------
        stage('Validate PHP') {
            steps {
                echo "Running PHP syntax check on index.php..."
                bat "\"${env.PHP_EXE}\" -l index.php"
            }
        }

        // -------------------------------------------------------
        // STAGE 3 — Deploy to Dev (automatic)
        // Copies all source files straight into the dev folder.
        // No approval needed — developers see changes immediately.
        // -------------------------------------------------------
        stage('Deploy to Dev') {
            steps {
                echo "Deploying to Dev environment..."
                bat "xcopy /E /Y /I . \"${env.DEPLOY_ROOT}\\dev\""
                bat "echo dev > \"${env.DEPLOY_ROOT}\\dev\\environment.txt\""
                echo "Dev deployment complete."
            }
        }

        // -------------------------------------------------------
        // STAGE 4 — Approve Test (manual gate)
        // A human must click Proceed in Jenkins before this
        // stage runs. This prevents untested code reaching Test.
        // -------------------------------------------------------
        stage('Approve: Deploy to Test') {
            steps {
                input message: 'Deploy to TEST environment?', ok: 'Proceed to Test'
            }
        }

        stage('Deploy to Test') {
            steps {
                echo "Deploying to Test environment..."
                bat "xcopy /E /Y /I . \"${env.DEPLOY_ROOT}\\test\""
                bat "echo test > \"${env.DEPLOY_ROOT}\\test\\environment.txt\""
                echo "Test deployment complete."
            }
        }

        // -------------------------------------------------------
        // STAGE 5 — Approve Staging (manual gate)
        // -------------------------------------------------------
        stage('Approve: Deploy to Staging') {
            steps {
                input message: 'Deploy to STAGING environment?', ok: 'Proceed to Staging'
            }
        }

        stage('Deploy to Staging') {
            steps {
                echo "Deploying to Staging environment..."
                bat "xcopy /E /Y /I . \"${env.DEPLOY_ROOT}\\staging\""
                bat "echo staging > \"${env.DEPLOY_ROOT}\\staging\\environment.txt\""
                echo "Staging deployment complete."
            }
        }

        // -------------------------------------------------------
        // STAGE 6 — Approve Production (manual gate)
        // Production is the live environment — highest risk.
        // -------------------------------------------------------
        stage('Approve: Deploy to Prod') {
            steps {
                input message: 'Deploy to PRODUCTION environment? This is LIVE!', ok: 'Deploy to Prod'
            }
        }

        stage('Deploy to Prod') {
            steps {
                echo "Deploying to Production environment..."
                bat "xcopy /E /Y /I . \"${env.DEPLOY_ROOT}\\prod\""
                bat "echo prod > \"${env.DEPLOY_ROOT}\\prod\\environment.txt\""
                echo "Production deployment complete."
            }
        }
    }

    // -------------------------------------------------------
    // POST — Print a summary regardless of success or failure
    // -------------------------------------------------------
    post {
        success {
            echo "Pipeline completed successfully. All approved environments are up to date."
        }
        failure {
            echo "Pipeline failed. Check the stage logs above for details."
        }
    }
}
