<?php
class TestCase extends Orchestra\Testbench\TestCase 
{
	protected function getPackageProviders()
    {
        return array('Beon\Whmcs\WhmcsServiceProvider');
    }	
    protected function getPackageAliases()
    {
        return array(
            'Whmcs' => 'Beon\Whmcs\Facades\Whmcs',
        );
    }
    public function testStart()
    {
        $this->assertEquals('beon/whmcs','beon/whmcs');
    }
}
