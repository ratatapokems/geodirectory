<?php
class CheckNotifications extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckNotifications()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>