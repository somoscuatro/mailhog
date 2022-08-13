<?php
/**
 * Contains \Somoscuatro\Mailhog\Admin.
 *
 * @package somoscuatro-mailhog
 */

declare(strict_types=1);

namespace Somoscuatro\Mailhog;

/**
 * Administrative back-end functionality.
 */
class Admin {

	/**
	 * Initializes the admin functionality.
	 */
	public static function init(): void {
		// Displays warnings about conflicting plugins.
		add_action( 'admin_notices', __CLASS__ . '::display_missing_plugins_warning' );
	}

	/**
	 * Displays warnings about conflicting plugins.
	 */
	public static function display_missing_plugins_warning(): void {
		$wp_mail_smtp_active   = is_plugin_active( 'wp-mail-smtp/wp_mail_smtp.php' );
		$disable_emails_active = is_plugin_active( 'disable-emails/disable-emails.php' );

		if ( $wp_mail_smtp_active || $disable_emails_active ) :
			?>
		<div class="error">
			<?php if ( $wp_mail_smtp_active ) : ?>
				<p>
					<?php
						echo wp_kses_post(
							sprintf(
								/* translators: %s plugin name and link to plugin vendor page. */
								__( 'Plugin %s is active. You need to deactivate it in order to use the mailhog plugin.', 'somoscuatro-mailhog' ),
								'<a href="https://wpmailsmtp.com/" target="_blank">WP Mail SMTP</a>'
							)
						);
					?>
				</p>
			<?php endif; ?>

			<?php if ( $disable_emails_active ) : ?>
				<p>
					<?php
						echo wp_kses_post(
							sprintf(
								/* translators: %s plugin name and link to plugin vendor page. */
								__( 'Plugin %s is active. You need to deactivate it in order to use the mailhog plugin.', 'somoscuatro-mailhog' ),
								'<a href="https://wordpress.org/plugins/disable-emails/" target="_blank">Disable Emails</a>'
							)
						);
					?>
				</p>
			<?php endif; ?>
		</div>
			<?php
		endif;
	}

}
