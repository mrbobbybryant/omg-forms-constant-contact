<?php
namespace OMGForms\CC\Settings;

function setup() {
	add_action( 'omg-form-settings-hook', __NAMESPACE__ . '\register_form_settings' );
	add_action( 'admin_init', __NAMESPACE__ . '\display_cc_setting_fields' );
}

function display_cc_setting_fields() {
	add_settings_section( 'section', esc_html__( 'Constant Contact Settings' ), null, 'cc_options' );

	add_settings_field(
		'cc_api_key',
		'Constant Contact API Key',
		__NAMESPACE__ . '\display_cc_key_element',
		'cc_options',
		'section'
	);

	register_setting( 'cc-section', 'cc_api_key' );

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

function register_form_settings() {
	settings_fields( 'cc-section' );
	do_settings_sections( 'cc_options' );
}