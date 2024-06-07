up:
	docker-compose up -d

down:
	docker-compose down

up-build:
	docker-compose up --build -d

config-cache:
	docker exec -ti vs-api php artisan config:cache

migrate:
	docker exec -ti vs-api php artisan migrate

migrate-fresh:
	docker exec -ti vs-api php artisan migrate:fresh

seed-db:
	docker exec -ti vs-api php artisan db:seed

reset-db: migrate-fresh seed-db

key-generate:
	docker exec -ti vs-api php artisan key:generate

db-seed:
	docker exec -ti vs-api php artisan db:seed

restart-front:
	docker container restart vs-front