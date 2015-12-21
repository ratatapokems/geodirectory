<?php
class TestDummyData extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testTestDummyData()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>