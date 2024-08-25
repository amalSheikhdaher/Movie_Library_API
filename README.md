# Movie Library API

Welcome to the Movie Library API project built with Laravel 10. This project provides a backend API for managing movies, including CRUD operations, using Laravel's robust features.


## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [API Endpoints](#api-endpoints)
- [Testing with Postman](#testing-with-postman)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.0 or higher
- Composer
- Laravel 10
- MySQL or another supported database
- Postman for testing

## Installation

1. **Clone the Repository:**
```
git clone https://github.com/amalSheikhdaher/Movie_Library_API.git
```

2. **Install Dependencies:**
```
composer install
```

3. **Copy Environment File:**
```
cp .env.example .env
```

4. **Generate Application Key:**
```
 php artisan key:generate
```

5. **Set Up the Database:**

   Update your `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movie_library_api
DB_USERNAME=root
DB_PASSWORD=
```

7. **Run Migrations:**
```
php artisan migrate
```

## Running the Application

Start the Laravel development server:
```
php artisan serve
```
Your application will be accessible at `http://localhost:8000`.

## API Endpoints

Here are some of the primary endpoints for managing movies:

- **List Movies:**
  - **GET** `/api/movies`
  - Retrieves a list of all movies.

- **Get Movie Details:**
  - **GET** `/api/movies/{id}`
  - Retrieves details of a specific movie.

- **Create a Movie:**
  - **POST** `/api/movies`
  - Creates a new movie. Requires a JSON body with movie details.

- **Update a Movie:**
  - **PUT** `/api/movies/{id}`
  - Updates details of a specific movie. Requires a JSON body with updated movie details.

- **Delete a Movie:**
  - **DELETE** `/api/movies/{id}`
  - Deletes a specific movie.

## Testing with Postman

To test the API using Postman:

1. **Import Postman Collection:**
   - Import the collection (https://cloudy-eclipse-506985.postman.co/workspace/Movie-Library~c9e40e4c-404a-4cd8-acf1-5429984b9da5/collection/34376611-228afb14-89d6-4133-a3e9-de03aa3e2fab?action=share&creator=34376611) into Postman.

2. **Set Up Environment:**
   - Set up a Postman environment with the base URL (e.g., `http://localhost:8000`).

3. **Run Requests:**
   - Use the imported collection or manually create requests to test the API endpoints.
   - Ensure you send the appropriate headers, such as `Content-Type: application/json`, and include any required authentication tokens if necessary.

## License

This project is licensed under the [MIT License](LICENSE).
