## The steps to run sign-controller with docker

1. clone a git repo and  go to `sign-controller` directory

2. Create .env:  
   - Run `sudo cp src/.env.example src/.env`
   - Open src/.env and configure env variables

3. Run `sudo docker-compose build`

4. Run `sudo docker-compose up` if no any error

5. Install php dependencies:  
   - Run `sudo docker-compose exec php composer install`
   - It will install php dependencies and as a result, `vendor` directory will be created in `/var/www/html/`

6. Database migration:
   - Run `sudo docker-compose exec php php /var/www/html/artisan db:seed`
   - Run `sudo docker-compose exec php php /var/www/html/artisan migrate`
