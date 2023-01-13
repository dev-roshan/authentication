# LUMEN + PASSPORT + DOCKER WITH PHP 8.2
- This repo uses lumen framework and passport. And it has ready to go authentication module.
- [LUMEN]('https://lumen.laravel.com/docs/9.x') [PASSPORT]('https://laravel.com/docs/9.x/passport')

# LOCAL INSTALLATION
- clone the repo
- copy env.example as .env and populate the settings. ( you do not need to worry about the variable below ## DOCKER_ENV i.e for docker )
- lumen does not have key:generate feature, so there is api {app_url}/key to generate, visit that and paste the key to `APP_KEY` in env.
- run `composer install` to install the dependencies.
- run `php artisan migrate` to migrate the tables.
- run `php artisan passport:install` to install the passport.

# Docker Setup
- IF YOU CHANGE Anything after the section `## DOCKER_ENV` then it is up to you to setup everything.
- IF YOU DO NOT CHANGE and copy as it is from .env.example, Env setup:
    - Set `DB_HOST` as `auth-database`
    - Set `DB_PORT` whatever you like but make sure it is available and is not used by any other service.
    - You can give anything for `DB_DATABASE` , `DB_USERNAME` and `DB_PASSWORD`.
- create `data` and `logs` folder in root directory.
- run `docker-compose build`.
- run `docker-compose up -d`.
- run `docker exec AUTH-php82 php artisan migrate` to run migration. 

# NOTE
- please populate env `FRONTEND_ENDPOINTS` with your frontend endpoints, for cors issue.

## authentication routes
- `{app_url}/register` for user registration. Make sure to setup mail settings. (It will send the user verification mail)
- `{app_url}/login` to retrieve the user auth token.



