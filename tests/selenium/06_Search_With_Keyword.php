<?php
class SearchWithKeyword extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSearchWithKeyword()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('search_text')->value('Test');
        $this->byClassName('geodir_submit_search')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Search Places For"), "Not in search results page");
    }
}
?>