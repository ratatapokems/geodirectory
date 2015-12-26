<?php
class GDBooster extends GD_Test
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

    public function testGDBooster()
    {
        $this->logInfo('Testing GD booster......');

        //make sure GD Booster plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("gd-booster")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "GD Booster plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }


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