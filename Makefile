MYSQL_CONTAINER = mysql.personal-task-manager
LARAVEL_CONTAINER = laravel.personal-task-manager

.PHONY = help build up down delete commit enter-db migrate

include .env
export

help:
	@echo "make build  - Установить образ локально"
	@echo "make up     - Запустить образ"
	@echo "make down   - Остановить образ"
	@echo "make delete - Удалить образ"

build:
	composer update
	composer install
	php artisan key:generate
	npm install
	npm run build
	docker compose build

up:
	docker compose up

down:
	docker compose down

delete:
	docker compose down -v

commit:
	git add .
	git commit -m "$(m)"
	git push origin main

enter-db:
	docker exec -it $(MYSQL_CONTAINER) mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE)

migrate:
	docker exec -i $(LARAVEL_CONTAINER) php artisan migrate
