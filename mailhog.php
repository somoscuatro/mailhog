<?php
/**
 * Plugin Name: Verse Custom
 * Version: 1.0.0
 * Text Domain: somoscuatro-mailhog
 * Description: Simple WordPress plugin to capture emails through Mailhog.
 * Author: somoscuatro
 * Author URI: https://somoscuatro.es/
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl-2.0
 *
 * @package somoscuatro-mailhog
 */

namespace Somoscuatro\Mailhog;

if ( ! defined( 'ABSPATH' ) ) {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
	exit;
}

/**
 * Registers plugin autoloader.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 *
 * @param string $class The class name.
 */
spl_autoload_register(
	function ( $class ) {
		$prefix   = __NAMESPACE__;
		$base_dir = __DIR__ . '/src/';

		// Does the class use the namespace prefix?
		$len = strlen( $prefix );
		if ( 0 !== strncmp( $prefix, $class, $len ) ) {
			// No, move to the next registered autoloader.
			return;
		}

		// Get the relative class name.
		$relative_class = substr( $class, $len + 1 );

		// Replaces the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php.
		$file = $base_dir . 'class-' . strtolower( str_replace( '\\', '/', $relative_class ) ) . '.php';

		// If the file exists, require it.
		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);

register_activation_hook( __FILE__, __NAMESPACE__ . '\Schema::activate' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\Schema::deactivate' );
register_uninstall_hook( __FILE__, __NAMESPACE__ . '\Schema::uninstall' );

add_action( 'init', __NAMESPACE__ . '\Plugin::init', 20 );
