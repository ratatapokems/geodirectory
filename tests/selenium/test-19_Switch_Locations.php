<?php
class SwitchLocations extends GD_Test
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

    public function testSwitchLocations()
    {
        $this->logInfo('Switch locations......');
        //make sure multi locations plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $is_active = $this->byId("geodirectory-location-manager")->attribute('class');
        if (is_int(strpos($is_active, 'inactive'))) {
            //Activate Geodirectory Location Manager
            $this->logInfo('Activating Location manager......');
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
            $this->waitForPageLoadAndCheckForErrors();
            $this->hideAdminBar();
            $this->byXPath("//tr[@id='geodirectory-location-manager']//span[@class='activate']/a")->click();
            $this->waitForPageLoadAndCheckForErrors(20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("geodirectory-location-manager")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "Location Manager plugin not active");


        //Make sure Show location switcher in menu checked.
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=managelocation_fields&subtab=geodir_location_setting');
        $this->waitForPageLoadAndCheckForErrors();
        $is_checked = $this->byId('geodir_show_changelocation_nave')->attribute('checked');
        if (!$is_checked) {
            $this->byId('geodir_show_changelocation_nave')->click();
            $this->byClassName('button-primary')->click();
            $this->waitForPageLoadAndCheckForErrors();
        }

        //Set Navigation Locations
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=design_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Navigation')->click();
        $script = 'jQuery("#geodir_theme_location_nav").show();';
        $this->execute( array( 'script' => $script , 'args'=>array() ) );
        $this->select($this->byId('geodir_theme_location_nav'))->selectOptionByLabel('The Main Menu');
        $this->byName('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //Add new location
        //make sure multi locations plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $is_active = $this->byId("geodirectory-location-manager")->attribute('class');
        if (is_int(strpos($is_active, 'inactive'))) {
            //Activate Geodirectory Location Manager
            $this->logInfo('Activating Location manager......');
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
            $this->waitForPageLoadAndCheckForErrors();
            $this->hideAdminBar();
            $this->byXPath("//tr[@id='geodirectory-location-manager']//span[@class='activate']/a")->click();
            $this->waitForPageLoadAndCheckForErrors(20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("geodirectory-location-manager")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "Location Manager plugin not active");

        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=managelocation_fields&subtab=geodir_location_addedit');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gd_city')->value('las vegas');
        $this->byId('gd_set_address_button')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('geodir_location_save')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Location saved successfully."), "'Location saved successfully' text not found");

        //front end switch locations
        //find a way to click the elements
    }

    public function tearDown()
    {
        if (!$this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            //write current file number to completed.txt
            $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
            $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
            fwrite($completed, $CurrentFileNumber);
        }
    }
}
?>