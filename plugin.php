<?php
/**
 * Plugin Name
 *
 * @package     NavCodes
 * @author      Liqd Digital
 * @copyright   2020 Liqd Digital
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: NavCodes
 * Description: Create shortcodes that display beautiful navigation menus.
 * Version:     1.0.0
 * Author:      Liqd Digital
 * Author URI:  https://liqd.com.au/
 * Text Domain: liqd
 */

if (defined('NAVCODES')) { return; }
define('NAVCODES', __FILE__);
require_once(__DIR__ . '/inc/manager.php');
$navcodes = new NavCodes();
$navcodes->url = plugin_dir_url( __FILE__ );
