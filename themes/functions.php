<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php.
* This file is included right before the themes own functions.php
*/

/**
* Create a url by prepending the base_url.
*/
function base_url($url) {
  return CPhrygia::Instance()->request->base_url . trim($url, '/');
}

/**
* Return the current url.
*/
function current_url() {
  return CPhrygia::Instance()->request->current_url;
}

/**
* Render all views.
*/
function render_views() {
  return CPhrygia::Instance()->views->Render();
}
