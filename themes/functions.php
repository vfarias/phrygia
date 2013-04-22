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

/**
* Login menu. Creates a menu which reflects if user is logged in or not.
*/
function login_menu() {
  $phr = CPhrygia::Instance();
  if($phr->user->IsAuthenticated()) {
    $items = "<a href='" . create_url('user/profile') . "'>" . $phr->user->GetAcronym() . "</a> ";
    if($phr->user->IsAdministrator()) {
      $items .= "<a href='" . create_url('acp') . "'>acp</a> ";
    }
    $items .= "<a href='" . create_url('user/logout') . "'>logout</a> ";
  } else {
    $items = "<a href='" . create_url('user/login') . "'>login</a> ";
  }
  return "<nav>$items</nav>";
}
