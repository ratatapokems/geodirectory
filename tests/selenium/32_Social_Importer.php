<?php
class SocialImporter extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSocialImporter()
    {
        //make sure Social Importer plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-social-importer")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Social Importer plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
    }
}
?>