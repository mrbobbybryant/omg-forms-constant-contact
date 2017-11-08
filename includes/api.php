<?php
namespace OMGForms\CC\API;

use OMGForms\CC\Helpers;

function save_form_as_constant_contact( $result, $args, $form ) {

	if ( $form[ 'form_type' ] === 'constant-contact' ) {

	}

	return true;
}

add_filter( 'omg_forms_save_data', __NAMESPACE__ .  '\save_form_as_constant_contact', 10, 3 );
