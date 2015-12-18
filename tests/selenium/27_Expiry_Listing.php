<?php
class ExpiryListing extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testExpiryListing()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>