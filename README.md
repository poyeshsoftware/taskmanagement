### Video Introduction 
 [https://payam.pro/taskmanagement.mp4](https://payam.pro/taskmanagement.mp4) 
 
## Task Management Project By Payam Ghader Kourehpaz
- you have the ability to make projects and asociate tasks to the projects.
- you have the ability to drag project or task items to resort them and the sorting will be updated automatically

Laravel is the web application framework ,I used Laravel Sanctum(Airlock) for authentication, TailWindCss And Vue.Js for the front-end.
Also It has the authorization via policies that has been handled in the routing section.

I've also implemented Repository Design Pattern on the project.

## Step by Step Guideline for Installing Project

- run command : composer install
- run command : npm install 
- change .env.example File to .env and setup .env database information
- set SANCTUM_STATEFUL_DOMAINS in bottom of .env file to your domain name
- run command : php artisan key:generate
- run command : php artisan migrate
- run command : npm rum watch
- run command : php artisan serve

#### Notice
- don't forget to set SANCTUM_STATEFUL_DOMAINS in bottom of .env file to your domain name

## Made By :
Payam Ghader Kourehpaz [https://payam.pro](https://payam.pro)


