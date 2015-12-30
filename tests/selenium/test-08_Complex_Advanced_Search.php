<?php
class ComplexAdvancedSearch extends GD_Test
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

    public function testComplexAdvancedSearch()
    {
        $this->logInfo('Testing complex advanced search......');
        //make sure advance search filters plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $is_active = $this->byId("geodirectory-advance-search-filters")->attribute('class');
        if (is_int(strpos($is_active, 'inactive'))) {
            //Activate Geodirectory Advance Search Filters
            $this->logInfo('Activating Advance Search Filters......');
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
            $this->waitForPageLoadAndCheckForErrors();
            $this->hideAdminBar();
            $this->byXPath("//tr[@id='geodirectory-advance-search-filters']//span[@class='activate']/a")->click();
            $this->waitForPageLoadAndCheckForErrors(20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("geodirectory-advance-search-filters")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "Advance Search Filters plugin not active");

        //Add search fields
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $script = 'jQuery("#field_frm1").show();';
        $this->execute( array( 'script' => $script , 'args'=>array() ) );
        $this->byId('cat_filter')->click();
        $this->byId('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=advance_search&listing_type=gd_place');
        $this->byId('gt-gd_placecategory')->click();
        $this->waitForPageLoadAndCheckForErrors(2000);
        $link = $this->byXPath("//li[@id='licontainer_dist']/div[contains(@class,'titledist')]");
        $this->moveto($link);
        $this->doubleclick();

//        $this->byXPath("//li[@id='licontainer_dist']/div[contains(@class,'titledist')]")->click();
//        $script = 'jQuery("#field_frmgd_placecategory").show();';
//        $this->execute( array( 'script' => $script , 'args'=>array() ) );
        $this->byId('front_search_title')->value('Category');
        $this->byId('save')->click();
        $this->waitForPageLoadAndCheckForErrors();


        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('search_text')->value('Test');
        $this->byClassName('showFilters')->click();
        $this->byName('sgd_placecategory[]')->value("2");
        $this->byClassName('geodir_submit_search')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Search Places For"), "Not in search results page");
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