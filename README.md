## Quran Forum Project

# Running the app locally
- Install docker and make sure binaries are added to you PATH
- Open the Cmd in the project directory
- Run `docker compose up -d`
- Run this command to setup the database with data: `docker compose exec app php artisan migrate:fresh --seed`