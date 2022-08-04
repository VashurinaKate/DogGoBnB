<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Build setup
## Easiest way for setup:
- Set your local **UID** and **GID** in `.env.example`
- Use `make init` command for build ***docker app*** in one command!
- Reset **UID** and **GID** from `.env.example`
#### For open container's bash add `--user=www-datah` flag

## Hard way:
#### Install dependencies
- `composer i`
#### Run project initial commands
- `php artisan key:gen`
- `php artisan migrate:fresh --seed`
- `php artisan storage:link`
#### Run server
- `php artisan serve` or whatever you use.

Done! U'r ready to use app.
