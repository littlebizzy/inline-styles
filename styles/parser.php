<?php

// Subpackage namespace
namespace LittleBizzy\InlineStyles\Styles;

// Aliased namespaces
use \LittleBizzy\InlineStyles\Helpers;

/**
 * Parser class
 *
 * @package Inline Styles
 * @subpackage Styles
 */
class Parser extends Helpers\Singleton {



	/**
	 * Enabled mode
	 */
	private $enabled = false;



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		/* Check context */

		// Admin
		if (is_admin())
			return;

		// CRON
		if (defined('DOING_CRON') && DOING_CRON)
			return;

		// XML-RPC request
		if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)
			return;

		// Command line
		if ((defined('WP_CLI') && WP_CLI) ||
			(defined('PHPUNIT_TEST') && PHPUNIT_TEST) ||
			'cli' == @php_sapi_name())
			return;

		// Done
		$this->enabled = true;
	}



	/**
	 * Init output buffering
	 */
	public function start() {

		// Check mode
		if (!$this->enabled)
			return;

		// ..

		// Buffering
		ob_start([$this, 'output']);
	}



	/**
	 * Handles the output buffer
	 */
	public function output($buffer) {

		// ...

		// Done
		return $buffer;
	}



}