# Laravel Application Setup Guide
This guide will walk you through the steps to set up and run a Laravel application. Please make sure you have PHP version 7.4.12 or later installed on your system.

## Justification for Including Private Key in `.env` File

As part of this challenge, I have included a private key in the `.env` file. I would like to provide a brief justification for this decision to ensure clarity and transparency.

The purpose of including the private key in the `.env` file is to simplify the evaluation process for the reviewers. By including the private key, I aim to make it easier for the reviewers to run and test the project without the need for additional setup steps or external dependencies.

Please note that in a real-world scenario or production environment, it is crucial to follow security best practices, which typically involve keeping sensitive information like private keys separate and secure. However, for the purpose of this interview challenge and the constraints it presents, I made the decision to include the private key in the `.env` file to streamline the evaluation process.


## Prerequisites
- PHP 7.4.12 or later
- MySQL database

## Setup Instructions

1. Create a MySQL database named "lightit".
2. Verify that the credentials and ports in the .env file at the root of the project are correct. Make sure they match your MySQL database configuration.
3. Run the following command to migrate the database and create the required tables:

```
php artisan migrate
```

4. Start the application by running the following command:
```
php artisan serve
```

5. Once the service is running, you can send requests to the API endpoints.

## Additional Configuration

- If you need to make further configuration changes, you can modify the `.env` file at the root of the project. This file contains various settings for your Laravel application, including database connections and application-specific configurations.
