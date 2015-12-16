<?php
class EditListing extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testEditListing()
    {
        $this->maybeUserLogin(self::GDTEST_BASE_URL.'author/test/?geodir_dashbord=true&stype=gd_place', true);
        $this->assertTrue( $this->isTextPresent("Places By"), "Places By text not found");
        $this->byClassName('geodir-edit')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Edit Place"), "Edit Place text not found");
        $this->byId('post_desc')->value('Test Desc modified');
        $this->byId('geodir_accept_term_condition')->click();
        // Submit the form
        $this->byCssSelector('css=#geodir-add-listing-submit > input.geodir_button')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("This is a preview of your listing"), "Not in preview page.");
        // Submit the form
        $this->byClassName('geodir_publish_button')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Thank you, your information has been successfully received"), "Not in success page");
    }

    public function testEditAdminListing()
    {
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/edit.php?post_type=gd_place');
        $this->assertTrue( $this->isTextPresent("post-type-gd_place"), "Not in Places post type");
        $this->byClassName('edit')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Edit Place"), "Edit Place text not found");
        $this->byId('title')->value('Test Listing modified');
        // Submit the form
        $this->byId('publish')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Place updated."), "updated text not found.");
    }
}
?>