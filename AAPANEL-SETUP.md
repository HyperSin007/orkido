# aaPanel Docker Deployment Guide

## Architecture Overview

```
Internet → aaPanel (Port 80/443) → Reverse Proxy → Docker Container (Port 8080)
```

Your Laravel app runs in Docker containers:
- **App Container**: Port 8080 (Laravel + Apache)
- **Database Container**: Port 3307 (MySQL)
- **aaPanel**: Handles domain, SSL, and reverse proxy

## Step-by-Step Setup

### 1. VPS Preparation

```bash
# SSH to your VPS
ssh your-username@your-vps-ip

# Navigate to aaPanel web directory
cd /www/wwwroot/

# Create project directory
sudo mkdir -p orkido
sudo chown $USER:$USER orkido
cd orkido

# Clone repository
git clone https://github.com/HyperSin007/orkido.git .
git checkout beta  # Start with beta for testing
```

### 2. Environment Configuration

```bash
# Copy and edit environment file
cp .env.production .env
nano .env
```

**Important .env settings for Docker:**
```env
APP_URL=http://your-domain.com
DB_HOST=db  # Docker service name
DB_PORT=3306  # Internal container port
DB_DATABASE=orkido
DB_USERNAME=orkido_user
DB_PASSWORD=your_secure_password
```

### 3. Run Docker Deployment

```bash
# Make script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh
```

### 4. aaPanel Configuration

#### 4a. Create Website
1. **Login to aaPanel**: `http://your-vps-ip:8888`
2. **Website → Add Site**:
   - Domain: `your-domain.com`
   - Root Directory: `/www/wwwroot/orkido` (doesn't matter for proxy)
   - PHP Version: Any (won't be used)
   - Database: No (Docker handles this)

#### 4b. Configure Reverse Proxy
1. **Go to your site → Reverse Proxy**
2. **Add Proxy**:
   - **Target URL**: `http://127.0.0.1:8080`
   - **Send Domain**: ✓ (checked)
   - **Cache**: Disabled
   - **Enable**: ✓

#### 4c. SSL Certificate (Recommended)
1. **Go to your site → SSL**
2. **Let's Encrypt**: Add your domain
3. **Force HTTPS**: Enable

### 5. Verify Deployment

```bash
# Check containers are running
docker-compose ps

# Check logs
docker-compose logs -f app

# Test application locally
curl http://localhost:8080

# Test through aaPanel proxy
curl http://your-domain.com
```

## Maintenance Commands

### Update Application
```bash
cd /www/wwwroot/orkido
git pull origin main
docker-compose down
docker-compose up -d --build
```

### View Logs
```bash
# Application logs
docker-compose logs -f app

# Database logs
docker-compose logs -f db

# All logs
docker-compose logs -f
```

### Database Access
```bash
# Connect to MySQL container
docker-compose exec db mysql -u orkido_user -p orkido

# Backup database
docker-compose exec db mysqldump -u orkido_user -p orkido > backup.sql

# Restore database
docker-compose exec -T db mysql -u orkido_user -p orkido < backup.sql
```

### Laravel Commands
```bash
# Clear cache
docker-compose exec app php artisan cache:clear

# Run migrations
docker-compose exec app php artisan migrate

# Generate app key
docker-compose exec app php artisan key:generate
```

## Troubleshooting

### Container Won't Start
```bash
# Check Docker logs
docker-compose logs app

# Rebuild containers
docker-compose down
docker-compose up -d --build --force-recreate
```

### aaPanel Proxy Issues
1. **Check Target URL**: Must be `http://127.0.0.1:8080`
2. **Check Container**: `docker-compose ps` - app should be running
3. **Check Port**: `netstat -tlnp | grep 8080`

### Database Connection Issues
```bash
# Check database container
docker-compose logs db

# Test connection
docker-compose exec app php artisan tinker
# In tinker: DB::connection()->getPdo();
```

### Permission Issues
```bash
# Fix Laravel permissions
docker-compose exec app chown -R www-data:www-data /var/www/html
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

## CI/CD Pipeline

The GitHub Actions workflow will:
1. **Test on beta branch** pushes
2. **Deploy to production** when merged to main
3. **Automatically update** Docker containers on VPS

Make sure these GitHub secrets are set:
- `VPS_HOST`: Your VPS IP
- `VPS_USERNAME`: SSH username  
- `VPS_SSH_KEY`: Private SSH key
- `VPS_PORT`: SSH port (22)

## Security Notes

- Docker containers run isolated from host
- Database only accessible from app container
- aaPanel handles SSL termination
- Use strong passwords in .env
- Keep aaPanel updated
- Regular backups recommended
