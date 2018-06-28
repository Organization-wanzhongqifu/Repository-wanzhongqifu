mkdir storage/app
mkdir storage/framework
mkdir storage/views
mkdir storage/framework/cache
mkdir storage/framework/sessions
mkdir storage/framework/views
chmod 777 -R storage
chmod 777 -R vendor
chmod 777 -R public
chmod 777 -R bootstrap/cache
composer update
php artisan storage:link
php artisan migrate
chown -R www-data:www-data ./
