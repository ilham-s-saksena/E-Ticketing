## About
E-Ticketing Website

## Requirements

- Web Server (Apache, Nginx or Etc)
- PHP Version ^8.2
- Database (MySql)
- php-gd extension
- Composer
- NodeJs (npm)

## Installation

1. Clone the repository to your local machine: 
    
    ```bash
    git clone git@github.com:ilham-s-saksena/E-Ticketing.git
    ```
2. Change the Directory:
    ```bash
    cd E-Ticketing
    ```   
3. Install Dependencies: 
    
    ```bash
    composer install
    ```

3. Copy The .env.example to .env: 
    
    ```bash
    cp .env.example ./.env
    ```

4. Generate app key: 
    
    ```bash
    php artisan key:generate
    ```


5. Set database connection to your database in the .env file.: 
    
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

    ```


6. Run Migration: 
    
    ```bash
    php artisan migrate --seed
    ```


7. Install UI Dependencies: 
    
    ```bash
    npm install
    ```


8. Build UI: 
    
    ```bash
    npm run build
    ```
    
9. Run the app
    
    ```bash
    php artisan serve
    ```

10. Open the app
