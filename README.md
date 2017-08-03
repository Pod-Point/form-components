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
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'values'      => ['option1'], // optional default selected
    'disabled'    => true, // optional
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label span that appears above all checkbox(es) - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'inputContainer' => 'myInputContainerClass', // label element that contains input - defaults to 'checkbox'
        'input' => 'myInputClass',                   // checkbox input element(s) - defaults to blank
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
])
```
```php
@include('form::_components.file-upload', [
    'name'       => 'myUpload',
    'labelText'  => 'Upload your file',
    'disabled'   => true, // optional
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label span that appears above input - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'input' => 'myInputClass',                   // input element - defaults to 'form__control button button--default upload'
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
])
```
```php
@include('form::_components.input', [
    'name'        => 'myTextbox',
    'type'        => 'text', // optional, defaults to 'text'
    'labelText'   => 'Type here',
    'value'       => 'Some text', // optional default value
    'placeholder' => 'Some hint', // optional
    'disabled'    => true, // optional
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label span that appears above input - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'input' => 'myInputClass',                   // input element - defaults to 'form__control'
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
])
```
```php
@include('form::_components.radio', [
    'name'        => 'myRadio',
    'labelText'   => 'Choose an option', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'value'       => 'option1', // optional default selected
    'disabled'    => true, // optional
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label span that appears above all radio button(s) - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'inputContainer' => 'myInputContainerClass', // label element that contains input - defaults to 'form__label radio'
        'input' => 'myInputClass',                   // radio input element(s) - defaults to 'form__control'
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
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
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label span that appears above dropdown - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'inputContainer' => 'myInputContainerClass', // div element that contains select - defaults to 'select-wrapper'
        'input' => 'myInputClass',                   // select element - defaults to 'form__control'
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
])
```
```php
@include('form::_components.textarea', [
    'name'       => 'myTextarea',
    'labelText'  => 'Type here',
    'value'      => 'Some text', // optional default value
    'placeholder' => 'Some hint', // optional
    'disabled'   => true, // optional
    'classes' => [ // all optional, each class's default is used unless a value is set (use '' for blank)
        'fieldRow' => 'myFieldRowClass',             // outermost div - defaults to 'form__group field-row'
        'hasContent' => 'myHasContentClass',         // outermost div - defaults to 'hasContent' if had value when form previously submitted
        'hasError' => 'myHasErrorClass',             // outermost div - defaults to 'hasError' if validation error with user input when form previously submitted
        'label' => 'myLabelClass',                   // text label that appears above input - defaults to 'form__label'
        'fieldWrapper' => 'myFieldWrapperClass',     // second-level div - defaults to 'form-field-wrapper'
        'input' => 'myInputClass',                   // textarea element - defaults to 'form__control'
        'errorMessage' => 'myErrorMessageClass',     // error message span - defaults to 'form__error'
    ],
])
```
```php
@include('form::_components.button', [
    'buttons' => [
        [
            'element'  => 'button', // optional - defaults to button
            'type'     => 'submit', // optional
            'text'     => 'Submit',
            'class'    => 'myButtonClass', // optional - defaults to 'button button--default'
            'disabled' => true, // optional
        ],
        [
            'element'  => 'a',
            'href'     => 'https://somewhere.com',
            'text'     => 'Cancel',
            'class'    => 'myOtherButtonClass', // optional - defaults to 'button button--default'
        ],
    ],
    'classes' => [ // optional, class's default is used unless a value is set (use '' for blank)
        'inputContainer' => 'myInputContainerClass', // div element that contains buttons - defaults to 'form-action-buttons'
    ],
])
```
