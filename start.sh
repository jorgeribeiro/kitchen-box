#!/bin/bash

# Start the Docker containers
docker-compose up -d

# Wait for the app container to be ready
echo "Waiting for the app container to be ready..."
until docker-compose exec app php -v >/dev/null 2>&1; do
    sleep 1
done

# Run database migrations
docker-compose exec app php artisan migrate

# Seed the database (if needed)
docker-compose exec app php artisan db:seed

echo "Environment setup completed!"
