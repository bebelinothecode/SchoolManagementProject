## Laravel School Management System (LSMS)

**LSM System** is a simple role based school management system.

### How to make it work
01. `git clone https://github.com/sanz/laravel-school-management-system.git`
02. `cd laravel-school-management-system`
03. `In your .env file, enter these credentials
    DB_CONNECTION=pgsql
    DB_HOST=db
    DB_PORT=5432
    DB_DATABASE=siimt
    DB_USERNAME=bebelino
    DB_PASSWORD=password`
04. `Enter this command in the terminal: docker-compose up --build -d`
5. `Access the application at localhost:8000`


### Packages
01. `spatie/laravel-permission`

### Credentials

To test application the database is seeding with users :

-   Admin : email = admin@demo.com, password = 12345678 and Role: Admin
-   Teacher : email = teacher@demo.com, password = 12345678 and Role: Teacher
-   Parent : email = parent@demo.com, password = 12345678 and Role: Parent
-   Student : email = student@demo.com, password = 12345678 and Role: Student
