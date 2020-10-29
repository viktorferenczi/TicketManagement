# TicketManagement


Customers can submit tickets in a public page, admins can registen/login and view customers, tickets, and the tickets for a specific customer.


Customers do not have access to admin routes thanks to a verification code.

The admin verification code is: 12345


Admin verification code is stored in the .env file. 


Admins have to go through a verification process, enter the code which will be stored in the config/session, and a custom created middleware verifies that they have access to the admin panel.


Admins have to type the code only once until they are logging out.


A customer have multiple tickets and a customer is stored only once in the database. 


Customer email must be unique, and customer email-name combination must be unique also!(make sure of impersonating problem)


If a customer name and email combination is stored in the database, a new person can not submit a ticket with the same email and different name.
