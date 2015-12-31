<?php
class AddCustomFields extends GD_Test
{
    public function setUp()
    {
        parent::setUp();

        //skip test if already completed.
        if ($this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            $this->markTestSkipped('Skipping '.pathinfo(__FILE__, PATHINFO_FILENAME).' since its already completed......');
            return;
        }
    }

    public function testAddCustomFields()
    {
        $this->logInfo('Add custom fields......');
        //Field 1
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gt-text')->click();
        $link = $this->byXPath("//li[@id='licontainer_new10']/div[contains(@class,'titlenew10')]");
        $this->moveto($link);
        $this->doubleclick();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('admin_title')->value('Text Field');
        $this->byId('site_title')->value('Text Field');
        $this->byId('admin_desc')->value('Text Field');
        $this->byId('htmlvar_name')->value('text_field');
        $this->byId('clabels')->value('Text Field');
        $this->select($this->byId('is_default'))->selectOptionByLabel('Yes');
        $this->select($this->byId('is_active'))->selectOptionByLabel('Yes');
        $this->select($this->byId('show_on_listing'))->selectOptionByLabel('Yes');
        $this->select($this->byId('show_on_detail'))->selectOptionByLabel('Yes');
        $this->byId('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        //Field 2
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gt-text')->click();
        $link = $this->byXPath("//li[@id='licontainer_new11']/div[contains(@class,'titlenew11')]");
        $this->moveto($link);
        $this->doubleclick();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('admin_title')->value('Text Field 2');
        $this->byId('site_title')->value('Text Field 2');
        $this->byId('admin_desc')->value('Text Field 2');
        $this->byId('htmlvar_name')->value('text_field_2');
        $this->byId('clabels')->value('Text Field 2');
        $this->select($this->byId('is_default'))->selectOptionByLabel('Yes');
        $this->select($this->byId('is_active'))->selectOptionByLabel('Yes');
        $this->select($this->byId('show_on_listing'))->selectOptionByLabel('Yes');
        $this->select($this->byId('show_on_detail'))->selectOptionByLabel('Yes');
        $this->byId('save')->click();
        $this->waitForPageLoadAndCheckForErrors();
    }

    public function tearDown()
    {
        if (!$this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            //write current file number to completed.txt
            $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
            $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
            fwrite($completed, $CurrentFileNumber);
        }
    }
}
?>