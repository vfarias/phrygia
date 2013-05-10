<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/*
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/**
* Set what to show as debug or developer information in the get_debug() theme helper.
*/
$phr->config['debug']['display-phrygia'] = false;
$phr->config['debug']['db-num-queries'] = true;
$phr->config['debug']['db-queries'] = true;

/*
* Define session name
*/
$phr->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/*
* Define server timezone
*/
$phr->config['timezone'] = 'Europe/Stockholm';

/*
* Define internal character encoding
*/
$phr->config['character_encoding'] = 'UTF-8';

/*
* Define language
*/
$phr->config['language'] = 'en';

/**
* Set a base_url to use another than the default calculated
*/
$phr->config['base_url'] = null;

/**
* How to hash password of new users, choose from: plain, md5salt, md5, sha1salt, sha1.
*/
$phr->config['hashing_algorithm'] = 'sha1salt';

/**
* Allow or disallow creation of new user accounts.
*/
$phr->config['create_new_users'] = true;

/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $p->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
* Access is determined by 'enabled'. Options are group acronyms as well as 'anon', which gives everyone access. Leaving it empty will leave the controller inaccessible for everyone. 
*/
$phr->config['controllers'] = array(
  'index'     => array('enabled' => array('user', 'anon'),'class' => 'CCIndex'),
  'developer' => array('enabled' => array('user', 'anon'),'class' => 'CCDeveloper'),
  'guestbook' => array('enabled' => array('user', 'anon'),'class' => 'CCGuestbook'),
  'content'   => array('enabled' => array('user', 'anon'),'class' => 'CCContent'),
  'blog'   	  => array('enabled' => array('user', 'anon'),'class' => 'CCBlog'),
  'page'	  => array('enabled' => array('user', 'anon'),'class' => 'CCPage'),
  'user' 	  => array('enabled' => array('user', 'anon'),'class' 	=> 'CCUser'),
  'acp'       => array('enabled' => array('user', 'anon'),'class' => 'CCAdminControlPanel'),
  'theme'     => array('enabled' => array('user', 'anon'),'class' => 'CCTheme'),
  'module'	  => array('enabled' => array('user', 'anon'),'class' => 'CCModules'),
  'my'        => array('enabled' => array('user', 'anon'),'class' => 'CCMycontroller'), 
  
);

/**
* Define a routing table for urls.
*
* Route custom urls to a defined controller/method/arguments
*/
$phr->config['routing'] = array(
  'home' => array('enabled' => true, 'url' => 'index/index'),
);

/**
* Define menus.
*
* Create hardcoded menus and map them to a theme region through $ly->config['theme'].
*/
$phr->config['menus'] = array(
  'admin_navbar' => array(
    'acp'		=> array('label'=>'Control Panel', 'url'=>'acp'),
    'modules'   => array('label'=>'Modules', 'url'=>'module'),
    'content'   => array('label'=>'Content', 'url'=>'content'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'guestbook'),
    'blog'      => array('label'=>'Blog', 'url'=>'blog'),
  ),
  'my-navbar' => array(
  	'install'      => array('label'=>'Install', 'url'=>'home'),
    'home' => array('label'=>'Home', 'url'=>'my'),
    'about' => array('label'=>'About', 'url'=>'my/about'),
    'blog' => array('label'=>'My Blog', 'url'=>'my/blog'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
  ),
);

/**
* Settings for the theme. The theme may have a parent theme.
*
* When a parent theme is used the parent's functions.php will be included before the current
* theme's functions.php. The parent stylesheet can be included in the current stylesheet
* by an @import clause. See site/themes/mytheme for an example of a child/parent theme.
* Template files can reside in the parent or current theme, the CLydia::ThemeEngineRender()
* looks for the template-file in the current theme first, then it looks in the parent theme.
*
* There are two useful theme helpers defined in themes/functions.php.
*  theme_url($url): Prepends the current theme url to $url to make an absolute url.
*  theme_parent_url($url): Prepends the parent theme url to $url to make an absolute url.
*
* path: Path to current theme, relativly LYDIA_INSTALL_PATH, for example themes/grid or site/themes/mytheme.
* parent: Path to parent theme, same structure as 'path'. Can be left out or set to null.
* stylesheet: The stylesheet to include, always part of the current theme, use @import to include the parent stylesheet.
* template_file: Set the default template file, defaults to default.tpl.php.
* regions: Array with all regions that the theme supports.
* data: Array with data that is made available to the template file as variables.
*
* The name of the stylesheet is also appended to the data-array, as 'stylesheet' and made
* available to the template files.
*/
$phr->config['theme'] = array(
  'name'			=> 'grid',
  'path'            => 'site/themes/mytheme',
  'parent'          => 'themes/grid',
  'stylesheet'      => 'style.css',
  'template_file'   => 'index.tpl.php',
  'regions' => array('flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',
  ),
  'menu_to_region' => array('my-navbar'=>'navbar'),
  'admin_menu_to_region' => array('admin_navbar'=>'navbar'),
  // Add static entries for use in the template file.
  'data' => array(
    'header' => 'Phrygia',
    'slogan' => 'A PHP-based MVC-inspired CMF',
    'favicon' => 'logo.png',
    'logo' => 'logo.png',
    'logo_width'  => 80,
    'logo_height' => 80,
    'footer' => '<p>Phrygia &copy; by Victor Arias</p>',
  ),
);

/**
* What type of urls should be used?
*
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/
$phr->config['url_type'] = 1;

/**
* Set database(s).
*/
$phr->config['database'][0]['dsn'] = 'sqlite:' . PHRYGIA_SITE_PATH . '/data/.ht.sqlite';

$phr->config['session_key']  = 'phrygia';


