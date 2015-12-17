<?php
class SwitchLocations extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSwitchLocations()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoad();
    }
}
?>