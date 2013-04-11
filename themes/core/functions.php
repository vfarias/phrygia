<?php
/**
* Helpers for the template file.
*/
$phr->data['header'] = '<h1>Header: Phrygia</h1>';
$phr->data['main']   = $phr->data['main'];
//$phr->data['footer'] = '<p>Footer: &copy; Lydia by Mikael Roos (mos@dbwebb.se)</p>';


/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $phr = CPhrygia::Instance();
  $html = "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($phr->config, true)) . "</pre>";
  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($phr->data, true)) . "</pre>";
  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($phr->request, true)) . "</pre>";
  return $html;
}
