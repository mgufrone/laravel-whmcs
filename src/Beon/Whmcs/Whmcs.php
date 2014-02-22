<?php
namespace Beon\Whmcs;
use Guzzle\Http\Client;
use Beon\Whmcs\Response as WhmcsResponse;
use Beon\Whmcs\Models\Domains;
// use Beon\Whmcs\Models\Addons;
class Whmcs
{
	public function getHost()
	{
		return \Config::get('whmcs-api::host');
	}

	public function getUsername()
	{	
		return \Config::get('whmcs-api::username');
	}

	public function getPassword()
	{	
		return \Config::get('whmcs-api::password');
	}

	public function send($action, $arguments=array())
	{

		$data = $arguments;
		$data['action'] = $action;
		$host = $this->getHost();
		$username = $this->getUsername();
		$password = $this->getPassword();
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['responsetype'] = 'json';
		$client = new Client($host);
		$request = $client->post('includes/api.php',array(),$data);
		$response = $request->send();
		$result_content = $response->getBody();

		return new WhmcsResponse($result_content);
	}
	public function set($key, $value)
	{
		return \Config::set('whmcs-api::'.$key, $value);
	}

	public function domain()
	{
		$domains = Domains::on('whmcs-api')->get();
		foreach($domains as $domain)
		{
			$pricing = $domain->pricing();
			foreach($pricing as $price)
			{
				$domain->prices[$price->type][$price->currencies->code] = array(
					'annually'=>$price->msetupfee,
					'biennially'=>$price->qsetupfee,
					'triennially'=>$price->ssetupfee,
					'4year'=>$price->asetupfee,
					'5year'=>$price->bsetupfee,
					'6year'=>$price->tsetupfee,
					'7year'=>$price->monthly,
					'8year'=>$price->quarterly,
					'9year'=>$price->semiannually,
					'10year'=>$price->annually,
				);
			}
			$domain->prices = json_decode(json_encode($domain->prices));
		}
		return $domains;
	}
	public function __call($action, $arguments=array())
	{
		array_unshift($arguments, $action);
		return call_user_func_array(array($this, 'send'), $arguments);	
	}
}
