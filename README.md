![super-basic-auth](https://user-images.githubusercontent.com/11269635/31586185-1bd6a6b2-b1ce-11e7-97a0-bae16ccb1266.jpg)

# Super Basic Auth

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-circleci]][link-circleci]
[![StyleCI][ico-styleci]][link-styleci]

This is a super lightweight package to add the most basic form of authentication
to your Laravel app. All you need is a webserver and a text editor!

## Index
- [Installation](#installation)
  - [Downloading](#downloading)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Installation
You'll have to follow a couple of simple steps to install this package.

### Downloading
Via [composer](http://getcomposer.org):

```bash
$ composer require sven/super-basic-auth
```

Or add the package to your dependencies in `composer.json` and run
`composer update` on the command line to download the package:

```json
{
    "require": {
        "sven/super-basic-auth": "^1.0"
    }
}
```

## Usage
To use this package, first add the following code to your `config/auth.php` file:

```php
return [
    // ...

    'basic' => [
        'user' => env('AUTH_USERNAME'),
        'password' => env('AUTH_PASSWORD'),
    ],
];
```

Be sure to add `AUTH_USERNAME` and `AUTH_PASSWORD` to your `.env` file. You can of course
name these entries anything you want.

Finally, apply the middleware to any route you want protected by that username and
password combination:

```php
Route::group('admin', function () {
    // Your password protected routes.
})->middleware(\Sven\SuperBasicAuth\SuperBasicAuth::class);
```

## Contributing
All contributions (pull requests, issues and feature requests) are
welcome. Make sure to read through the [CONTRIBUTING.md](CONTRIBUTING.md) first,
though. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/super-basic-auth` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/super-basic-auth.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/super-basic-auth.svg?style=flat-square
[ico-circleci]: https://img.shields.io/circleci/project/github/svenluijten/super-basic-auth.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/107023626/shield

[link-packagist]: https://packagist.org/packages/sven/super-basic-auth
[link-downloads]: https://packagist.org/packages/sven/super-basic-auth
[link-circleci]: https://circleci.com/gh/svenluijten/super-basic-auth
[link-styleci]: https://styleci.io/repos/107023626
