<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 02/06/12
 * Time: 02:51
 * To change this template use File | Settings | File Templates.
 */
require_once realpath(dirname(dirname(dirname(__FILE__)))) . '/models/Index/Index.php';
require_once realpath(dirname(dirname(__FILE__))) . '/ControllerInterface.php';
require_once realpath(dirname(dirname(__FILE__))) . '/RocketPizzaException.php';

class IndexController implements ControllerInterface {

	private $instance;

	public function __construct() {}

	public function authenticate() {}

	public function factory($maintenanceMode = false) {
		switch ($maintenanceMode) {
			default:
				$this->setInstance(Index::getInstance($maintenanceMode));
				break;
		}
	}

	public function getHeaderLogo() {
		return $this->getInstance()
					->getHeaderLogo();
	}

	public function getHeaderNav() {
		return $this->getInstance()
					->getHeaderNav();
	}

	public function setInstance($instance) {
		$this->instance = $instance;
	}

	public function getInstance() {
		return $this->instance;
	}

	public function getLayoutConfiguration() {
		return $this->getInstance()
					->getLayoutConfiguration();
	}

}
