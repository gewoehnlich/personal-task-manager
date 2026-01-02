.PHONY = migrate tinker

include .env
export

migrate:
	docker compose exec app php artisan migrate:fresh --seed

tinker:
	docker compose exec app php artisan tinker

optimize:
	docker compose exec app php artisan optimize

test:
	docker compose exec app php artisan test --parallel

pint:
	docker compose exec app php artisan pint
