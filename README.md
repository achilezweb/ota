# OTA

This project is a test application for OTA.

## Installation

Follow these steps to set up and install the Laravel Job project:

### Prerequisites

- PHP 7.4
- [Composer](https://getcomposer.org/)
- PostgreSQL 
ARG NODE_VERSION=16
ARG POSTGRES_VERSION=13
- [NodeJS](https://nodejs.org/en/)
- [Docker](https://www.docker.com/products/docker-desktop)

### Clone the Repository

Clone the repository to your local machine:

```bash
git clone git@github.com:achilezweb/ota.git
```

### Startup Docker Containers

```bash
# start containers
docker-compose up -d
```

### Install Dependencies
Navigate to the project directory and install PHP dependencies using Composer:

```bash
cd ota
composer install
```

### Configure Environment Variables
Copy the .env.example file to create a new .env file:

```bash
cp .env.example .env
```

### Open the .env file and configure the following environment variables:

```bash
DB_CONNECTION: Set this to pgsql for PostgreSQL.
DB_HOST: Set the host of your PostgreSQL database.
DB_PORT: Set the port of your PostgreSQL database.
DB_DATABASE: Set the name of your PostgreSQL database.
DB_USERNAME: Set the username for accessing your PostgreSQL database.
DB_PASSWORD: Set the password for accessing your PostgreSQL database.
```

### Generate Application Key
Generate a new application key:

```bash
php artisan key:generate
```

### Run Migrations
Run the database migrations to create the necessary tables:

```bash
php artisan migrate:fresh 
php artisan storage:link
```

### Run Migrations
Run the database migrations to create the necessary tables:

```bash
npm install && npm run dev
```

### Serve the Application
Start the Laravel development server:

```bash
php artisan serve
```

### The application will be available at http://localhost:8000.

### Usage
```bash
Use the web interface to create jobs.
Use the API endpoints (/api/jobs) to display all jobs.
GET /api/jobs
POST /api/jobs
```
