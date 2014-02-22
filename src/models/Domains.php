<?php namespace Beon\Whmcs\Models;
use \Eloquent;
use Beon\Whmcs\Models\Pricing;
class Domains extends \Eloquent
{
	public $table = 'tbldomainpricing';
	public $prices=array();
	public function pricing()
	{
		return Pricing::on('whmcs-api')->whereIn('type',array('domainregister','domaintransfer','domainrenewal'))
		->where('relid','=',$this->id)
		->get();
	}
}