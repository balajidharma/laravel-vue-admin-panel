<h1 align="center">Laravel Vue Admin Panel</h1>
<h3 align="center">A Single page Vue admin panel for Laravel projects.</h3>
<p align="center">
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/license" alt="License"></a>
</p>

## Built with
- [Laravel 10](https://github.com/laravel/framework)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [balajidharma/laravel-menu](https://github.com/balajidharma/laravel-menu)
- [Vue 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Inertiajs](https://inertiajs.com/)
- [Admin One - Admin Dashboard](https://github.com/justboil/admin-one-vue-tailwind)

## Installation

### With Docker Desktop
- To get started, you need to install [Docker Desktop](https://www.docker.com/products/docker-desktop).
- You may run the following command in your terminal
- Windows open WSL2 Linux terminal. [Docker Desktop WSL 2 backend](https://docs.docker.com/desktop/windows/wsl/)
- `docker run --rm -v "$(pwd)":/opt -w /opt laravelsail/php82-composer:latest bash -c "composer create-project balajidharma/laravel-vue-admin-panel admin-app && cd admin-app && php artisan sail:install --with=mysql,redis,meilisearch,mailpit,selenium"`
- `cd admin-app`
- `./vendor/bin/sail pull mysql redis meilisearch mailpit selenium`
- `./vendor/bin/sail build`
- `./vendor/bin/sail up`
- `./vendor/bin/sail npm install`
- `./vendor/bin/sail npm run dev`
- `./vendor/bin/sail artisan vendor:publish --tag=admin-core`
- `./vendor/bin/sail artisan migrate --seed --seeder=AdminCoreSeeder`
- Now open http://localhost/

### Without Docker Desktop
- To get started, you need to install [PHP Composer](https://getcomposer.org/).
- `composer create-project balajidharma/laravel-vue-admin-panel admin-app`
- `cd admin-app`
- Create a new MYSQL database and update database details in `.env` file
- `php artisan vendor:publish --tag=admin-core`
- `php artisan migrate --seed --seeder=AdminCoreSeeder`
- `npm install`
- `npm run dev`
- `php artisan serve`
- Now open http://localhost:8000/

###### Super Admin Login
- Email - superadmin@example.com
- Password - password

#### Admin Configuration:

To change the Admin Prefix, change `prefix` on `config/admin.php` or add the `ADMIN_PREFIX` on env 

```php
'prefix' => env('ADMIN_PREFIX', 'admin'),
```

## Also Try
- [Build a Vue admin panel from scratch](https://blog.devgenius.io/laravel-creates-a-vue-admin-panel-from-scratch-part-1-installation-and-authentication-56c451d4d697)
- [Basic Laravel Admin Panel - Build with Blade template](https://github.com/balajidharma/basic-laravel-admin-panel)

## Screenshots
<p align="center">
	<img src="https://user-images.githubusercontent.com/6037466/184546912-efd044ad-cb66-4057-9eee-e9c53447763b.png" >
	<br/><br/>
	<img src="https://user-images.githubusercontent.com/6037466/184546928-0de1d84a-4dd9-4f7b-a3ac-b848209d0aef.png" >
	<br/><br/>
	<img src="https://user-images.githubusercontent.com/6037466/184547401-1c481008-e013-4ba0-b9a8-3eaf3ff7b9a1.png" >
    <br/><br/>
	<img src="https://user-images.githubusercontent.com/6037466/184547433-25f6a5a6-4e53-4448-948a-82f18a58d84c.png">
	<br/><br/>
	<img src="https://user-images.githubusercontent.com/6037466/184547446-d482df44-0835-4a37-8482-83d5279269fb.png">
	<br/><br/>
	<img src="https://user-images.githubusercontent.com/6037466/184570672-6413384d-a5c4-461b-9c8e-d97ede29a21f.png">
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
