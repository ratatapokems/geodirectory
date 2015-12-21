<?php
class AutoCompleters extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testAutoCompleters()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>