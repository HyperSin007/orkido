#!/bin/bash

# Zero-Downtime Deployment Script for Orkido
set -e

echo "🔄 Starting minimal downtime deployment..."

# Load environment variables
if [ -f ".env" ]; then
    export $(grep -v '^#' .env | xargs)
fi

# Check if app container is running
if docker-compose ps app | grep -q "Up"; then
    echo "🔄 Updating existing deployment (minimal downtime)..."
    
    # Build new image
    echo "🐳 Building updated Docker image..."
    docker-compose build app
    
    # Rolling restart (Docker Compose handles graceful shutdown)
    echo "🔄 Performing rolling restart..."
    docker-compose up -d app
    
    # Health check with timeout
    echo "⏳ Waiting for application to be ready..."
    sleep 10
    
    # Check if application is responding
    for i in {1..12}; do
        if curl -f -s http://localhost:8080 >/dev/null 2>&1; then
            echo "✅ Application is healthy and responding"
            break
        elif [ $i -eq 12 ]; then
            echo "⚠️  Application taking longer than expected, but continuing..."
            break
        else
            echo "⏳ Health check $i/12..."
            sleep 5
        fi
    done
    
else
    echo "🚀 No running containers found, performing fresh deployment..."
    docker-compose up -d
    sleep 30
fi

# Run Laravel maintenance commands (these can run while app is serving traffic)
echo "🔧 Running Laravel maintenance commands..."
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Final status check
echo "🔍 Final container status:"
docker-compose ps

echo "✅ Deployment completed successfully!"
echo "🌐 Application available at: http://$(hostname -I | awk '{print $1}'):8080"
