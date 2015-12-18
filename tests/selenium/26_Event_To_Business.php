<?php
class EventToBusiness extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testEventToBusiness()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>