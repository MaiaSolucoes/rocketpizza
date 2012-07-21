<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 13/07/12
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/', get_include_path())));

require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Db/Table/Abstract.php';
require_once 'configs/Config.php';
require_once 'Zend/Db/Table.php';
class Phone extends Zend_Db_Table_Abstract {

	protected $_name;
	protected $_primary;

	public function __construct() {

		$adapter = Zend_Db::factory(Config::getAdapter(), Config::getConfig());
		Zend_Db_Table::setDefaultAdapter($adapter);

		$this->_name = strtolower(__CLASS__);
		$this->_primary = strtolower(__CLASS__).'_id';

		parent::__construct();
	}
}
