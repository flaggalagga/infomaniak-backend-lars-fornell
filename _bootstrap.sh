#!/usr/bin/env bash

# Install composer dependencies
echo "Installing composer dependencies..."
docker run --rm --volume "$PWD":/app composer install --ignore-platform-reqs

# Start Laravel Sail
echo "Starting Laravel Sail"
./vendor/bin/sail up -d

# Copy .env
echo "Create .env"
cp .env.example .env

# Generate application key
echo "Generate application key"
./vendor/bin/sail artisan key:generate

# Create SQLite database file
echo "Create SQLite database file"
touch ./database/database.sqlite

echo "=========================================================="
echo "| Your are good to go !                                  |"
echo "| Application lives at: http://localhost                 |"
echo "| Fake API lives at   : http://localhost:3000/api/movies |"
echo "=========================================================="
