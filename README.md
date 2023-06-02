# [Laravel] Kitchen box API

## Description

The Kitchen Box API is an application designed to manage the operations of a kitchen box service. It provides various endpoints for ingredient and recipe management, as well as the creation and fulfillment of customer orders. The primary goal is to deliver fresh ingredients to customers by checking the boxes that have been ordered on a weekly basis.

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

Example payload:
```
{
  "name": "Sugar",
  "measure": "g",
  "supplier": "ABC Supplier"
}
```

2. **List ingredients with pagination:** 
```
GET http://localhost:8080/api/ingredients?page=1
```

3. **Create a recipe:**
```
POST http://localhost:8080/api/recipes
```

Example payload:
```
{
  "name": "Chocolate Cake",
  "description": "A delicious chocolate cake recipe",
  "ingredients": [
    {
      "id": 1,
      "amount": 200
    },
    {
      "id": 2,
      "amount": 10
    }
  ]
}
```

4. **List recipes with pagination:**
```
GET http://localhost:8080/api/recipes?page=1
```

5. **Login:** (returns a token)
```
POST http://localhost:8080/api/login
```

Example payload:
```
{
  "email": "user@example.com",
  "password": "password"
}
```

6. **Create a box for a customer:** (authentication required, include the token in the headers as a Bearer Token)
```
POST http://localhost:8080/api/boxes
```

Example payload:
```
{
  "delivery_date": "2023-07-01",
  "recipe_ids": [1, 2, 3]
}
```

7. **List of ingredients to be ordered:**
```
GET http://localhost:8080/api/ingredients/order?order_date=2023-07-01
```

## Improvements

- Write unit and integration tests
