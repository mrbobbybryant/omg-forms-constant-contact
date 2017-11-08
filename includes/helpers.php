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

		if ( is_merge_data( $key ) ) {
			$acc[ 'merge_fields' ][ strtoupper( $key ) ] = $args[ $arg ];
		} else if ( 'interests' === $key ) {
			$acc['interests'] = [];

			if ( is_array( $args[ $arg ] ) ) {
				foreach( $args[ $arg ] as $item ) {
					$acc['interests'][ $item ] = true;
				}
			} else {
				$acc['interests'][ $args[ $arg ] ] = true;
			}
		} else {
			$acc[ $key ] = $args[ $arg ];
		}

		return $acc;
	}, [] );
}

function format_field_name( $field_key ) {
	$key = str_replace( 'omg-forms-', '', $field_key );
	return str_replace( '-', '_', $key );
}

function get_valid_cc_field_data() {
	return apply_filters( 'omg-form-cc-valid-fields', [
		'fname', 'lname', 'interests', 'email_address'
	] );
}

function is_merge_data( $field_key ) {
	$merge_keys = apply_filters( 'omg-form-cc-merge-keys',[ 'fname', 'lname' ] );
	return ( in_array( $field_key, $merge_keys ) );
}