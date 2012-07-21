<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 02/06/12
 * Time: 02:51
 * To change this template use File | Settings | File Templates.
 */
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/models/ProductList/ProductList.php';
require_once realpath(dirname(dirname(__FILE__))) . '/ControllerInterface.php';
require_once realpath(dirname(dirname(__FILE__))) . '/RocketPizzaException.php';

class ProductListController implements ControllerInterface {

	private $instance;

	public function __construct() {}

	public function authenticate() {}

	public function factory() {
		$this->setInstance(ProductList::getInstance());
	}

	public function getContent() {
		return $this->getInstance()->getContent();
	}

	public function setInstance($instance) {
		$this->instance = $instance;
	}

	public function getInstance() {
		return $this->instance;
	}
}
