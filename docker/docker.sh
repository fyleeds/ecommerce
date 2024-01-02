
# Run Symfony migrations
php /var/www/bin/console doctrine:migrations:migrate

# Start Apache in the foreground
exec apache2-foreground
