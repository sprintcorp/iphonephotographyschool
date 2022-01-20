## Project Overview

This solution uses laravel event lsiteners to watch for customers activities on cousrse to unlock different badges base on achievemnet users attained. All implementations are backed with tests.



## Project setup


- Clone the project from repository using the `git clone https://github.com/sprintcorp/iphonephotographyschool.git` into a directory on your pc
- Move to project directory `cd iphonephotographyschool` 
- Run `composer install` to install all packages.
- When the above step has been done you the proceed to create database, the database use during development is mysql database and Eloquent ORM is used to interact with the database,
- Create a .env file the copy .env.example to create enviroment variable for this application which houses simple configuration text file that is used to define some variables passed into the application's environment,
- Generate app key which is needed for the application to function properly used for all encrypted data, like sessions,Password, remember token using `php artisan key:generate`.
- Run `php artisan migrate` which creates table in the database specified application .env file.
- Run `php artisan db:seed` to seed data into the database
- Run using `php artisan serve` which starts the application using laravel default port 8000 to run it on the system locally.

## Usage

- Log onto `localhost:8000/users/{user}/achievements` where `{user}` is user_id

#### Response

    {
        "unlocked_achievements": [
            "First Lesson Watched",
            "First Comment Written"
            ],
        "next_available_achievements": {
            "comment_achievement": "3 Comments Written",
            "lesson_achievement": "5 Lessons Watched"
        },
        "current_badge": "Beginner",
        "next_badge": "Intermediate",
        "remaining_to_unlock_next_badge": 4
    }

