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
@include('form::_components.checkbox', [
    'name'        => 'myCheckbox',
    'labelText'   => 'Choose option(s)', // optional
    'labelClass'  => 'font-huge', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'values'      => ['option1'], // optional default selected
    'disabled'    => true, // optional
])
```
```php
@include('form::_components.file-upload', [
    'name'       => 'myUpload',
    'labelText'  => 'Upload your file',
    'labelClass' => 'font-huge', // optional
    'disabled'   => true, // optional
])
```
```php
@include('form::_components.input', [
    'name'        => 'myTextbox',
    'type'        => 'text', // optional, defaults to 'text'
    'labelText'   => 'Type here',
    'labelClass'  => 'font-huge', // optional
    'value'       => 'Some text', // optional default value
    'placeholder' => 'Some hint', // optional
    'disabled'    => true, // optional
])
```
```php
@include('form::_components.radio', [
    'name'        => 'myRadio',
    'labelText'   => 'Choose an option', // optional
    'labelClass'  => 'font-huge', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'value'       => 'option1', // optional default selected
    'disabled'    => true, // optional
])
```
```php
@include('form::_components.select', [
    'name'        => 'mySelect',
    'labelText'   => 'Choose an option', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'value'       => 'option1', // optional default selected
    'disabled'    => true, // optional
])
```
```php
@include('form::_components.textarea', [
    'name'       => 'myTextarea',
    'labelText'  => 'Type here',
    'labelClass' => 'font-huge', // optional
    'value'      => 'Some text', // optional default value
    'placeholder' => 'Some hint', // optional
    'disabled'   => true, // optional
])
```
```php
@include('form::_components.button', [
    'buttons' => [
        [
            'element'  => 'button', // optional - defaults to button
            'type'     => 'submit',
            'text'     => 'Submit',
            'class'    => 'button--primary',
            'disabled' => true, // optional
        ],
        [
            'element'  => 'a',
            'href'     => 'https://somewhere.com',
            'text'     => 'Cancel',
            'class'    => 'button--secondary',
            'disabled' => true, // optional
        ],
    ],
])
```
