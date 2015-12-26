<?php
class CheckPinpoint extends GD_Test
{
    public function setUp()
    {
        parent::setUp();

        //skip test if already completed.
        if ($this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            $this->markTestSkipped('Skipping '.pathinfo(__FILE__, PATHINFO_FILENAME).' since its already completed......');
            return;
        }
    }

    public function testCheckPinpoint()
    {
        $this->logInfo('Checking pin point......');
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $script_enter = 'jQuery("a.geodir-pinpoint-link").trigger("mouseover");';
        $script_out = 'jQuery("a.geodir-pinpoint-link").trigger("mouseout");';
        $this->execute( array( 'script' => $script_enter , 'args'=>array() ) );
        $this->waitForPageLoadAndCheckForErrors(5000);
        $this->execute( array( 'script' => $script_out , 'args'=>array() ) );
    }

    public function tearDown()
    {
        //write current file number to completed.txt
        $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
        $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
        fwrite($completed, $CurrentFileNumber);
    }
}
?>