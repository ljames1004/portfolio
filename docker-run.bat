@echo off
echo Building and starting Laravel Portfolio with Docker...

REM Stop any existing containers
docker-compose down

REM Build and start the containers
docker-compose up --build -d

echo Waiting for containers to start...
timeout /t 10 /nobreak >nul

REM Check if containers are running
docker-compose ps | findstr "Up" >nul
if %errorlevel% equ 0 (
    echo ✅ Laravel Portfolio is running!
    echo 🌐 Access your portfolio at: http://localhost:8000
    echo.
    echo To view logs: docker-compose logs -f
    echo To stop: docker-compose down
) else (
    echo ❌ Something went wrong. Check the logs:
    docker-compose logs
)

pause
