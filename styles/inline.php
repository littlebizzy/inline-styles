<?php

// Subpackage namespace
namespace LittleBizzy\InlineStyles\Styles;

// Aliased namespaces
use \LittleBizzy\InlineStyles\Helpers;

/**
 * Inline class
 *
 * @package Inline Styles
 * @subpackage Styles
 */
class Inline extends Helpers\Singleton {



	/**
	 * Transform external to inline styles
	 */
	public function transform() {

		// WP Style object
		$styles = wp_styles();

		// Enum registered items
		foreach ($styles->registered as $key => &$object) {

			// Check queued item
			if (!in_array($object->handle, $styles->queue))
				continue;

			// Check valid src
			if (empty($object->src) || !stripos($object->src, '/wp-content/'))
				continue;

			// Check src path
			$src = explode('/wp-content/', $object->src, 2);
			$src = $src[1];
			if (empty($src))
				continue;

			// Retrieve file content
			$path = WP_CONTENT_DIR.'/'.$src;
			$content = @file_get_contents($path);
			if (!empty($content)) {

				// Convert relative URLs
				$content = $this->absolutize($content, $src);

				// Remove reference
				$object->src = null;

				// Check extra data
				if (empty($object->extra) || !is_array($object->extra))
					$object->extra = [];

				// Add inline content
				$object->extra['after'] = [$content];
			}
		}
	}



	/**
	 * Convert relative stylesheets URLs to absolute URLs
	 */
	private function absolutize($content, $src) {

		// Early check
		if (false !== stripos($content, 'url(')) {
			$url = WP_CONTENT_URL.'/'.$src;
			$relative = $this->plugin->factory->relative($url);
			$content = $relative->absolute($content);
		}

		// Done
		return $content;
	}



}