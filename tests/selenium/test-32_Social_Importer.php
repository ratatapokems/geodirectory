<?php
class SocialImporter extends GD_Test
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

    public function testSocialImporter()
    {
        $this->logInfo('Testing social importer......');
        //make sure Social Importer plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $is_active = $this->byId("geodirectory-social-importer")->attribute('class');
        if (is_int(strpos($is_active, 'inactive'))) {
            //Activate Geodirectory Social Importer
            $this->maybeActivatePlugin("geodirectory-social-importer", 20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("geodirectory-social-importer")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "Social Importer plugin not active");

        // facebook
        $this->url(self::GDTEST_BASE_URL.'admin.php?page=geodirectory&tab=facebook_integration&subtab=geodir_gdfi_options');
        $this->byId('gdfi_app_id')->value('');
        $this->byId('gdfi_app_secret')->value('');
        $this->byName('gdfi_facebook_integration_options_save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //yelp
        $this->url(self::GDTEST_BASE_URL.'admin.php?page=geodirectory&tab=facebook_integration&subtab=manage_gdfi_options_yelp');
        $this->byId('gdfi_yelp_key')->value('');
        $this->byId('gdfi_yelp_key_secret')->value('');
        $this->byId('gdfi_yelp_token')->value('');
        $this->byId('gdfi_yelp_token_secret')->value('');
        $this->byName('gdfi_yelp_integration_options_save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        // import listing
        $this->url(self::GDTEST_BASE_URL.'add-listing/?listing_type=gd_place');
        $this->byId('gdfi_import_url')->value('http://www.yelp.com/biz/mcdonalds-mountain-view-3');
        $this->byId('gd_facebook_import')->click();


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