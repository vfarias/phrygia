<?php
//
// PHASE: BOOTSTRAP
//
define('PHRYGIA_INSTALL_PATH', dirname(__FILE__));
define('PHRYGIA_SITE_PATH', PHRYGIA_INSTALL_PATH . '/site');

require(PHRYGIA_INSTALL_PATH.'/src/CPhrygia/bootstrap.php');

$phr = CPhrygia::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//
$phr->FrontControllerRoute();

//
// PHASE: THEME ENGINE RENDER
//
$phr->ThemeEngineRender();
