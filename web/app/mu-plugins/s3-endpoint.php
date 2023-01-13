<?php
/*
Plugin Name: Noop S3 Proxy
Description: Proxies requests from /bucket/* to the environment's S3 Bucket
Author: Noop, Inc
Version: 1.0.0
Author URI: https://noop.dev
*/

namespace NoopS3Assets;

// Filter S3 Uploads params.
add_filter('s3_uploads_s3_client_params', function ($params) {
  if (!defined('S3_UPLOADS_ENDPOINT')) return $params;
  $params['endpoint'] = \S3_UPLOADS_ENDPOINT;
  $params['use_path_style_endpoint'] = true;
  $params['debug'] = false; // Set to true if uploads are failing.

  return $params;
});

add_action('init', function () {
  if (!defined('S3_UPLOADS_BUCKET_URL')) return;
  $url = explode('?', get_current_url())[0];
  if (strpos($url, \S3_UPLOADS_BUCKET_URL) !== 0) return;
  $path = ltrim(str_replace(\S3_UPLOADS_BUCKET_URL, '', $url), '/');
  $asset = untrailingslashit(sanitize_text_field($path));

  if (!$asset) return;

  try {
    $s3Uploads = \S3_Uploads\Plugin::get_instance();
    $s3 = $s3Uploads->s3();
    $params = [
      'Bucket' => \S3_UPLOADS_BUCKET,
      'Key' => $asset,
    ];
    $object = $s3->getObject($params);
  } catch (\Throwable $th) {
    error_log($th);
    $statusCode = $th->getStatusCode();
    switch ($statusCode) {
      case 404:
        header('HTTP/1.1 404 Not Found');
        break;
      default:
        header('HTTP/1.1 500 Server Error');
        break;
    }

    echo $th->getAwsErrorMessage();
    exit;
  }

  if ($object->hasKey('ContentType')) header('Content-Type: ' . $object->get('ContentType'));
  if ($object->hasKey('ContentLength')) header('Content-Length: ' . $object->get('ContentLength'));
  if ($object->hasKey('Expires')) header('Expires: ' . $object->get('Expires'));
  if ($object->hasKey('CacheControl')) header('Cache-Control: ' . $object->get('CacheControl'));
  if ($object->hasKey('LastModified')) header('Last-Modified: ' . $object->get('LastModified'));
  $body = $object->get('Body');
  while ($body->isReadable() && !$body->eof()) {
    echo $body->read(256);
  }
  exit;
});

function get_current_url()
{
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
