<?php
namespace OMGForms\CC\Helpers;

function get_email_address( $form ) {
	$field = array_values( array_filter( $form['fields'], function( $field ) {
		if ( 'email' === $field[ 'type' ] ) {
			return $field;
		}
	} ) );

	return ( ! empty( $field ) ) ? $field[0] : false;
}

function prepare_cc_form_fields( $args ) {
	return array_reduce( array_keys( $args ), function( $acc, $arg ) use( $args ) {
		$key = format_field_name( $arg );
		$valid_keys = get_valid_cc_field_data();

		if ( ! in_array( $key, $valid_keys ) ) {
			return $acc;
		}

		$acc[ $key ] = $args[ $arg ];

		return $acc;
	}, [] );
}

function format_field_name( $field_key ) {
	$key = str_replace( 'omg-forms-', '', $field_key );
	return str_replace( '-', '_', $key );
}

function get_valid_cc_field_data() {
	return apply_filters( 'omg-form-cc-valid-fields', [
		'first_name', 'last_name', 'email_address'
	] );
}