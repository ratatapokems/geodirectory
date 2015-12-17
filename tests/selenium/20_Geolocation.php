<?php
class Geolocation extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGeolocation()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoad();
    }
}
?>