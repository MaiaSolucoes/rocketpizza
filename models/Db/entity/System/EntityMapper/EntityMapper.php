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

			Zend_Db_Table::setDefaultAdapter($adapter);

			$this->_name = lcfirst(__CLASS__);
			$this->_primary = lcfirst(__CLASS__).'Id';

			parent::__construct();
		} catch(Exception $e) {
			throw new Exception('Sistema nao configurado. Procure o administrador e informe este erro: SYSTEM_NOT_FOUND');
		}
	}

	public function getEntityParameters($where = null, $fetchType = 'row', $context) {
		switch($fetchType) {
			case 'row': $fetchType = 'fetchRow';
				break;
			case 'all': $fetchType = 'fetchAll';
				break;
			default: $fetchType = 'fetchRow';
				break;
		}

		try {
			$select = $this->select();
			$select->setIntegrityCheck(false);
			$select->from('entityMapper', 'entityMapper.*');
			$select->from('', 'entityMapperHelper.entityMapperHelperQuery');
			$select->joinInner('entityMapperHelper', 'entityMapper.entityMapperId = entityMapperHelper.entityMapperId', array());

			if(is_array($where)) {
				foreach($where as $parameter) {
					$select->where('entityMapperHelper.entityMapperHelperId = ?', $parameter);
				}
			} else if(!is_null($where)) {
				$select->where('entityMapperHelper.entityMapperHelperId = ?', $where);
			}
			$select->where('entityMapperHelper.entityMapperHelperContext = ?', $context);

			$queryRecord = $this->fetchRow($select);

			//print '<pre>'.print_r($queryRecord,true).'</pre>';die($select->__toString());
			$db = Zend_Db::factory(Config::getAdapter(), Config::getConfigFromEntityMapper($queryRecord));
			$db->getConnection();
			$db->setFetchMode(Zend_Db::FETCH_OBJ);
			return $db->$fetchType($queryRecord->entityMapperHelperQuery);
		} catch (Exception $e) {
			throw new Exception('Consulta inv&aacute;lida');
		}
	}



}
