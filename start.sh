#!/bin/bash

# Generate .env file if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key if it doesn't exist
if [ ! -f .env.key ]; then
    docker-compose exec app php artisan key:generate --ansi
fi

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
