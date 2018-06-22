<?php
/*
Plugin Name: Inline Styles
Plugin URI: https://www.littlebizzy.com/plugins/inline-styles
Description: Automagically loads content from your theme style.css in the site-wide head of your WordPress site as internal (embedded) CSS for faster page render.
Version: 1.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Prefix: ILNSTY
*/

// Plugin namespace
namespace LittleBizzy\InlineStyles;

// Aliased namespaces
use LittleBizzy\InlineStyles\Notices;

// Block direct calls
if (!function_exists('add_action'))
	die;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'ilnsty';
const VERSION = '1.0.0';

// Loader
require_once dirname(FILE).'/helpers/loader.php';

// Admin Notices
// Notices\Admin_Notices::instance(__FILE__);

/**
 * Admin Notices Multisite check
 * Uncomment "return;" to disable this plugin on Multisite installs
 */
// if (false !== Notices\Admin_Notices_MS::instance(__FILE__)) { /* return; */ }

// Run the main class
Helpers\Runner::start('Core\Core', 'instance');
