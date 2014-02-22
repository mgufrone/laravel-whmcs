<?php
namespace Beon\Whmcs;
use Composer\Script\Event;
class Installer 
{
	public static function run(Event $event)
	{
		static::call(true);
	}
	public static function call($composer=false)
	{
		$dir = dirname(dirname(dirname(__FILE__))).'/config';
		if(!file_exists($dir.'/config.php'))
		{
			copy($dir.'/config.php.example', $dir.'/config.php');
			return "Configuration has been created under this package config directory";
		}
		else
			return "Configuration file already exists. We won't override it";
	}
}