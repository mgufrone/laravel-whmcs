<?php namespace Beon\Whmcs;

class Response implements \ArrayAccess
{
	private $result;
	private $message;
	private $response;
	public function __construct($response)
	{
		$this->evaluate($response);
	}

	private function evaluate($response)
	{
		$response = json_decode($response);

		$this->result = $response->result;
		if(isset($response->message))
		$this->message = $response->message;
		unset($response->result);
		if(isset($response->message))
		unset($response->message);
		$this->response = json_decode(json_encode($response),1);
		return $this;
	}

	public function isSuccess()
	{
		return $this->result == 'success';
	}
	public function getMessage()
	{
		return $this->message;
	}
	public function getResponse()
	{
		return $this->response;
	}
	public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->response[] = $value;
        } else {
            $this->response[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->response[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->response[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}