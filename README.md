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
    'contactform' => [
        'class' => 'abdualiym\contactform\Module',
        'developmentEmail' => 'yourDev@email.com',
    ],
],
```
- add to common config file:
```php
'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'login @yandex.ru',
                'password' => '*****',
                'port' => '465',
                'encryption' => 'ssl', // у яндекса SSL
            ],

            'useFileTransport' => false, // будем отправлять реальные сообщения, а не в файл
        ],
```