<?php
class BrowseGDPages extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testBrowseGDPages()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>