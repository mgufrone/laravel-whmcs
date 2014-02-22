<?php
use Beon\Whmcs\Respnse as WhmcsResponse;
class InstallerTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testInstall()
	{
		$config_dir = dirname(dirname(__FILE__)).'/src/config';
		if(file_exists($config_dir))
		unlink($config_dir.'/config.php');
		$this->assertTrue(!file_exists($config_dir.'/config.php'));
		$message = Beon\Whmcs\Installer::call(false);
		$this->assertEquals("Configuration has been created under this package config directory",$message);
		$this->assertTrue(file_exists($config_dir.'/config.php'));
		$this->assertTrue(file_exists($config_dir.'/config.php.example'));
	}

	public function testExists()
	{

		$config_dir = dirname(dirname(__FILE__)).'/src/config';
		$this->assertTrue(file_exists($config_dir.'/config.php'));
		$message = Beon\Whmcs\Installer::call(false);
		$this->assertEquals("Configuration file already exists. We won't override it",$message);
		$this->assertTrue(file_exists($config_dir.'/config.php'));
		$this->assertTrue(file_exists($config_dir.'/config.php.example'));
	}
}