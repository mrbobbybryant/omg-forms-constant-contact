<?php
namespace OMGForms\CC\API;

use Ctct\Components\Contacts;
use OMGForms\CC\Helpers;

function save_form_as_constant_contact( $result, $args, $form ) {

	if ( $form[ 'form_type' ] === 'constant-contact' ) {
		$apiKey = get_option( 'cc_api_key' );
		$apiToken = get_option( 'cc_api_token' );

		if ( empty( $apiKey ) ) {
			throw new \Exception( 'You must set the API Key before you Constant contact form will work.' );
		}

		if ( empty( $apiToken ) ) {
			throw new \Exception( 'You must set the API Token before you Constant contact form will work.' );
		}

		$data = Helpers\prepare_cc_form_fields( $args );

		$cc = new \Ctct\ConstantContact( get_option( 'cc_api_key' ) );

		try {
			// check to see if a contact with the email address already exists in the account
			$response = $cc->contactService->getContacts( $apiToken, array( "email" => $data['email_address'] ) );

			// create a new contact if one does not exist
			if ( empty( $response->results ) ) {
				$contact = new Contacts\Contact();
				$contact->addEmail( $data['email_address'] );
				$contact->addList( $form['list_id'] );

				if ( isset( $data['first_name'] ) ) {
					$contact->first_name = $data['first_name'];
				}

				if ( isset( $data['last_name'] ) ) {
					$contact->last_name = $data['last_name'];
				}

				/*
				 * The third parameter of addContact defaults to false, but if this were set to true it would tell Constant
				 * Contact that this action is being performed by the contact themselves, and gives the ability to
				 * opt contacts back in and trigger Welcome/Change-of-interest emails.
				 *
				 * See: http://developer.constantcontact.com/docs/contacts-api/contacts-index.html#opt_in
				 */
				$returnContact = $cc->contactService->addContact( $apiToken, $contact, [ 'action_by' => 'ACTION_BY_VISITOR' ] );

				// update the existing contact if address already existed
			} else {
				$contact = $response->results[0];
				if ( $contact instanceof Contacts\Contact ) {
					$contact->addList($form['list_id']);

					if ( isset( $data['first_name'] ) ) {
						$contact->first_name = $data['first_name'];
					}

					if ( isset( $data['last_name'] ) ) {
						$contact->last_name = $data['last_name'];
					}

					/*
					 * The third parameter of updateContact defaults to false, but if this were set to true it would tell
					 * Constant Contact that this action is being performed by the contact themselves, and gives the ability to
					 * opt contacts back in and trigger Welcome/Change-of-interest emails.
					 *
					 * See: http://developer.constantcontact.com/docs/contacts-api/contacts-index.html#opt_in
					 */
					$returnContact = $cc->contactService->updateContact( $apiToken, $contact, [ 'action_by' => 'ACTION_BY_VISITOR' ] );
				} else {
					$e = new \Ctct\Exceptions\CtctException();
					$e->setErrors( array( "type", "Contact type not returned" ) );
					return $e;
				}
			}

			// catch any exceptions thrown during the process and print the errors to screen
		} catch (\Ctct\Exceptions\CtctException $ex) {
			return $ex;
		}
	}

	return true;
}

add_filter( 'omg_forms_save_data', __NAMESPACE__ .  '\save_form_as_constant_contact', 10, 3 );
