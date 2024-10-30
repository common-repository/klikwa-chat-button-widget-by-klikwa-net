<?php
/**
 * @package  AlecadddPlugin
 */
namespace KWAP_Inc\Base;

use KWAP_Inc\Controllers\BaseController;

class TemplateController extends BaseController
{
	public $templates;

	public function register()
	{
		$this->load_script();
		add_action('wp_footer', array($this, 'load_template'));
	}

	public function load_template()
	{
		include_once($this->plugin_path . 'templates/widget.php');
	}

	public function load_script(){
		global $wpdb;
		$table_name_link = $wpdb->prefix . 'klikwa_links';
		$link_db = $wpdb->get_row("SELECT * FROM {$table_name_link} WHERE id=1");

		$l_script = $link_db->l_script ?? "";

		// Remove escape slash (\)
		$l_script = stripslashes($l_script);

		// Function to add script and links to header
		add_action('wp_head', function () use ($l_script) {
			wp_enqueue_style( 'kwstyleanimate', plugin_dir_url( __FILE__ ).'../../asset/css/animate.min.css' );
			wp_enqueue_style( 'kwstylefa', plugin_dir_url( __FILE__ ).'../../asset/css/font-awesome.min.css' );

			echo $l_script;
		});

	}
}
