<?php
class NewLocation extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testNewLocation()
    {
        //make sure multi locations plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-location-manager")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Location Manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=managelocation_fields&subtab=geodir_location_addedit');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gd_city')->value('texas');
        $this->byId('gd_set_address_button')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('geodir_location_save')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Location saved successfully."), "Not in Author page");
    }
}
?>