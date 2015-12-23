<?php
class SearchNearMe extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSearchNearMe()
    {
        //make sure event manager plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-advance-search-filters")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "GeoDirectory Advance Search Filters plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('near-compass')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('gt_near_me_s')->click();
        $this->byClassName('geodir_submit_search')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Search Places For"), "Not in search results page");

    }
}
?>