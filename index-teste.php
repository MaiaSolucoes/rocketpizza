<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 23/06/12
 * Time: 01:07
 * To change this template use File | Settings | File Templates.
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/', get_include_path())));
require_once 'models/Db/entity/Rocketpizza/Email/Email.php';
require_once 'configs/Config.php';

/*$adapter = Zend_Db::factory('Pdo_Mysql', Config::getConfig());


Zend_Db_Table::setDefaultAdapter($adapter);*/
$p = new Email();
$a= $p->find(1);
print '<pre>'.print_r($a,true).'</pre>';