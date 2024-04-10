# Tech Challenge BE

A tech challenge project.

## Introduction

This project is a Dockerized setup comprising two Symfony micro-services: `users_service` and `notifications_service`. These services interact with each other through RabbitMQ messaging. Below is a brief description of each component:


## Table of Contents

- [Project Structure](#project-structure)
- [Setup](#setup)
- [Usage](#usage)
- [Monitoring](#monitoring)

## Project Structure

```
project-root/
│
├── .docker/ # Contains Docker configurations for various services.
│   ├── mysql/
│   ├── nginx/
│   ├── php/
│
├── users_service/ # Contains the Users service with endpoints to list users and add new users.
│
└── notifications_service/ # Contains the Notifications service which logs events triggered by the Users service.
```

## Setup

### Prerequisites

- Docker
- Docker Compose
- Make (optional) 
### Steps

1. Clone the repository.
2. Navigate to the `.docker` directory.
3. If you have `make` installed:

    ```bash
    make setup
    ```

   Otherwise:

    ```bash
    # Install Docker services
    docker compose up -d              
    
    # Install users_service dependencies
    docker compose exec users_service sh -c "cd /var/www/users_service && composer install"
    
    # Install notifications_service dependencies
    docker compose exec notifications_service sh -c "cd /var/www/notifications_service && composer install"
    
    # Create notification log file if it does not exist
    docker compose exec notifications_service touch ./var/log/notification.log
    
    # Monitor notifications_serive logs
    docker compose exec notifications_service tail -f ./var/log/notification.log
    ```

## Usage

### Users Service

- Access via: [http://localhost/users](http://localhost/users)
- **GET** `/users/list`: List all users in the database.
- **POST** `/users`: Receive JSON data (email, firstName, lastName) to store in the database and send an event to notifications_service using RabbitMQ.

### Notifications Service

- Access via: [http://localhost/notifications](http://localhost/notifications)
- Handles the `users_created` event from users_service and stores a log in `./var/log/notification.log`.

## Monitoring

1. Go to [http://localhost:15672](http://localhost:15672).
2. Log in with credentials:
   - Username: guest
   - Password: guest
   
## License
This project is licensed under the MIT License.
