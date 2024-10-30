<?php
/**
 * @package  KlikWAPlugin
 */
namespace KWAP_Inc\Api\Callbacks;

use KWAP_Inc\Controllers\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	// public function optionsGroup( $input )
	// {
	// 	return $input;
	// }

	// public function adminSection()
	// {
	// 	echo 'Check this beautiful section!';
	// }

	// public function textExample()
	// {
	// 	$value = esc_attr( get_option( 'text_example' ) );
	// 	echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
	// }

	// public function firstName()
	// {
	// 	$value = esc_attr( get_option( 'first_name' ) );
	// 	echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
	// }

	// public function link()
	// {
	// 	$value = esc_attr( get_option( 'link' ) );
	// 	echo '<input type="text" class="regular-text" name="link" value="' . $value . '" placeholder="Write the link">';
	// }

	// public function radio()
	// {
	// 	$value = esc_attr( get_option( 'link' ) );
	// 	echo '<input type="radio" class="regular-text" name="link" value="' . $value . '">';
	// }
}