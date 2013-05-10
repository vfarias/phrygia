<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php.
* This file is included right before the themes own functions.php
*/

/**
* Create a url by prepending the base_url.
*/
function base_url($url=null) {
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
*
* @param $region string the region to draw the content in.
*/
function render_views($region='default') {
  return CPhrygia::Instance()->views->Render($region);
}

/**
* Prepend the theme_url, which is the url to the current theme directory.
*
* @param $url string the url-part to prepend.
* @returns string the absolute url.
*/
function theme_url($url) {
  return create_url(CPhrygia::Instance()->themeUrl . "/{$url}");
}


/**
* Prepend the theme_parent_url, which is the url to the parent theme directory.
*
* @param $url string the url-part to prepend.
* @returns string the absolute url.
*/
function theme_parent_url($url) {
  return create_url(CPhrygia::Instance()->themeParentUrl . "/{$url}");
}

/**
* Create a url to an internal resource.
*
* @param string the whole url or the controller. Leave empty for current controller.
* @param string the method when specifying controller as first argument, else leave empty.
* @param string the extra arguments to the method, leave empty if not using method.
*/
function create_url($urlOrController=null, $method=null, $arguments=null) {
  return CPhrygia::Instance()->CreateUrl($urlOrController, $method, $arguments);
}

function create_admin_url($urlOrController=null, $method=null, $arguments=null) {
	if(IsAdmin()){
  return CPhrygia::Instance()->CreateUrl($urlOrController, $method, $arguments);
  	}
  	else return"";
}


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
* Login menu. Creates a menu which reflects if user is logged in or not.
*/
function login_menu() {
  $phr = CPhrygia::Instance();
  if($phr->user['isAuthenticated']) {
    $items = "<a href='" . create_url('user/profile') . "'><img class='gravatar' src='" . get_gravatar(20) . "' alt=''> " . $phr->user['acronym'] . "</a> ";
    if(HasRole('Admin')) {
      $items .= "<a href='" . create_url('acp') . "'>acp</a> ";
    }
    $items .= "<a href='" . create_url('user/logout') . "'>logout</a> ";
  } else {
    $items = "<a href='" . create_url('user/login') . "'>login</a> ";
  }
  return "<nav>$items</nav>";
}

/**
* Get a gravatar based on the user's email.
*/
function get_gravatar($size=null) {
  return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CPhrygia::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}

/**
* Escape data to make it safe to write in the browser.
*/
function esc($str) {
  return htmlEnt($str);
}

/**
* Filter data according to a filter. Uses CMContent::Filter()
*
* @param $data string the data-string to filter.
* @param $filter string the filter to use.
* @returns string the filtered string.
*/
function filter_data($data, $filter) {
  return CMContent::Filter($data, $filter);
}

/**
* Check if region has views. Accepts variable amount of arguments as regions.
*
* @param $region string the region to draw the content in.
*/
function region_has_content($region='default' /*...*/) {
  return CPhrygia::Instance()->views->RegionHasView(func_get_args());
}

function HasRole($role){
  return CPhrygia::Instance()->user->HasRole($role);
}
