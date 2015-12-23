<?php
class SortListing extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSortListing()
    {
        //Make sure sorting options available
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->select($this->byId('sort_by'))->selectOptionByLabel('Review Desc');
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>