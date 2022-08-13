<?php
/**
 * Generic plugin lifetime and maintenance functionality.
 *
 * @package somoscuatro-mailhog
 */

declare(strict_types=1);

namespace Somoscuatro\Mailhog;

/**
 * Generic plugin lifetime and maintenance functionality.
 */
class Schema {

	/**
	 * Registers activation hook callback.
	 *
	 * @implements register_activation_hook
	 */
	public static function activate() { }

	/**
	 * Registers deactivation hook callback.
	 *
	 * @implements register_deactivation_hook
	 */
	public static function deactivate() { }

	/**
	 * Registers uninstall hook callback.
	 *
	 * @implements register_uninstall_hook
	 */
	public static function uninstall() { }

}
