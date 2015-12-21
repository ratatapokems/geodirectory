<?php
class CheckLoginBox extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckLoginBox()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>