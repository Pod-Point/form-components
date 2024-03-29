# Form Components

Commonly used form components to make it easier and more flexible to create forms in [Blade](https://laravel.com/docs/master/blade) views.

It is intended to be usable by anyone.

For ease of use by [Pod Point](https://pod-point.com) staff, when classes are not specified they default to those used in the [Pod Point UI toolkit](https://github.com/Pod-Point/pod-point-ui-toolkit).

## Editing

To edit this project, clone the repository:

```bash
git clone git@github.com:Pod-Point/form-components.git
```

Install the PHP dependencies:

```bash
cd form-components
composer install
```

## Laravel installation

More commonly, you'll want to import these components for use in Laravel applications (or other frameworks that use Blade).

To install it using Composer, require the package:

```bash
composer require pod-point/form-components:^3.0
```

Then in Laravel, include the service provider in your `config/app.php` file:

```php
PodPoint\FormComponents\FormComponentsServiceProvider::class,
```

## Usage

You can insert components into Blade views using the `form::` package prefix.

### Examples
Button
```php
@include('form::_components.button', [
    'name'     => 'myButton', // optional, sets name and id
    'element'  => 'button', // optional, defaults to button
    'text'     => 'Submit',
    'attributes' => [ // optional
        'type'     => 'submit',
        'disabled' => true,
        ...
    ],
    'classes' => [ // optional
        'input' => 'myInputClass', // button - defaults to 'btn'
    ],
])

@include('form::_components.button', [
    'element'  => 'a',
    'text'     => 'Cancel',
    'attributes' => [ // optional
        'href' => 'http://somewhere',
        ...
    ],
])
```
Checkbox
```php
@include('form::_components.checkbox', [
    'name'        => 'myCheckbox', // sets name and id
    'labelText'   => 'Choose option(s)', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'values'      => ['option1'], // optional default selected values
    'attributes' => [ // optional
        'disabled' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // outermost container div - defaults to 'form__group'
        'label' => 'myLabelClass', // span that appears above all checkboxes - defaults to 'form__label'
        'inputContainer' => 'myInputContainerClass', // label element container wrapping around each checkbox - defaults to 'checkbox form__field'
        'input' => 'myInputClass', // input checkbox element - defaults to 'form__control'
    ],
])
```
File upload
```php
@include('form::_components.file-upload', [
    'name'       => 'myUpload', // sets name and id
    'labelText'  => 'Upload your file', // optional
    'attributes' => [ // optional
        'disabled' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // container div - defaults to 'form__group'
        'label' => 'myLabelClass', // label that appears above input - defaults to 'form__label'
        'input' => 'myInputClass', // input file upload element - defaults to 'form__control form__field'
    ],
])
```
Text/password input
```php
@include('form::_components.input', [
    'name'        => 'myTextbox', // sets name and id
    'type'        => 'text', // optional, defaults to 'text'
    'value'       => 'Some text', // optional default value
    'labelText'   => 'Type here', // optional
    'explanation' => 'Explanation copy', // optional
    'attributes' => [ // optional 
        'placeholder' => 'A hint to the user',
        'required' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // container div - defaults to 'form__group'
        'label' => 'myLabelClass', // label that appears above input - defaults to 'form__label'
        'input' => 'myInputClass', // input element - defaults to 'form__control form__field'
    ],
])
```
Radio button(s)
```php
@include('form::_components.radio', [
    'name'        => 'myRadio', // sets name and id
    'labelText'   => 'Choose an option', // optional
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'value'       => 'option1', // optional default selected value
    'attributes' => [ // optional
        'disabled' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // outermost container div - defaults to 'form__group'
        'label' => 'myLabelClass', // span that appears above all radio buttons - defaults to 'form__label'
        'inputContainer' => 'myInputContainerClass', // label element container wrapping around each radio button - defaults to 'radio form__field'
        'input' => 'myInputClass', // input radio element - defaults to 'form__control'
    ],
])
```
Select dropdown
```php
@include('form::_components.select', [
    'name'        => 'mySelect', // sets name and id
    'labelText'   => 'Choose an option',
    'options'     => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ],
    'value'       => 'option1', // optional default selected value
    'attributes' => [ // optional 
        'required' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // outermost container div - defaults to 'form__group'
        'label' => 'myLabelClass', // label that appears above input - defaults to 'form__label'
        'inputContainer' => 'myInputContainerClass', // div container wrapping around select - defaults to 'select form__field'
        'input' => 'myInputClass', // select element - defaults to 'form__control'
    ],
])
```
Textarea
```php
@include('form::_components.textarea', [
    'name'       => 'myTextarea', // sets name and id
    'labelText'  => 'Type here', // optional
    'value'      => 'Some text', // optional default value
    'attributes' => [ // optional 
        'placeholder' => 'A hint to the user',
        'required' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // container div - defaults to 'form__group'
        'label' => 'myLabelClass', // label that appears above input - defaults to 'form__label'
        'input' => 'myInputClass', // textarea element - defaults to 'form__control form__field'
    ],
])
```

Grouped typeahead select (Please note this depends on the [typeahead](https://pod-point.github.io/pod-point-ui-toolkit/typeahead.html) JS file)
```php
@include('form::_components.grouped-typeahead', [
    'name'        => 'phoneNumber', // sets name and of the number field
    'countryName' => 'country', // sets name and id of the country select field
    'labelText'   => 'Type here', // optional
    'options'     => $countryCodeOptions,
    'value'       => 'GB',
    'attributes' => [
        'required' => true,
        ...
    ],
    'classes' => [ // optional
        'formGroup' => 'myFormGroupClass', // outermost container div - defaults to 'form__group'
        'label' => 'myLabelClass', // label that appears above input - defaults to 'form__label'
    ],
])
```

### Attributes
Some key attributes e.g. `name` can be set directly (see examples above for each component).

For all components, any additional attributes can be set using the `attributes` array.  These are optional.

`attributes` can take text values where needed, e.g. 
```php
...
    'attributes' => [
        'type' => 'submit',
    ],
...
```
or they can take boolean values - if a boolean value is used the attribute will be included if true e.g. `<input disabled>` or omitted if false e.g. `<input>`
```php
...
    'attributes' => [
        'disabled' => true,
    ],
...
```

### Classes
For all components, all `classes` are optional.

If an element's class is not specified, it defaults to the appropriate class(es) from the Pod Point UI toolkit - see each component below for details.

If you want an element to have no class set at all, set that element's class to `''` e.g.
```php
...
    'classes' => [
        'input' => '',
    ],
...
```
