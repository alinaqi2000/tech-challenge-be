docker:
	- docker compose up -d --build
	- docker compose exec users_service sh -c "cd /var/www/users_service && composer install"
database:
	- docker compose exec users_service php bin/console doctrine:migration:migrate -n
notifications-monitor:
	- docker compose exec notifications_service touch ./var/log/notification.log && docker compose exec notifications_service tail -f ./var/log/notification.log
start:
	- docker compose up -d
stop:
	- docker compose down