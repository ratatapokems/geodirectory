<?php
class SortListing extends GD_Test
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

    public function testSortListing()
    {
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gt-text')->click();
        $this->waitForPageLoadAndCheckForErrors();

        $link = $this->byXPath("//li[@id='licontainer_new9']/div[contains(@class,'titlenew9')]");
        $this->moveto($link);
        $this->doubleclick();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('admin_title')->value('Price');
        $this->byId('site_title')->value('Price');
        $this->byId('htmlvar_name')->value('price');
        $this->byId('clabels')->value('Price');
        $this->select($this->byId("is_active"))->selectOptionByLabel('Yes');
        $this->select($this->byId("show_on_listing"))->selectOptionByLabel('Yes');
        $this->select($this->byId("show_on_detail"))->selectOptionByLabel('Yes');
        $this->byId('cat_sort')->click();
        $this->byId('cat_filter')->click();
        $this->byId('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        $this->logInfo('Testing list sorting......');
        //Make sure sorting options available
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->select($this->byId('sort_by'))->selectOptionByLabel('Review Desc');
        $this->waitForPageLoadAndCheckForErrors();
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