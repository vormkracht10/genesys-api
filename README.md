# PHP Genesys API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vormkracht10/genesys-api.svg?style=flat-square)](https://packagist.org/packages/vormkracht10/genesys-api)
[![Tests](https://github.com/vormkracht10/genesys-api/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/vormkracht10/genesys-api/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/vormkracht10/genesys-api.svg?style=flat-square)](https://packagist.org/packages/vormkracht10/genesys-api)

This package is a PHP wrapper for the [Genesys](https://www.genesys.com/) API. The package provides a fluent syntax to interact with the API.

## Installation

You can install the package via composer:

```bash
composer require vormkracht10/genesys-api
```

## Usage

### Create Genesys API client

```php
use Vormkracht10\GenesysApi\Genesys;

$accessToken = '{access-token}';

$genesys = Genesys::api(
  region: 'us-west-1', // optional, default is 'us-east-1'
  accessToken: $accessToken
);
```

### Conversations

#### Get conversation by ID

```php
$genesys->conversation()->get(id: '{conversation-id}');
```

#### List conversations

```php
$genesys->conversation()->list();
```

### Users

#### Get user by ID

```php
$genesys->user()->get(id: '{user-id}');

// With parameters
$genesys->user()->get(id: '{user-id}', params: ['expand' => 'languagePreference']);
```

#### List users

```php
$genesys->user()->list();
```

#### Create user

```php
$genesys->user()->create([
  'name' => 'Test',
  'department' => 'Test Department',
  'email' => 'test@testdepartment.com',
  'addresses' => [],
  'title' => 'Lorem Ipsum',
  'password' => 'P1hQrt4WytLxz2gF%LYc',
  'divisionId' => null,
  'state' => 'active',
])
```

#### Update user

```php
$genesys->user()->update(
  id: '{user-id}',
  params: [
    'name' => 'New name',
]);
```

#### Delete user

```php
$genesys->user()->delete(id: '{user-id}');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Bas van Dinther](https://github.com/vormkracht10)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
