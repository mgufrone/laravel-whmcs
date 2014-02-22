<?php
use Beon\Whmcs\Respnse as WhmcsResponse;
class WhmcsTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
	}
	public function testConfigurations()
	{
		$response = Whmcs::getHost();
		$this->assertTrue(is_string($response));
		$this->assertTrue(is_string(Whmcs::getUsername()));
		$this->assertTrue(is_string(Whmcs::getPassword()));
		$this->assertEquals(\Config::get('whmcs-api::host'),(Whmcs::getHost()));
	}

	public function testCallApi()
	{
		$call = Whmcs::getproducts();
		// print_r($call);
		$this->assertTrue($call->isSuccess());
		$this->assertTrue($call['products']!='');
		$this->assertTrue(is_array($call['products']));
	}

	public function testInvalid()
	{
		Whmcs::set('password','test');
		Whmcs::set('username','test');
		$this->assertEquals('test',(Whmcs::getUsername()));
		$this->assertEquals('test',(Whmcs::getPassword()));

		$call = Whmcs::getproducts();

		$this->assertTrue(!$call->isSuccess());
	}


	public function testDomainPricing()
	{
		// Whmcs::domain();
	}
}