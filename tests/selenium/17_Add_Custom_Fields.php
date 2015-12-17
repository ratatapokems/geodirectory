<?php
class AddCustomFields extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testAddCustomFields()
    {
        //Field 1
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $this->waitForPageLoad();
        $this->byId('gt-text')->click();
        $this->byId('licontainer_new10')->click();
        $this->waitForPageLoad();
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
        $this->waitForPageLoad();

        //Field 2
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=gd_place_fields_settings&subtab=custom_fields&listing_type=gd_place');
        $this->waitForPageLoad();
        $this->byId('gt-text')->click();
        $this->byId('licontainer_new11')->click();
        $this->waitForPageLoad();
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
        $this->waitForPageLoad();
    }
}
?>