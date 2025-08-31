#!/bin/bash

echo "Building and starting Laravel Portfolio with Docker..."

# Stop any existing containers
docker-compose down

# Build and start the containers
docker-compose up --build -d

echo "Waiting for containers to start..."
sleep 10

# Check if containers are running
if docker-compose ps | grep -q "Up"; then
    echo "✅ Laravel Portfolio is running!"
    echo "🌐 Access your portfolio at: http://localhost:8000"
    echo ""
    echo "To view logs: docker-compose logs -f"
    echo "To stop: docker-compose down"
else
    echo "❌ Something went wrong. Check the logs:"
    docker-compose logs
fi
