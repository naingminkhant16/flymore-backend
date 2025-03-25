## Backend System For The FlyMore Flight Ticket Booking System

### Tech Stack

- Laravel 11
- PHP 8.2
- MySQL 8.0
- Docker
- Nginx
- CI/CD
- RabbitMQ

### Installation and Running

```bash
# Clone the repositroy
git clone https://github.com/naingminkhant16/flymore-backend.git
# Change directory
cd flymore-backend
# Copy env file
cd src && cp .env.example .env
# Build and start containers
docker compose up -d --build
# Install dependencies
docker compose run --rm composer install
# Generate artisan key
docker compose run --rm artisan key:generate
# Run migration and seeder
docker compose run --rm artisan migrate --seed
# Run test cases
docker compose run --rm artisan test
```

<h6 style='text-align:center'>Developed By Naing Min Khant.</h6>