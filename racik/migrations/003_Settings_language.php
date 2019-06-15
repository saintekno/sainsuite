<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Add available languages to the settings table
 */
class Migration_Settings_language extends Migration
{
	/**
	 * @var string The name of the settings table
	 */
	private $settings_table = 'settings';

	/**
	 * @var array The field to add to the settings table
	 */
	private $settings_field = array(
		'name'		=> 'site.languages',
		'module'	=> 'core',
		'value'		=> '',
	);

	/**
	 * @var array The languages available for the site, will be
	 * 				serialized and inserted into the settings field
	 */
	private $languages = array(
		'english',
		'indonesia',
	);

	/****************************************************************
	 * Migration methods
	 */
	/**
	 * Install this migration
	 */
	public function up()
	{
		// Add the site languages to the settings table
		$this->settings_field['value'] = serialize($this->languages);
		$this->db->insert($this->settings_table, $this->settings_field);
	}

	/**
	 * Uninstall this migration
	 */
	public function down()
	{
		$this->db->where('name', $this->settings_field['name'])->delete($this->settings_table);
	}
}