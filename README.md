<p align="center"><a href="https://github.com/devmaster0322/lead-reviver"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Leadreviver Saas Platform
<a href="./resources/docs/1.0/index.md">Index</a><br>

## Installation

```php 
APP_URL=http://your-url.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Saasify
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=Your-stripe-key
STRIPE_SECRET=Your-stripe-secret
CASHIER_CURRENCY=usd
TRIAL_DAYS_NO_PAYMENT_REQUIRE=10
ADMIN_EMAIL=your-admin-email
```
#### Composer Dependencies

Install all the composer dependencies by running the following command:

```php
composer install
```

```php
npm install && npm run dev
```
<br>

xMigrate the database by runing :

```php
php artisan migrate
```

Next seed the database with the following command: :
```php
php artisan db:seed
```
<br>

You should link the `public/storage` directory to your `storage/app/public` directory. Otherwise, user profile photos stored on the local disk will not be available:

```php
php artisan storage:link
```
<br>

For security measures you may regenerate your application key, be sure to run the following command below:
```php
php artisan key:generate
```
<br>
🎉 Congratulations! You will now be able to visit your URL and see your new SaaS application up and running.

<a name="section-4"></a>
<br>

#### Login to your application
You can login with credentials:
Email: `admin@admin.com` and Password: `admin123`
or register to create a new user.

### Billing & Subscription
The Next step is to setup stripe credentials and start create plans, coupons on admin dashboard.
For more info go to <a href="/{{route}}/{{version}}/subscription">Plan & Billing</a> section
