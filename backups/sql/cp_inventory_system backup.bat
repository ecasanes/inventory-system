REM Export all data from this database
cd C:\xampp\mysql\bin

REM To export to file (structure only **--skip-extended-insert**)
set backupFilename=
mysqldump -u root cp_inventory_system > C:\xampp\htdocs\inventory_system\backups\sql\cp_inventory_system_%DATE:~4,2%-%DATE:~7,2%-%DATE:~10,4%.sql