<?php
class SearchNearMe extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSearchNearMe()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>