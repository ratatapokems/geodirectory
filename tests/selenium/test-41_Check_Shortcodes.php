<?php
class CheckShortcodes extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckShortcodes()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>