<?php
class DeleteListing extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testDeleteListing()
    {
        $this->url(self::GDTEST_BASE_URL.'author/admin/?geodir_dashbord=true&stype=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('geodir-delete')->click();
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>