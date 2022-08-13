<?php
/**
 * Contains \Somoscuatro\Mailhog\Plugin.
 *
 * @package somoscuatro-mailhog
 */

declare(strict_types=1);

namespace Somoscuatro\Mailhog;

/**
 * Administrative back-end functionality.
 */
class Plugin {

	/**
	 * Plugin frontend initialization method.
	 *
	 * @implements init
	 */
	public static function init() {
		add_filter(
			'phpmailer_init',
			function( $php_mailer ) {
				// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$php_mailer->Host     = 'mailhog';
				$php_mailer->Port     = 1025;
				$php_mailer->From     = 'wordpress@localhost.test';
				$php_mailer->FromName = 'WordPress';
				$php_mailer->IsSMTP();
				// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			},
			10
		);
		add_filter( 'wp_mail_from', fn() => 'wordpress@localhost.test' );
		add_filter( 'wp_mail_from_name', fn() => 'localhost' );
	}

}
