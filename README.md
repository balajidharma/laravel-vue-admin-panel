<h1 align="center">Laravel Vue Admin Panel</h1>
<h3 align="center">A Single page Vue admin panel for Laravel projects.</h3>
<p align="center">
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/license" alt="License"></a>
</p>

## Built with
- [Laravel 9](https://github.com/laravel/framework)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Tailwind CSS](https://tailwindcss.com/)


## Installation
- To get started, you need to install [Docker Desktop](https://www.docker.com/products/docker-desktop).
- You may run the following command in your terminal
- Windows open WSL2 Linux terminal. [Docker Desktop WSL 2 backend](https://docs.docker.com/desktop/windows/wsl/)
- `docker run --rm -v "$(pwd)":/opt -w /opt laravelsail/php81-composer:latest bash -c "composer create-project balajidharma/laravel-vue-admin-panel admin-app && cd admin-app && php ./artisan sail:install --with=mysql,redis,meilisearch,mailhog,selenium"`
- `cd admin-app && ./vendor/bin/sail up`
- `./vendor/bin/sail npm install`
- `./vendor/bin/sail npm run dev`
- `./vendor/bin/sail artisan migrate --seed --seeder=BasicAdminPermissionSeeder`
- Now open http://localhost/

###### Super Admin Login
- Email - superadmin@example.com
- Password - password

## Screenshots
<p align="center">
	<img src="https://miro.medium.com/max/700/1*Wk4WaomlQ4v_GKUY2AhcXw.png" >
	<br/><br/>
	<img src="https://miro.medium.com/max/700/1*3eXlUx9DnzjgXX_1PJ_qWw.png" >
	<br/><br/>
	<img src="https://miro.medium.com/max/700/1*jtzIchs6RP-leKp3nugdZw.png" >
    <br/><br/>
	<img src="https://miro.medium.com/max/700/1*4LFqQCnriBDipDpbvcnCzw.png">
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
