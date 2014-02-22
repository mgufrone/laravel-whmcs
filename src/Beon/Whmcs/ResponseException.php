<?php namespace Beon\Whmcs;

class ResponseException extends \Exception
{
	public $exception;
	public function __construct($exception)
	{
		$this->exception = $exception;
	}
	public function __toString()
	{
		return "Error Response : ".$this->exception->getMessage();
	}
}