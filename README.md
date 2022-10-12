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

### Authentication

This package only provides a way to interact with the API. To handle the authentication logic we created the [oauth2-genesys](https://github.com/vormkracht10/oauth2-genesys) package which provides a [league/oauth2-client](https://github.com/thephpleague/oauth2-client) provider for Genesys.

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
$genesys->conversations()->get(id: '{conversation-id}');
```

#### List conversations

```php
$genesys->conversations()->list();
```

### Users

#### Get user by ID

```php
$genesys->users()->get(id: '{user-id}');

// With parameters
$genesys->users()->get(id: '{user-id}', params: ['expand' => 'languagePreference']);
```

#### List users

```php
$genesys->users()->list();
```

#### Create user

```php
$genesys->users()->create([
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
$genesys->users()->update(
  id: '{user-id}',
  params: [
    'name' => 'New name',
]);
```

#### Delete user

```php
$genesys->users()->delete(id: '{user-id}');
```

### Queues

#### Get queue by ID

```php
$genesys->queues()->get(id: '{queue-id}');
```

#### List queues

```php
$genesys->queues()->list([
  'pageNumber' => 1,
  'pageSize' => 25,
  'sortOrder' => 'desc',
]);
```

#### Create queue

```php
$genesys->queues()->create([
  'name' => 'Test queue'
]);
```

#### Update queue

```php
$genesys->queues()->update(
  id: '{queue-id}',
  params: [
    'name' => 'New name',
]);
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
