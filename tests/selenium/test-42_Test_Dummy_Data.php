<?php
class TestDummyData extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testTestDummyData()
    {
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=general_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Dummy Data')->click();

        $html = $this->byId('sub_dummy_data_settings')->attribute('innerHTML');
        if (strpos($html, 'Yes Delete Please!')) {
            //delete event data
        }


        //make sure event manager plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-events")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "event manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=general_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Event Dummy Data')->click();

        $html = $this->byId('sub_gdevent_dummy_data_settings')->attribute('innerHTML');
        if (strpos($html, 'Yes Delete Please!')) {
            //delete event data
        }

    }
}
?>