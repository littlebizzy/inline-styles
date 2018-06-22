<?php

// Subpackage namespace
namespace LittleBizzy\InlineStyles\Core;

// Aliased namespaces
use \LittleBizzy\InlineStyles\Styles;
use \LittleBizzy\InlineStyles\Helpers;

/**
 * Object Factory class
 *
 * @package Inline Styles
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * Inline object
	 */
	protected function createInline() {
		return Styles\Inline::instance($this->plugin);
	}



	/**
	 * Relative object
	 */
	protected function createRelative($base) {
		return new Styles\Relative($base);
	}



}