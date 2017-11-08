<?php
namespace OMGForms\CC\Validation;

use OMGForms\CC\Helpers;
function valid_constant_contact_forms( $args ) {
	if ( isset( $args[ 'form_type' ] ) && 'constant-contact' === $args[ 'form_type' ] ) {
//		if ( ! isset( $args[ 'list_id' ] ) ) {
//			throw new \Exception( 'Mailchimp forms must have a list_id set for this to be a valid form.' );
//		}

		$email = Helpers\get_email_address( $args );

		if ( empty( $email ) ) {
			throw new \Exception( 'Constant Contact forms must have an email field to be a valid form.' );
		}
	}
}
add_action( 'omg_form_validation', __NAMESPACE__ . '\valid_constant_contact_forms' );