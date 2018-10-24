# ATM Simulation
A simulation for money dispense of ATM

___
## Tech Stack
Language: PHP
Framework: Laravel, the most powerful PHP MVC framework comes with many useful stuffs
Database: MySQL  ( to store the bank notes data of the machine)

Libraries:
- jQuery = for easier DOM handling, allow to do DOM selection in very convenient way
- Bootstrap = the most popular CSS framework for layout
- Font Awesome = the popular icon font set for some decoration

___
## How to run on OSX

1. Follow this guide (https://www.webucator.com/how-to/how-install-start-test-xampp-on-mac-osx.cfm) to install XAMPP on OSX.
2. After you can get XAMPP up and running, install Composer globally with this guide (https://getcomposer.org/doc/00-intro.md).
3. Clone my repository into your ‘htdocs’ directory of Xampp installation path.
4. Enter the phpMyAdmin page (in case you don’t have MySQLWorkbench installed) and create database name ‘atm’.
5. Enter the ‘atm’ database page and execute SQL file from ‘[project_folder]/storage/sql/atm.sql’.
6. Go back to the project directory and duplicate file name ‘.env.example’ and rename it to ‘.env’.
7. Open up the .env file in 6.) in text editor and edit your database connection info.  Save and close it.
8. Now open up Terminal and go to the project directory and run ‘composer install’ and wait until it finished.
9. Then, if you already have both MySQL and Apache in XAMPP up and running, you should be able to see the app at http://localhost/{project_folder_name}/public in your browser.
10. If above url is too difficult to enter, follow this guide (https://jonathannicol.com/blog/2012/03/11/configuring-virtualhosts-in-xampp-on-mac/) to configure virtual host for customizing the custom url for the project.

In case you can’t get it run or can’t see the app, I’ve hosted the full working example at http://show.sundayparty.net/dispense, feel free to play around.
___
### How to run test
Simply use the Terminal and enter the folder and run this command
```
./vendor/bin/phpunit
```
