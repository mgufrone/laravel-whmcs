<?php namespace Beon\Whmcs\Models;
use \Eloquent;

class Currency extends Eloquent
{
	public $table = 'tblcurrencies';
	public function getConnection()
    {
        return static::resolveConnection('whmcs-api');
    }
}