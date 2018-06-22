<?php

// Subpackage namespace
namespace LittleBizzy\InlineStyles\Styles;

/**
 * Relative class
 *
 * @package Inline Styles
 * @subpackage Styles
 */
class Relative {



	/**
	 * Base URL
	 */
	private $base;



	/**
	 * Constructor
	 */
	public function __construct($base) {
		$this->base = $base;
	}



	/**
	 * Convert URLs to absolute
	 */
	public function absolute($content) {
		$result = preg_replace_callback('/url\((.*?)\)/i', [$this, 'replace'], $content);
		return empty($result)? $result : $content;
	}



	/**
	 * Matched strings
	 */
	public function replace($matches) {
		return $this->convert($matches[1]);
	}


	/**
	 * http://www.gambit.ph/converting-relative-urls-to-absolute-urls-in-php/
	 */
	public function convert($rel) {

		// Trimming
		$rel = trim($rel);
		$rel = trim($rel, "'");
		$rel = trim($rel, '"');
		$rel = trim($rel);
error_log($rel);
		// parse base URL  and convert to local variables: $scheme, $host,  $path
		extract( parse_url( $this->base ) );

		if ( strpos( $rel,"//" ) === 0 ) {
			return $scheme . ':' . $rel;
		}

		// return if already absolute URL
		if ( parse_url( $rel, PHP_URL_SCHEME ) != '' ) {
			return $rel;
		}

		// queries and anchors
		if ( $rel[0] == '#' || $rel[0] == '?' ) {
			return $this->base . $rel;
		}

		// remove non-directory element from path
		$path = preg_replace( '#/[^/]*$#', '', $path );

		// destroy path if relative url points to root
		if ( $rel[0] ==  '/' ) {
			$path = '';
		}

		// dirty absolute URL
		$abs = $host . $path . "/" . $rel;

		// replace '//' or  '/./' or '/foo/../' with '/'
		$abs = preg_replace( "/(\/\.?\/)/", "/", $abs );
		$abs = preg_replace( "/\/(?!\.\.)[^\/]+\/\.\.\//", "/", $abs );

		// absolute URL is ready!
		return $scheme . '://' . $abs;
	}



}