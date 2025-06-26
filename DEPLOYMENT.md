# Orkido Educational Consultancy - Deployment Guide

## Prerequisites

1. Ubuntu VPS with Docker and Docker Compose installed
2. Domain name pointed to your VPS
3. SSH access to your VPS

## GitHub Secrets Setup

Add these secrets to your GitHub repository (Settings → Secrets and variables → Actions):

### Required Secrets:
- `VPS_HOST`: Your VPS IP address or domain
- `VPS_USERNAME`: SSH username (usually 'root' or 'ubuntu')
- `VPS_SSH_KEY`: Your private SSH key
- `VPS_PORT`: SSH port (usually 22)

### Optional Secrets (for Docker Hub):
- `DOCKER_USERNAME`: Your Docker Hub username
- `DOCKER_PASSWORD`: Your Docker Hub password

## VPS Setup

1. **Connect to your VPS:**
   ```bash
   ssh your-username@your-vps-ip
   ```

2. **Install Docker and Docker Compose** (if not already installed):
   ```bash
   curl -fsSL https://get.docker.com -o get-docker.sh
   sudo sh get-docker.sh
   sudo usermod -aG docker $USER
   sudo curl -L "https://github.com/docker/compose/releases/download/v2.20.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
   sudo chmod +x /usr/local/bin/docker-compose
   ```

3. **Clone and setup the project:**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

4. **Configure environment:**
   ```bash
   cd /var/www/orkido
   nano .env
   ```
   Update the following values:
   - `APP_URL`: Your domain URL
   - `DB_PASSWORD`: Secure database password
   - `DB_USERNAME`: Database username

5. **Generate application key:**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

## Workflow Process

### Development Workflow:
1. **Push to beta branch** for testing
2. **Create Pull Request** from beta to main
3. **Auto-deployment** happens when PR is merged to main

### Branch Strategy:
- `beta`: Development and testing branch
- `main`: Production branch (auto-deployed)

## SSL Certificate (Recommended)

Use Certbot with nginx reverse proxy:

1. **Install nginx:**
   ```bash
   sudo apt install nginx certbot python3-certbot-nginx
   ```

2. **Configure nginx** (`/etc/nginx/sites-available/orkido`):
   ```nginx
   server {
       listen 80;
       server_name your-domain.com;
       
       location / {
           proxy_pass http://localhost:80;
           proxy_set_header Host $host;
           proxy_set_header X-Real-IP $remote_addr;
           proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
           proxy_set_header X-Forwarded-Proto $scheme;
       }
   }
   ```

3. **Enable site and get SSL:**
   ```bash
   sudo ln -s /etc/nginx/sites-available/orkido /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   sudo certbot --nginx -d your-domain.com
   ```

## Maintenance Commands

### View logs:
```bash
docker-compose logs -f app
```

### Backup database:
```bash
docker-compose exec db mysqldump -u root -p orkido > backup.sql
```

### Update application:
```bash
git pull origin main
docker-compose down
docker-compose up -d --build
```

### Access container shell:
```bash
docker-compose exec app bash
```

## Troubleshooting

### Check container status:
```bash
docker-compose ps
```

### Restart services:
```bash
docker-compose restart
```

### Clear Laravel cache:
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## File Permissions

If you encounter permission issues:
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html
docker-compose exec app chmod -R 755 /var/www/html
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache
```
