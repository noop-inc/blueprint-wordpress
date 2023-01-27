# Noop Wordpress Blueprint

## Overview

This Wordpress Blueprint is a great way to get started using the [Noop Developer Platform](https://noop.dev). The [AppManifest](.noop/app.yml) describes how to run this software to Noop.

## Serving images

S3 Uploads is a plugin that will stream media to and from an S3 bucket. This is used to store media in a stateless fashion. In addition to that plugin, a must-use WordPress plugin is installed in [`web/app/content/mu-plugins/s3-endpoint.php`](https://github.com/noop-inc/blueprint-wordpress/blob/main/web/app/mu-plugins/s3-endpoint.php) to proxy all traffic from `/bucket` to and from S3 so as to retrieve the media. S3 Buckets in noop are private and require proxying to serve static traffic.

## Sendmail

Sendmail is not supported in this example, so you'll need to configure an external SMTP service like Postmark, Sendgrid, etc, or tools like [`msmtp`](https://www.amplitudedesign.com/2018/12/send-mail-using-msmtp-with-phps-mail-function-with-rackspace-hosted-email-on-a-ubuntu-server/).

Because of this, no default email will be sent when creating the default admin user in the InstallWordPress step of the Quick Stark Runbook. It's recommended you open a Service Instance Terminal from the Noop Console and (update the user's password using WP CLI.)[https://wordpress.org/support/article/resetting-your-password/#through-wp-cli]

## Attribution

Many thanks to the folks at [Roots.io](https://roots.io/) and their [Bedrock project](https://roots.io/bedrock/). This blueprint makes use of Bedrock to configure and organize this WordPress project. Bedrock is a modern WordPress stack that helps you get started with the best development tools and project structure.
