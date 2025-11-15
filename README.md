### Tests and linter status:
[![Actions Status](https://github.com/maxheong54/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/maxheong54/php-project-57/actions)
[![check](https://github.com/maxheong54/php-project-57/actions/workflows/check.yml/badge.svg)](https://github.com/maxheong54/php-project-57/actions/workflows/check.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=maxheong54_php-project-57&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=maxheong54_php-project-57)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=maxheong54_php-project-57&metric=bugs)](https://sonarcloud.io/summary/new_code?id=maxheong54_php-project-57)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=maxheong54_php-project-57&metric=coverage)](https://sonarcloud.io/summary/new_code?id=maxheong54_php-project-57)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=maxheong54_php-project-57&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=maxheong54_php-project-57)

# Task Manager

## About

Task Manager is a task management system similar to http://www.redmine.org/. It allows you to create tasks, assign performers, and change their statuses. Registration and authentication are required to use the system.

**See the web service demo:** [Task Manager](https://php-project-57-h1ro.onrender.com).

## Prerequisites

+ Linux, MacOS, WSL
+ PostgreSQL >= 16.9
+ PHP >=8.4
+ Composer
+ Make
+ Git


## Usage

### Install project

This command installs PHP dependencies via Composer:

```bash
git clone https://github.com/maxheong54/php-project-57.git
cd php-project-57
make install
```

### Start server

Finally, start your **PHP Server**:

```bash
make start
```

Open in browser: http://localhost:8000