#!/bin/bash

# Orkido Educational Consultancy - Deployment Script for aaPanel VPS
# Run this script on your VPS to set up the Docker application

set -e

echo "🚀 Starting Orkido Docker deployment with aaPanel..."

# Variables
PROJECT_DIR="/www/wwwroot/orkido"
REPO_URL="https://github.com/HyperSin007/orkido.git"

# Create project directory if it doesn't exist
if [ ! -d "$PROJECT_DIR" ]; then
    echo "📁 Creating project directory..."
    sudo mkdir -p $PROJECT_DIR
    sudo chown $USER:$USER $PROJECT_DIR
fi

# Navigate to project directory
cd $PROJECT_DIR

# Clone or pull the repository
if [ ! -d ".git" ]; then
    echo "📥 Cloning repository..."
    git clone $REPO_URL .
else
    echo "🔄 Pulling latest changes..."
    git pull origin main
fi

# Copy production environment file
if [ ! -f ".env" ]; then
    echo "⚙️ Setting up environment file..."
    cp .env.production .env
    echo "⚠️  Please edit .env file with your production settings"
    echo "🔑 Don't forget to generate APP_KEY with: docker-compose exec app php artisan key:generate"
fi

# Stop existing containers
echo "🛑 Stopping existing containers..."
docker-compose down || true

# Build and start containers
echo "🐳 Building Docker containers..."
docker-compose build --no-cache

echo "🚀 Starting application containers..."
docker-compose up -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 30

# Run Laravel setup commands
echo "🔧 Running Laravel setup..."
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Set proper permissions
echo "🔐 Setting permissions..."
docker-compose exec -T app chown -R www-data:www-data /var/www/html
docker-compose exec -T app chmod -R 755 /var/www/html
docker-compose exec -T app chmod -R 775 /var/www/html/storage
docker-compose exec -T app chmod -R 775 /var/www/html/bootstrap/cache

echo "✅ Docker deployment completed successfully!"
echo "🌐 Your application is running on: http://localhost:8080"
echo "🗄️  Database is running on: localhost:3307"
echo ""
echo "📝 aaPanel Configuration:"
echo "1. Create a new site in aaPanel"
echo "2. Set up reverse proxy to http://127.0.0.1:8080"
echo "3. Configure your domain and SSL in aaPanel"
echo "4. Database connection: localhost:3307"
