<?php
class CheckMaps extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckMaps()
    {
        //home map
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("geodir-map-home-page"), "Home page map not found");

        //listing map
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("geodir-map-listing-page"), "Listing page map not found");

        //detail map
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("geodir-map-detail-page"), "Detail page map not found");
    }
}
?>