<?php
class SearchWithNear extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSearchWithNear()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('snear')->value('New York');
        $this->byClassName('geodir_submit_search')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Search Places For"), "Not in search results page");
    }
}
?>