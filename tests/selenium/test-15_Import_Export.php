<?php
class ImportExport extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testImportExport()
    {
        //export listing
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=import_export');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gd_ie_exposts_submit')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //export cats
        $this->byId('gd_ie_excats_submit')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //Todo: find a way to test import
    }
}
?>