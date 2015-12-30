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
            $this->logInfo('Activating Social Importer......');
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
            $this->waitForPageLoadAndCheckForErrors();
            $this->hideAdminBar();
            $this->byXPath("//tr[@id='geodirectory-social-importer']//span[@class='activate']/a")->click();
            $this->waitForPageLoadAndCheckForErrors(20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("geodirectory-social-importer")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "Social Importer plugin not active");

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