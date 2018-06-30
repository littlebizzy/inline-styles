<?php

// Subpackage namespace
namespace LittleBizzy\InlineStyles\Core;

// Aliased namespaces
use \LittleBizzy\InlineStyles\Helpers;

/**
 * Core class
 *
 * @package Inline Styles
 * @subpackage Core
 */
final class Core extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		// Factory object
		$this->plugin->factory = new Factory($this->plugin);

		// WP loaded hook
		add_action('wp_loaded', [$this, 'loaded'], PHP_INT_MAX);

		// Print styles hook
		add_action('wp_print_styles', [$this, 'styles'], PHP_INT_MAX);
	}



	/**
	 * Output parser object
	 */
	public function loaded() {
		$this->plugin->factory->parser->start();
	}



	/**
	 * Handle the print styles hook
	 */
	public function styles() {
		$this->plugin->factory->inline->transform();
	}



}