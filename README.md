## API LEAD MANAGEMENT
This is a simple project API for Lead Management
### Requirement

 - PHP version 8.2
 - Composer
 - Database MySQL 8
 - Postman 
 
### How to get started?
After clone this project,

Create database with name `api_gx_lead`

and then simply run

```bash
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    php artisan serve
```
Access application http://localhost:8000/

### API Documentation
You can import collection and environtment located in `docs/` with postman 
