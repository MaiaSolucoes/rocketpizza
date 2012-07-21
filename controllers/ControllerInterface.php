<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: Ricardo
	 * Date: 02/06/12
	 * Time: 02:52
	 * To change this template use File | Settings | File Templates.
	 */
	interface ControllerInterface {


		/**
		 * @abstract
		 * @return mixed
		 */
		public function authenticate();

		/**
		 * @abstract
		 * @param boolean $maintenanceMode
		 * @return mixed
		 */
		public function factory($maintenanceMode = false);
	}
