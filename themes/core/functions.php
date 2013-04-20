<?php
/**
* Helpers for the template file.
*/
$phr->data['header'] = '<h1>Header: Phrygia</h1>';
//$phr->data['main']   = $phr->data['main'];
$phr->data['footer'] = '<p>Footer: &copy; Phrygia by Victor Arias</p>';


/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $phr = CPhrygia::Instance(); 
  $html = null;
  if(isset($phr->config['debug']['db-num-queries']) && $phr->config['debug']['db-num-queries'] && isset($phr->db)) {
    $html .= "<p>Database made " . $phr->db->GetNumQueries() . " queries.</p>";
  }   
  if(isset($phr->config['debug']['db-queries']) && $phr->config['debug']['db-queries'] && isset($phr->db)) {
    $html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $phr->db->GetQueries()) . "</pre>";
  }   
  if(isset($phr->config['debug']['display-phrygia']) && $phr->config['debug']['display-phrygia']) {
    $html .= "<hr><h3>Debuginformation</h3><p>The content of CPhrygia:</p><pre>" . htmlent(print_r($phr, true)) . "</pre>";
  }   
  return $html;
}

function render_views() {
  return CPhrygia::Instance()->views->Render();
}

/**
* Get messages stored in flash-session.
*/
function get_messages_from_session() {
  $messages = CPhrygia::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}

/**
* Create a url to an internal resource.
*
* @param string the whole url or the controller. Leave empty for current controller.
* @param string the method when specifying controller as first argument, else leave empty.
* @param string the extra arguments to the method, leave empty if not using method.
*/
function create_url($urlOrController=null, $method=null, $arguments=null) {
  return CPhrygia::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}

