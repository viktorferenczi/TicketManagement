# TicketManagement
----------------------------

Customers can submit tickets in a public page, admins can registen/login and view customers, tickets, and the tickets for a specific customer.


Customers do not have access to admin routes thanks to the verification code.

 !!!!! The admin verification code is: 12345 !!!!!


Admin verification code is stored in the .env file. 


Admins have to go through a verification process, enter the code which will be stored in the config/session, and a custom middleware verifies that they have access to the admin panel.


Admins have to type the code only once until they are logging out.


A customer have multiple tickets and a customer is stored only once in the database. 


Customer email must be unique, and customer email-name combination must be unique also!(make sure of impersonating problem)


If a customer name and email combination is stored in the database, a new person can not submit a ticket with the same email and different name.

------------------------------
# Installation

1.
rename ".env.example" file to ".env"  - enable .env file


2.
create file: "database.sqlite" in the "database" folder  - we are using SQLite.

3.
composer install - command cmd/terminal - install requirements

4.
php artisan migrate - command cmd/terminal - migrate the DB with the help of migrations

5.
php artisan serve - server run. default port: 8000
