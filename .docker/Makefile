setup:
	- docker compose up -d --build
	- docker compose exec users_service sh -c "cd /var/www/users_service && composer install"
	- docker compose exec notifications_service sh -c "cd /var/www/notifications_service && composer install"
	- docker compose exec notifications_service touch ./var/log/notification.log
	- make monitor
monitor:
	- docker compose exec notifications_service tail -f ./var/log/notification.log
start:
	- docker compose up -d
stop:
	- docker compose down