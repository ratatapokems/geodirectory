<?php
class ImportExport extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testImportExport()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoad();
    }
}
?>