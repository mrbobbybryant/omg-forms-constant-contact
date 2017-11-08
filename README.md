# OMG Forms: Constant Contact Addon

A WordPress Forms Solution built specifically for Developers. This addon will send all form submissions to Constant Contact.

## Installation
OMG Forms can be installed via composer.
```sh
$ composer require developwithwp/omg-forms-constant-contact
```

Once you have installed this package you will need to call Composer's autoloader if your project is not already.
```php
if ( file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
    require( 'vendor/autoload.php' );
}
```

## Usage
You are now ready to create your first form. OMG Forms comes with a helper method for creating new forms `\OMGForms\Core\register_form()`.

This function expects an array of arguments similar to how `register_post_type` expects an array of arguments.

To start lets define a very simple form.

```php
$args = [
		'name'              =>  'constant-contact-form',
		'redirect'          =>  false,
		'email'             =>  false,
		'form_type'         =>  'constant-contact',
		'success_message'   =>  'Thank you!',
        'rest_api'          =>  true,
		'fields' => [
			[
				'slug'      =>   'fname',
				'label'     =>   'First Name',
				'type'      =>   'text',
				'required'  =>   true
			],
			[
				'slug'      =>   'lname',
				'label'     =>   'Last Name',
				'type'      =>   'text',
				'required'  =>   true
			],
			[
				'slug'      =>  'email-address',
				'label'     =>  'Email',
				'type'      =>  'email',
				'required'  =>   true
			]
		]
	];
```

As you can see the form allows for a lot of configuration at both the form and the field level.

Once you have defined a form, you can render it by calling `display_form`.
```php
echo \OMGForms\Core\display_form( 'constant-contact-form' );
```

## Notes
For the Constant Contact addon to work you will need to ensure you provide a few key settings when registering your form.
1. `form-type` must be set to `constant-contact`
2. `rest_api` must be set to `true`.
4. First and Last Name fields should have a slug of `fname` and `lname`.
5. Must provide an email field with a slug of `email-address`.

For more information about OMG Forms in general, please check out the [base repo](https://github.com/mrbobbybryant/omg-forms).
