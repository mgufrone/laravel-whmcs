<?php namespace Beon\Whmcs\Models;
use \Eloquent;

class Pricing extends Eloquent
{
	public $table = 'tblpricing';

	public function currencies()
	{
		return $this->belongsTo('Beon\Whmcs\Models\Currency','currency');
	}
}