<?php
class BrowseGDPages extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testBrowseGDPages()
    {
        //Browse all GD pages and catch errors and warnings
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'places/united-states/');
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'add-listing/?listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'add-listing/?listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();


    }
}
?>