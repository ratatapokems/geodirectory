<?php
class Geolocation extends GD_Test
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

    public function testGeolocation()
    {
        $this->logInfo('Test Geolocation......');
        //make sure multi locations plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-location-manager")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Location Manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        //test country
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'places/united-states/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("in United States"), "Not in country page");

        //test region
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'places/united-states/new-york/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("in New York"), "Not in region page");

        //test city
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("in New York"), "Not in city page");

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