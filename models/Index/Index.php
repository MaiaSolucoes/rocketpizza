<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 02/06/12
 * Time: 02:27
 * To change this template use File | Settings | File Templates.
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/', get_include_path())));

require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/configs/Config.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/configs/Site.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/models/Db/entity/System/EntityMapper/EntityMapper.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/controllers/MaiaException.php';
require_once 'Zend/Db.php';

/**
 *
 */
class Index {

	/**
	 * @var Index
	 */
	private static $instance;

	/**
	 * @var boolean
	 */
	private static $maintenanceMode;

	/**
	 * @var EntityMapper
	 */
	private $entity;

	/**
	 * @desc Singleton
	 */
	private function __construct() {
		try {
			$this->entity = new EntityMapper();
		} catch(MaiaException $me) {
			$errormsg = rawurlencode($me->getMessage());
		header("Location: not_configured.php?error=$errormsg");
		}


	}

	final private function __clone() {}

	/**
	 * @static
	 * @return Index
	 */
	public static function getInstance($maintenance = false) {
		self::$maintenanceMode = is_bool($maintenance) ? $maintenance : false;

		if (!self::$instance instanceof Index) {
			self::$instance = new Index();
		}
		return self::$instance;
	}

	/**
	 * @return string
	 */
	public function getHeaderLogo() {

		try {
			try {
				$select = $this->entity->select();
				$select->setIntegrityCheck(false);
				$select->from('entityMapper', 'entityMapper.*');
				$select->from('', 'entityMapperHelper.entityMapperHelperQuery');
				$select->joinInner('entityMapperHelper', 'entityMapper.entityMapperId = entityMapperHelper.entityMapperId', array());
				$select->where('entityMapperHelper.entityMapperHelperId = ?', __FUNCTION__);

				$queryRecord = $this->entity->fetchRow($select);

				//print '<pre>'.print_r($queryRecord->getTable()->info('metadata'),true).'</pre>';die($select->__toString());
				$db = Zend_Db::factory(Config::getAdapter(), Config::getConfigFromEntityMapper($queryRecord));
				$db->getConnection();
				$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$obj = $db->fetchRow($queryRecord->entityMapperHelperQuery);
			} catch (Exception $e) {
				throw new MaiaException('Consulta inv&aacute;lida');
			}
		} catch (MaiaException $me) {
			print $me->getMessage();
		}
		return empty($obj) ? '' : "<img class='header_logo' src='" . Site::getPath() . '/' . $obj->head_logo_path . "' alt='" . $obj->description . "'>";
	}

	/**
	 * @return array of StdClass
	 */
	public function getHeaderNav() {

		try {
			try {
				$select = $this->entity->select();
				$select->setIntegrityCheck(false);
				$select->from('entityMapper', 'entityMapper.*');
				$select->from('', 'entityMapperHelper.entityMapperHelperQuery');
				$select->joinInner('entityMapperHelper', 'entityMapper.entityMapperId = entityMapperHelper.entityMapperId', array());
				$select->where('entityMapperHelper.entityMapperHelperId = ?', __FUNCTION__);

				$queryRecord = $this->entity->fetchRow($select);

				//print '<pre>'.print_r($queryRecord->getTable()->info('metadata'),true).'</pre>';die($select->__toString());
				$db = Zend_Db::factory(Config::getAdapter(), Config::getConfigFromEntityMapper($queryRecord));
				$db->getConnection();
				$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$obj = $db->fetchAll($queryRecord->entityMapperHelperQuery);
			} catch (Exception $e) {
				throw new MaiaException('Consulta inv&aacute;lida');
			}
		} catch (MaiaException $me) {
			print $me->getMessage();
		}
		return $obj;
	}



	/**
	 * @return StdClass
	 */
	public function getLayoutConfiguration() {
		try {
			try {
				$select = $this->entity->select();
				$select->setIntegrityCheck(false);
				$select->from('entityMapper', 'entityMapper.*');
				$select->from('', 'entityMapperHelper.entityMapperHelperQuery');
				$select->joinInner('entityMapperHelper', 'entityMapper.entityMapperId = entityMapperHelper.entityMapperId', array());
				$select->where('entityMapperHelper.entityMapperHelperId = ?', __FUNCTION__);

				$queryRecord = $this->entity->fetchRow($select);

				//print '<pre>'.print_r($queryRecord,true).'</pre>';die($select->__toString());
				$db = Zend_Db::factory(Config::getAdapter(), Config::getConfigFromEntityMapper($queryRecord));
				$db->getConnection();
				$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$obj = $db->fetchRow($queryRecord->entityMapperHelperQuery);
			} catch (Exception $e) {
				throw new MaiaException('Consulta inv&aacute;lida');
			}
		} catch (MaiaException $me) {
			print $me->getMessage();
		}

		// NO LAYOUT DEFINED, DEFAULT LOADED
		if ($obj == false) {
			$obj->name = 'default';
			$obj->css_source_folder = 'default';
		}

		$obj->header_template = 'layout/'.$obj->name.'/header.tpl';
		$obj->footer_template = 'layout/'.$obj->name.'/footer.tpl';

		return $obj;
	}

}
