<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: Ricardo
	 * Date: 02/06/12
	 * Time: 03:15
	 * To change this template use File | Settings | File Templates.
	 */
	class MaiaException extends Exception {

		// Redefine the exception so message isn't optional
		public function __construct($message, $code = 0, Exception $previous = null) {

			$message = $this->customMessage($message);
			// make sure everything is assigned properly
			parent::__construct($message, $code, $previous);

		}

		// custom string representation of object
		public function __toString() {
			return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
		}

		private function customMessage($message) {
			return "<div class=\"fatal_error\" id=\"fatal_error\">$message</div>" . PHP_EOL;
		}

	}
