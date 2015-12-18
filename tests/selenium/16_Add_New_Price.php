<?php
class ImportExport extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testImportExport()
    {
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=paymentmanager_fields&subtab=geodir_payment_manager&gd_pagetype=addeditprice');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Add Price"), "Add Price text not found");
        $this->byId('title')->value('Premium Plus');
        $this->byId('days')->value('0');
        $this->byName('gd_amount')->value('5');
        $this->select($this->byName('gd_status'))->selectOptionByValue(1);
        $this->byName('submit')->click();
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>