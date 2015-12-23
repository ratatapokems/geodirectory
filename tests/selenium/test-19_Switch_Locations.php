<?php
class SwitchLocations extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSwitchLocations()
    {
        //make sure multi locations plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-location-manager")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Location Manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

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
        //find a way to select menu
        $this->byName('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //front end switch locations
        //find a way to click the elements
    }
}
?>