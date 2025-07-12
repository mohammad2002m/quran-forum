# Quran Forum Project

## Running the app locally
- Install docker and make sure it's binaries are added to your PATH
- Open the Cmd in the project directory
- Run `docker compose up -d --build`
- Open Docker Desktop, check the container logs and see when it finishes installing the packages/dependencies then move to the next step
- Run this command to setup the database with sample data: `docker compose exec app php artisan migrate:fresh --seed`
- The app should be running successfully on `localhost:8000`

