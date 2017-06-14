# Form Components

Commonly used form components for POD Point websites, written in [Blade](https://laravel.com/docs/master/blade) and designed to work with the [old](https://github.com/Pod-Point/ui-toolkit/) and [new](https://github.com/Pod-Point/pod-point-ui-toolkit) POD Point UI toolkits.

## Installation

Clone the repository:

```bash
git clone git@github.com:Pod-Point/form-components.git
```

Install the PHP dependencies*:

```bash
cd form-components
composer install
```

## Laravel

You can also include these components in Laravel applications via composer. First you need to add the repository to your `composer.json`:

```javascript
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:pod-point/form-components.git"
    }
]
```

Then require the package:

```javascript
"require": {
    "pod-point/form-components": "^1.0"
},
```

And finally include the service provider in your `config.app.php` file:

```php
PodPoint\FormComponents\FormComponentsServiceProvider::class,
```

Then you will be able to access the components with the `form::` package prefix.

```php
@extends('form::_components.button')
@extends('form::_components.checkbox')
@extends('form::_components.file-upload')
@extends('form::_components.input')
@extends('form::_components.radio')
@extends('form::_components.select')
@extends('form::_components.textarea')
```
