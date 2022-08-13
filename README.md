# Mailhog WordPress Plugin

A simple WordPress plugin to capture emails using
[Mailhog](https://github.com/mailhog/MailHog).

## Description

This plugin integrates with the Mailhog email testing tool to capture all emails
sent from your WordPress site. Instead of actually sending the emails, they will
be captured by Mailhog for development and testing purposes.

## Installation

1. Install and run [Mailhog](https://github.com/mailhog/MailHog) on your
   development machine or simply use our [Docker WordPress
   Local](https://github.com/somoscuatro/docker-wordpress-local) package.
1. Upload the plugin files to the `/wp-content/plugins/mailhog` directory, or
   install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress or using WP
   CLI: `wp plugin activate mailhog`.
1. The plugin will automatically begin capturing emails sent from WordPress and
   displaying them in the Mailhog UI.

To ensure the plugin functions properly, it's important to disable any other
email-related plugins or settings that may be in use on your WordPress site.
This includes plugins like WP Mail SMTP and Disable Emails, as they could
interfere with the Mailhog plugin's ability to capture and display emails.

## Frequently Asked Questions

### What is Mailhog?

Mailhog is an email testing tool for developers that captures emails sent by
your application instead of actually sending them. You can view the captured
emails in a web UI.

### Do I need to configure anything?

Nope! Just install and activate the plugin, and it will automatically capture
emails and send them to the default Mailhog port.

### Where can I view the captured emails?

By default, you can view captured emails at `http://localhost:8025` in your web
browser.
