composer install
echo 'Install vendor success!'
python3 env-database.py
php artisan key:generate
echo 'Key generation success!'
php artisan migrate
echo 'Database migration success!'