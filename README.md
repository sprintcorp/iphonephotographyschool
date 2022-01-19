<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Overview

This solution uses laravel event lsiteners to watch for customers activities on cousrse to unlock different badges base on achievemnet users attained. All implementations are backed with tests.



## Project setup


clone the project from repository using the `git clone https://github.com/sprintcorp/iphonephotographyschool.git` into a directory on your pc afterwards checkout to master branch using command `git checkout master` then move project directory with this command `cd iphonephotographyschool` afterwards run `composer install` to install all packages needed for the application to function which is installed from the composer.json file which creates a vendor file housing all needed application-level package manager for the application.
When the above has been done you the proceed to create database, the database use during development is mysql database and Eloquent ORM is used to interact with the database, after this is done a sample of the .env exist as .env.example which can be copied to create enviroment variable for this application which houses simple configuration text file that is used to define some variables passed into the application's environment, after this is done an app key is needed for the application to function properly used for all encrypted data, like sessions,Password, remember token using `php artisan key:generate`.
Next run `php artisan migrate`, runs migration which creates table in the database specified application .env file.
After all the above has been done the project can be serverd or run using php artisan serve which starts the application using laravel default port 8000 to run it on the system locally.

