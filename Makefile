#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Start docker containers
start:
	docker-compose start

# Stop docker containers
stop:
	docker-compose stop

# Recreate docker containers
up:
	docker-compose up -d

# Stop and remove containers and networks
down:
	docker-compose down

# Stop and remove containers, networks, volumes and images
clean:
	docker-compose down --rmi local -v

# Restart all containers
restart: stop start

# Build and up docker containers
build:
	docker-compose build

# Build containers with no cache option
build-no-cache:
	docker-compose build --no-cache

# Build and up docker containers
rebuild: build up

make-env:
	[ -f .env ] && echo .env exists || cp .env.example .env

make init: make-env up install start

#-----------------------------------------------------------
# Database
#-----------------------------------------------------------

# Run database migrations
db-migrate:
	docker-compose exec php php artisan migrate

# Run migrations rollback
db-rollback:
	docker-compose exec php php artisan migrate:rollback

# Run last migration rollback
db-rollback-last:
	docker-compose exec php php artisan migrate:rollback --step=1

# Run seeders
db-seed:
	docker-compose exec php php artisan db:seed

# Fresh all migrations
db-fresh:
	docker-compose exec php php artisan migrate:fresh

# Fresh all migrations with seeds
db-fresh-seed:
	docker-compose exec php php artisan migrate:fresh --seed

#-----------------------------------------------------------
# Project commands
#-----------------------------------------------------------
docs-gen:
	docker-compose exec php php artisan l5-swagger:generate

#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Laravel
install:
	docker-compose stop
	docker-compose run --rm -u `id -u` php composer i
	docker-compose run --rm -u `id -u` php php artisan key:gen
	docker-compose run --rm -u `id -u` php php artisan migrate:fresh --seed
	docker-compose run --rm -u `id -u` php php artisan storage:link
	rm -rf .composer
