<?php 
/**
 * @package  KlikWAPlugin
 */

namespace KWAP_Inc\Pages;

use KWAP_Inc\Api\SettingsApi;
use KWAP_Inc\Controllers\BaseController;
use KWAP_Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

	public $settings;
	public $callbacks;

	public $pages = array();

    public function register() {

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		// Make the Klik WA Admin Page appear in sidebar
		$this->setPages();

		// set the setter variable
		// $this->setSettings();
		// $this->setSections();
		// $this->setFields();

		$this->settings->addPages( $this->pages )->register();

	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Klik WA', 
				'menu_title' => 'Klik WA Button', 
				'capability' => 'manage_options', 
				'menu_slug' => 'klik_wa', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-whatsapp', 
				'position' => NULL
			)
		);
	}

	// Setter for variables that will be used in the Pages
	// public function setSettings() {
	// 	$args = [
	// 		[
	// 			'option_group' => 'klik_wa_options_group',
	// 			'option_name' => 'text_example',
	// 			'callback' => array( $this->callbacks, 'optionsGroup' )
	// 		],
	// 		[
	// 			'option_group' => 'klik_wa_options_group',
	// 			'option_name' => 'first_name'
	// 		],
	// 		[
	// 			'option_group' => 'klik_wa_options_group',
	// 			'option_name' => 'link'
	// 		],
	// 		[
	// 			'option_group' => 'klik_wa_options_group',
	// 			'option_name' => 'radio'
	// 		]
			
	// 	];

	// 	$this->settings->setSettingsAPI($args);
	// }
	// public function setSections() {
	// 	$args = [
	// 		[
	// 			'id' => 'klik_wa_admin_index',
	// 			'title' => 'Settings',
	// 			'callback' => array( $this->callbacks, 'adminSection' ),
	// 			'page' => 'klik_wa'
	// 		]
	// 	];

	// 	$this->settings->setSectionsAPI($args);
	// }

	// public function setFields() {
	// 	$args = [
	// 		[
	// 			'id' => 'text_example',
	// 			'title' => 'Text Example',
	// 			'callback' => array( $this->callbacks, 'textExample' ),
	// 			'page' => 'klik_wa',
	// 			'section' => 'klik_wa_admin_index',
	// 			'args' => [
	// 				'label_for' => 'text_example',
	// 				'class' => 'example-class'
	// 			]
	// 		],
	// 		[
	// 			'id' => 'first_name',
	// 			'title' => 'First Name',
	// 			'callback' => array( $this->callbacks, 'firstName' ),
	// 			'page' => 'klik_wa',
	// 			'section' => 'klik_wa_admin_index',
	// 			'args' => [
	// 				'label_for' => 'first_name',
	// 				'class' => 'example-class'
	// 			]
	// 		],
	// 		[
	// 			'id' => 'link',
	// 			'title' => 'Link',
	// 			'callback' => array( $this->callbacks, 'link' ),
	// 			'page' => 'klik_wa',
	// 			'section' => 'klik_wa_admin_index',
	// 			'args' => [
	// 				'label_for' => 'link',
	// 				'class' => 'example-class'
	// 			]
	// 		],
	// 		[
	// 			'id' => 'radio',
	// 			'title' => 'Radio',
	// 			'callback' => array( $this->callbacks, 'radio' ),
	// 			'page' => 'klik_wa',
	// 			'section' => 'klik_wa_admin_index',
	// 			'args' => [
	// 				'label_for' => 'radio',
	// 				'class' => 'example-class'
	// 			]
	// 		]
	// 	];

	// 	$this->settings->setFieldsAPI($args);
	// }

}