e-school:
===============================
school management system usgin laravel, filament 



## Installation (using doker /laravel sail)
- clone this repository `git clone https://github.com/muhammed-ali-topcu/e-school e-school`
- cd into the project directory `cd e-school`
- run `cp .env.example .env`
- ensure stop all process that use ports 80, 3306, 8080 

run  commands:
- `sudo docker run --rm     -u "$(id -u):$(id -g)"     -v "$(pwd):/var/www/html"     -w /var/www/html     laravelsail/php82-composer:latest     composer install --ignore-platform-reqs`

- `sudo chmod +777 -R .` // in linux only
- `sail up -d` 
- generate applicaitonkey by running `sail artisan key:generate`. 

- `sail artisan migrate --seed`
- `sail artisan cache:clear`
- `sail npm i`
- `sail npm run build`

open  http://localhost/ in browser


