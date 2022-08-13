<?php
/**
 * Plugin Name: somoscuatro Mailhog.
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

declare(strict_types=1);

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
	function ( $class_name ) {
		// Only autoload classes from this namespace.
		if ( false === strpos( $class_name, __NAMESPACE__ ) ) {
			return;
		}

		// Remove namespace from class name.
		$class_file = str_replace( __NAMESPACE__ . '\\', '', $class_name );

		// Convert class name format to file name format.
		$class_file = strtolower( $class_file );
		$class_file = str_replace( '_', '-', $class_file );

		// Convert sub-namespaces into directories.
		$class_path = explode( '\\', $class_file );
		$class_file = array_pop( $class_path );
		$class_path = implode( '/', $class_path );

		$file = realpath( __DIR__ . '/src' . ( $class_path ? "/$class_path" : '' ) . '/class-' . $class_file . '.php' );

		// If the file exists, require it.
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( sprintf( 'File not found: %s', $file ), true );
		}
	}
);

register_activation_hook( __FILE__, __NAMESPACE__ . '\Schema::activate' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\Schema::deactivate' );
register_uninstall_hook( __FILE__, __NAMESPACE__ . '\Schema::uninstall' );

add_action( 'admin_init', __NAMESPACE__ . '\Admin::init' );
add_action( 'init', __NAMESPACE__ . '\Plugin::init', 20 );
