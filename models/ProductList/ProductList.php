<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 19/07/12
 * Time: 00:05
 * To change this template use File | Settings | File Templates.
 */

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
set_include_path(implode(PATH_SEPARATOR, array(APPLICATION_PATH . '/models', APPLICATION_PATH . '/controllers', APPLICATION_PATH . '/templates', APPLICATION_PATH . '/', get_include_path())));

require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/configs/Config.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/configs/Site.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/models/Db/entity/System/EntityMapper/EntityMapper.php';
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/controllers/Exception.php';
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
	private function __construct() {}
	final private function __clone() {}

	public function getContent() {
		try {
			try {
				require_once '../Db/entity/Rocketpizza/Product/Product.php';
				require_once '../Db/entity/Rocketpizza/Product_price/Product_price.php';
				require_once '../Db/entity/Rocketpizza/Product_size/Product_size.php';



			} catch (Exception $e) {
				throw new Exception('Consulta inv&aacute;lida');
			}
		} catch (Exception $me) {
			print $me->getMessage();
		}
	}


	/**
	 * @return StdClass
	 */
	/*
	 *
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
				throw new Exception('Consulta inv&aacute;lida');
			}
		} catch (Exception $me) {
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
	*/

}
