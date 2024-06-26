# EHU Timetabler

[![Code Analysis](https://github.com/danbracey/EHU-Timetabler/actions/workflows/larastan.yml/badge.svg)](https://github.com/danbracey/EHU-Timetabler/actions/workflows/larastan.yml)
[![Laravel](https://github.com/danbracey/EHU-Timetabler/actions/workflows/laravel.yml/badge.svg)](https://github.com/danbracey/EHU-Timetabler/actions/workflows/laravel.yml)
[![PHP CodeSniffer (PSR-12)](https://github.com/danbracey/EHU-Timetabler/actions/workflows/linter-psr-12.yml/badge.svg)](https://github.com/danbracey/EHU-Timetabler/actions/workflows/linter-psr-12.yml)

## About EHU Timetabler
EHU Timetabler is a final year student project, aimed at automatic generation of the student timetable that allows students to view their timetable at a glance by entering their Student ID. 

##Login details
To login, please click on the 'Log in' text in the top right of the navigation bar, and use the following details:
- Username: 24969761@edgehill.ac.uk
- Password: password

Should there be an issue building this project, please see the YouTube (Link contained within Report links section) or the MP4 saved within the V: drive, entitled 'Project Proof Video'.

## Building the project
### Pre-requisites
- PHP
- Composer
- Node > 18
- NPM

Clone the repository from GitHub
```
git clone https://github.com/danbracey/EHU-Timetabler.git
```

Change directory to the project
```
cd EHU-Timetabler
```

Install composer
```
composer install
```

Install npm
```
npm install
```

Build
```
npm run build
```

Copy example environment to production
```
cp .env.example .env
```

Migrate the database afresh and seed.
```
php artisan migrate:fresh --seed
```

>Warning - Skipping this step WILL cause a 500 error due to missing sqlite file.

Set an application encryption key
```
php artisan key:generate
```

>Warning - Skipping this step WILL cause a 500 error due to missing application encryption key.

Serve the application
```
php artisan serve
```

You should now be able to visit the application at http://localhost:8000
