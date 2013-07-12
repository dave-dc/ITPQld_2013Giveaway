<?php
include('podio/PodioAPI.php');

Podio::setup('itp-qld-facebook', 'ecnMiigaLt5OUTOCw9s3oGGALRhAe4zyWcs3oZMMxW86MXeFlZH4k4O4gbtpcE9P');

try {
  Podio::authenticate('app', array('app_id' => '4810351', 'app_token' => 'c1323fa33e154990b65fb68d6a71a5e9'));

  // Authentication was a success, now you can start making API calls.

	echo 'here';
}
catch (PodioError $e) {
  // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}
