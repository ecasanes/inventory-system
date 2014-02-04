INSTALLATION STEPS

1. install xampp in your system
2. go to xampp control panel and start Apache and Mysql
2. using phpmyadmin create database called     cp_inventory_system
3. import the cp_inventory_system.sql to the database you've just created
4. put the folder inventory_system into the xampp directory (ex. C:/xampp/htdocs )
5. go to the browser and type http://localhost/inventory_system

default user:

username: admin
password: admin


6. if all else fails, email me at ecasanes@outlook.com


WHAT THE SYSTEM DOES AS OF THE MOMENT

1. add/edit product
2. add purchase order
3. cancel purchase order - 	we are not allowing edit of purchase order so that the system is useful for recording
							purchases that are cancelled for some purpose.
							Edit will just make the user cover tracks in the transaction.
4. add user
5. edit user
6. login/logout with md5 security