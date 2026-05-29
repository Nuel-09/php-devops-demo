# php-devops-demo

CSY3056 — Development Operations and Software Testing  
University of Northampton — Pipeline Lab Week 8

## What this project does

A simple PHP application deployed through a Jenkins CI/CD pipeline across four environments:

| Environment | URL (Laragon)                              | Trigger        |
|-------------|--------------------------------------------|----------------|
| Dev         | http://php-devops-demo.test/dev/           | Automatic      |
| Test        | http://php-devops-demo.test/test/          | Manual approval |
| Staging     | http://php-devops-demo.test/staging/       | Manual approval |
| Production  | http://php-devops-demo.test/prod/          | Manual approval |

## Pipeline stages

1. **Checkout** — pulls latest code from GitHub
2. **Validate PHP** — runs `php -l index.php` to check syntax
3. **Deploy to Dev** — copies files automatically, writes `environment.txt`
4. **Approve → Deploy to Test** — waits for human approval in Jenkins
5. **Approve → Deploy to Staging** — waits for human approval in Jenkins
6. **Approve → Deploy to Prod** — waits for human approval in Jenkins

## Folder structure

```
C:\devops-demo\source\
├── index.php       # PHP application
├── README.md       # This file
└── Jenkinsfile     # Jenkins pipeline script

C:\laragon\www\php-devops-demo\
├── dev\
├── test\
├── staging\
└── prod\
```

## Setup

See the lab brief (Pipeline Lab Week 8) for full installation steps.
