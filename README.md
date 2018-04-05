# yii2-contact-form extension

The extension allows build multi language slider.

## Installation

- Install with composer:

```bash
composer require abdualiym/yii2-contact-form
```

- **After composer install** run console command for create tables:

```bash
php yii migrate/up --migrationPath=@vendor/abdualiym/yii2-contacts/migrations
```

- add to common config file:
```php
'components' => [
    'contact' => [
        'class' => 'abdualiym\contactform\Module',
        'developmentEmail' => 'yourDev@email.com',
    ],
],
```