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
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/controllers/RocketPizzaException.php';
require_once 'Zend/Db.php';

/**
 *
 */
class ProductList {

	/**
	 * @var ProductList
	 */
	private static $instance;

	private $entity;

	private $context;
	/**
	 * @desc Singleton
	 */
	private function __construct() {
		$this->entity = new EntityMapper();
		$this->context = __CLASS__;
	}

	final private function __clone() {}

	/**
	 * @static
	 * @return ProductList
	 */
	public static function getInstance() {
		if (!self::$instance instanceof ProductList) {
			self::$instance = new ProductList();
		}
		return self::$instance;
	}

	public function getContent() {
		try {
			return $this->entity->getEntityParameters(__FUNCTION__, 'all', $this->context);
		} catch (RocketPizzaException $me) {
			print $me->getMessage();
		}
	}


}
