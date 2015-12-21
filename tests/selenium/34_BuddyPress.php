<?php
class BuddyPress extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testBuddyPress()
    {
        //make sure BuddyPress core plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("buddypress")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "BuddyPress core plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
        //make sure BuddyPress Integration plugin active
        $is_active = $this->byId("geodirectory-buddypress-integration")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "BuddyPress Integration plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
    }
}
?>