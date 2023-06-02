#!/bin/bash

# Generate .env file if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Start the Docker containers
docker-compose up -d

# Wait for the app container to be ready
echo "Waiting for the app container to be ready..."
until docker-compose exec app php -v >/dev/null 2>&1; do
    sleep 1
done

# Install Composer dependencies
docker-compose exec app composer install --no-interaction --prefer-dist

# Check if APP_KEY is already set
if grep -q "^APP_KEY=.*" .env; then
    existing_key=$(grep "^APP_KEY=.*" .env)
    if [[ "$existing_key" == "APP_KEY=" ]]; then
        docker-compose exec app php artisan key:generate --ansi
        echo "Generated a new APP_KEY in the .env file."
    else
        echo "APP_KEY is already set in the .env file."
    fi
else
    # Generate app key if it doesn't exist
    docker-compose exec app php artisan key:generate --ansi
    echo "Generated a new APP_KEY in the .env file."
fi

# Run database migrations
docker-compose exec app php artisan migrate

# Seed the database (if needed)
docker-compose exec app php artisan db:seed

echo "Environment setup completed!"
