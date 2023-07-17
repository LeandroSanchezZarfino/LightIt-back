# Laravel Application Setup Guide
This guide will walk you through the steps to set up and run a Laravel application. Please make sure you have PHP version 7.4.12 or later installed on your system.

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
