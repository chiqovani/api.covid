

## Project setup

### 
```
composer install
```
```
php artisan octane:install 
```
#### create .env file  and run :
```
php artisan key:generate 
```
```
php artisan migrate
```
#### run one time command to get country list
```
php artisan populate:countries
```

#### run scheduled job to get country statistics
```
php artisan schedule:run
```
