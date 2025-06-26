#!/bin/bash

# Orkido Educational Consultancy - Deployment Script
# Run this script on your VPS to set up the application

set -e

echo "🚀 Starting Orkido deployment..."

# Variables
PROJECT_DIR="/var/www/orkido"
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

# Build and start containers
echo "🐳 Building Docker containers..."
docker-compose down || true
docker-compose build --no-cache

echo "🚀 Starting application..."
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

echo "✅ Deployment completed successfully!"
echo "🌐 Your application should be available at http://your-domain.com"
echo ""
echo "📝 Next steps:"
echo "1. Edit .env file with your production settings"
echo "2. Set up your domain/reverse proxy if needed"
echo "3. Configure SSL certificate"
echo "4. Set up automated backups"
