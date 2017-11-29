<?php
namespace OMGForms\CC\Settings;

function setup() {
	add_action( 'admin_init', __NAMESPACE__ . '\display_cc_setting_fields' );
}

function display_cc_setting_fields() {
	add_settings_section( 'cc-section', esc_html__( 'Constant Contact Settings' ), null, 'form_settings' );

	add_settings_field(
		'cc_api_key',
		'Constant Contact API Key',
		__NAMESPACE__ . '\display_cc_key_element',
		'form_settings',
		'cc-section'
	);

	add_settings_field(
		'cc_api_token',
		'Constant Contact API Token',
		__NAMESPACE__ . '\display_cc_token_element',
		'form_settings',
		'cc-section'
	);

	register_setting( 'omg-forms-section', 'cc_api_key' );
	register_setting( 'omg-forms-section', 'cc_api_token' );

}

function display_cc_key_element() {
	?>
	<input
		type="text"
		size="55"
		name="cc_api_key"
		value="<?php echo get_option( 'cc_api_key' ); ?>"
	/>
	<?php
}

function display_cc_token_element() {
	?>
    <input
            type="text"
            size="55"
            name="cc_api_token"
            value="<?php echo get_option( 'cc_api_token' ); ?>"
    />
	<?php
}