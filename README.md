# Web-based Inventory System

Web-based inventory system is I think the most requested software by small and medium business. I addressed the issue by building an application based on Codeigniter that has the four major functions of an inventory system: product management, purchase order, user management, and login system.


## Installation  (the simple way)

1. install xampp in your system
2. go to xampp control panel and start Apache and Mysql
2. using phpmyadmin create database called     cp_inventory_system
3. import the cp_inventory_system.sql to the database you've just created

NOTE: Latest sql backup is found in: [install directory]/[install folder]/backups/cp_inventory_system.sql

4. put the folder inventory_system into the xampp directory (ex. C:/xampp/htdocs )
5. go to the browser and type http://localhost/inventory_system

default inventory system user:

username: admin
password: admin

6. if all else fails, email me at ecasanes@gmail.com



## What the system does as of the moment

1. add product
2. edit product
3. add category via add product interface
4. add subcategor via add product interface
5. initiate purchase order
6. cancel purchase order
7. add user
8. edit user
9. login
10. logout

New! as of Feb 26, 2014

11. Report - Out of stock Items
12. Report - Sales


## Todo

1. Category management page



## There is room for improvement

Pull requests for this project are definitely on my watch as I am also finding a lots of bugs and wanted
some help for developers out there who is interested in my work.


## Licence

Copyright (c) 2014 Ernest Oliver Casanes, http://www.ecasanes.github.io

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.