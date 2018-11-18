![Studeo Logo](public/images/logo.png)
# opening-opportunities-Studeo
A platform to help students learn faster and easier for the baccalaureate exam


## Installation:
```bash
~ composer install && npm install
```
##### php.ini configuration
In order to be able to upload large files you should edit your `php.ini` file and set:
```apacheconfig
memory_limit = 32M
upload_max_filesize = 24M
post_max_size = 32M
```
You will also need to restart apache after that.

## Database seeding
After you have `php artisan migrate`d the database, run the database seed command
```bash
~ php artisan db:seed
```

11 fake users will be added to you database and you can now login with the standard `sandel` user, email: `sandel@sandica.com` and the password: `123456`
