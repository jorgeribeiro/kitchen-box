# [Laravel] Kitchen box API

## Description

The Kitchen Box API is an application designed to manage the operations of a kitchen box service. It provides various endpoints for ingredient and recipe management, as well as the creation and fulfillment of customer orders. The primary goal is to deliver fresh ingredients to customers.

## Setup

To run this application, Docker is required. Follow the steps below to set up the project:

1. Run the `start.sh` bash script located at the root of the project. This script initializes the services, including a MySQL database.
2. If you want to seed the tables with sample data, uncomment the seeders in `database/seeders/DatabaseSeeder.php` before starting the application.

The application runs on port `8080`.

## Endpoints

The following endpoints are available in the API:

1. **Create an ingredient:** 
```
POST http://localhost:8080/api/ingredients
```

2. **List ingredients with pagination:** 
```
GET http://localhost:8080/api/ingredients?page=1
```

3. **Create a recipe:**
```
POST http://localhost:8080/api/recipes
```

4. **List recipes with pagination:**
```
GET http://localhost:8080/api/recipes?page=1
```

5. **Login:**
```
POST http://localhost:8080/api/login
```

6. **Create a box for a customer:** (requires authentication)
```
POST http://localhost:8080/api/boxes
```
## Improvements

Here are some areas for improvement:

- **Write unit and integration tests:** Adding tests will ensure the stability and reliability of the application.
- **Fix start.sh script:** Currently, the script is not running correctly during the initial setup. This issue needs to be addressed to improve the usability of the project.
