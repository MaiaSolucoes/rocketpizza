<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/', get_include_path())));

require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Db/Table/Abstract.php';
require_once 'configs/Config.php';
require_once 'Zend/Db/Table.php';
class EntityMapper extends Zend_Db_Table_Abstract {

	protected $_name;
	protected $_primary;

	public function __construct() {
		try {
			$adapter = Zend_Db::factory(Config::getAdapter(), Config::getConfig());

			$adapter->getConnection();
			$adapter->closeConnection();

			Zend_Db_Table::setDefaultAdapter($adapter);

			$this->_name = lcfirst(__CLASS__);
			$this->_primary = lcfirst(__CLASS__).'Id';

			parent::__construct();
		} catch(Exception $e) {
			throw new Exception('Sistema nao configurado. Procure o administrador e informe este erro: SYSTEM_NOT_FOUND');
		}
	}



}
