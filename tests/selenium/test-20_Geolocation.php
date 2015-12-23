<?php
class Geolocation extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGeolocation()
    {
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
}
?>