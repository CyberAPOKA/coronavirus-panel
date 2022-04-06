## About the project
## This project was made to show data about the pandemic in the city of São Leopoldo, RS - Brazil. It is in production at the following link: https://www.saoleopoldo.rs.gov.br/coronavirus

##
You can download the project or use the command ``` git clone https://github.com/CyberAPOKA/coronavirus-panel.git ```, configure your .env and
then open the project in your editor and type the following commands in the terminal, 
``` composer install ```, ``` php artisan migrate --seed ``` and then ``` php artisan serve ```, the project is already running in local environment ``` 127.0.0.1:8000 ```. it is important that you use --seed in migrate so that faker data is created for you to test the system in a more efficient way, super admin user is created in --seed:<br>
email:admin@admin<br>
password:Admin123 
