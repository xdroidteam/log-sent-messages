# Log sent messages
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](http://choosealicense.com/licenses/mit/)



### Log the sent emails to database
![Screenshot](https://github.com/xdroidteam/images/raw/master/logsentmessagesUI.png)

## Installation

Require this package in your **composer.json** and run composer update:

    "xdroidteam/log-sent-messages": "0.1.*"

**or run**
```shell
composer require xdroidteam/log-sent-messages
```
directly.


<br>
After updating composer, add the ServiceProvider to the providers array in **config/app.php**
```php
XdroidTeam\LogSentMessages\LogSentMessagesProvider::class
```
<br>
Deploy migration and config file.
```shell
php artisan vendor:publish --tag=xdroidteam-logsentmessages
```
You need to run the migrations for this package.
```shell
php artisan migrate
```
<br>
