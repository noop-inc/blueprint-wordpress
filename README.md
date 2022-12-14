# Overview

## Serving images

S3 Uploads is a plugin that will stream media to and from an S3 bucket. This is used to store media in a stateless fashion. In addition to that plugin, a must-use WordPress plugin is installed in [`web/app/content/mu-plugins/s3-endpoint.php`](https://github.com/noop-inc/blueprint-wordpress/blob/main/web/app/mu-plugins/s3-endpoint.php) to proxy all traffic from `/bucket` to and from S3 so as to retrieve the media. S3 Buckets in noop are private and require proxying to serve static traffic.

## Attribution

Many thanks to the folks at [Roots.io](https://roots.io/) and their [Bedrock project](https://roots.io/bedrock/). This blueprint makes use of Bedrock to configure and organize this WordPress project. Bedrock is a modern WordPress stack that helps you get started with the best development tools and project structure.
