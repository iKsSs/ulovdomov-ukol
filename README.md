UlovDomov - úkol
=================

Author: Jakub Pastuszek


Requirements
------------

The application is using PHP version `^7.1`.


Installation
------------

Install dependencies using Composer.

Go to the root directory and run

`$ composer install`

Make directories `temp/` and `log/` writable.


Database
----------------

Import database schema (`database_schema.sql`) and data (`database_data.sql`) to MariaDB.

Customize database login information in `app/config/common.neon`.


Web Server Setup
----------------

For Apache, setup a virtual host to point to the `www/` directory of the project.

Make the Adminer available

- `$ ln -s ../vendor/vrana/adminer/adminer www/adminer`

Finally, you can access the portal on address `http://localhost/`.
