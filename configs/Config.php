<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ricardo
 * Date: 14/07/12
 * Time: 13:20
 * To change this template use File | Settings | File Templates.
 */
class Config {
	public static function getConfig() {
		return array(	'host'		=>	'localhost',
						'username'	=>	'toor',
						'password'	=>	'masterkey',
						'dbname'	=>	'system');
	}

	public static function getAdapter() { return 'Pdo_Mysql'; }

	public static function getConfigFromEntityMapper($t) {
		return array(	'host'		=>	$t->entityMapperHost,
						'username'	=>	$t->entityMapperUsername,
						'password'	=>	$t->entityMapperPassword,
						'dbname'	=>	$t->entityMapperDatabaseName);
	}
}
