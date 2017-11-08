<?php

if ( !defined( 'OMG_FORMS_CC_VERSION' ) ) {
	define( 'OMG_FORMS_CC_VERSION', '0.0.1' );
}

if ( !defined( 'OMG_FORMS_CC_DIR' ) ) {
	define( 'OMG_FORMS_CC_DIR', dirname( __FILE__ ) );
}

if ( !defined( 'OMG_FORMS_CC_FILE' ) ) {
	define( 'OMG_FORMS_CC_FILE', __FILE__ );
}

require_once OMG_FORMS_CC_DIR . '/includes/api.php';
require_once OMG_FORMS_CC_DIR . '/includes/validation.php';
require_once OMG_FORMS_CC_DIR . '/includes/helpers.php';
require_once OMG_FORMS_CC_DIR . '/includes/settings.php';

\OMGForms\Mailchimp\Settings\setup();
