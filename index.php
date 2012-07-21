<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 01/06/12
 * Time: 23:44
 * To change this template use File | Settings | File Templates.
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__)));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/libs', get_include_path())));

require_once 'configs/Config.php';
require_once 'configs/Site.php';
require_once 'controllers/Index/IndexController.php';
require_once 'Smarty/Smarty.class.php';

$smarty = new Smarty();
$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

$section = '';
$entity = '';

if(is_array($_GET)) {
	foreach($_GET as $id => $value) {
		$$id = $value;
	}
}

$handler = new IndexController();

try {
	$handler->factory();
	$logo = $handler->getHeaderLogo();

	$nav = $handler->getHeaderNav();
	$layout_config = $handler->getLayoutConfiguration();
} catch (Exception $e) {
	$e->getMessage();
}

$page = empty($section) ? "pages/main_page.tpl" : "pages/{$section}.tpl";
$data = array(
	'layout_config' => $layout_config,
	'css'	=> array(
				Site::getPath() . '/templates/css/layouts/'.$layout_config->css_source_folder.'/main.css',
				Site::getPath() . '/templates/css/layouts/'.$layout_config->css_source_folder.'/header.css',
				Site::getPath() . '/templates/css/layouts/'.$layout_config->css_source_folder.'/columns.css'),
	'js' 	=> array(Site::getPath() . '/templates/js/main.js'),
	'logo' 	=> $logo,
	'nav' 	=> $nav,
	'content' => $smarty->fetch($page),
	'title' => Site::getSiteName()
);

## SETTING UP CUSTOM LAYOUT CODE 
$custom_layout_code = "";

if (isset($layout_config->body_background_color) && !empty($layout_config->body_background_color)) {
	$custom_layout_code .= '
		body {
			background: '.$layout_config->body_background_color.'
		}';
}

$data['custom_layout_code'] = $custom_layout_code;

$smarty->assign("data", $data);
$smarty->assign('entity', $entity);

//var_dump($data);

$smarty->display('layout/'.$layout_config->name.'/common_page.tpl');