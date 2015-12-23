<?php
class CheckPinpoint extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckPinpoint()
    {
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $script_enter = 'jQuery("a.geodir-pinpoint-link").trigger("mouseover");';
        $script_out = 'jQuery("a.geodir-pinpoint-link").trigger("mouseout");';
        $this->execute( array( 'script' => $script_enter , 'args'=>array() ) );
        $this->waitForPageLoadAndCheckForErrors(5000);
        $this->execute( array( 'script' => $script_out , 'args'=>array() ) );
    }
}
?>