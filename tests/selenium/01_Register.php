<?php
class RegisterUser extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testRegister()
    {
        $this->url(self::GDTEST_BASE_URL.'gd-login/?signup=1');
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Sign Up Now"), "No text found");
        $this->byId('user_email')->value($this->randomEmailID());
        $this->byId('user_fname')->value('Test User');
        // Submit the form
        $this->byId('cus_registerform')->submit();
        $this->waitForPageLoad();
        $this->assertFalse( $this->isTextPresent("New user registration disabled."), "New user registration disabled.");
        $this->assertFalse( $this->isTextPresent("This email is already registered."), "This email is already registered.");
        $this->assertTrue( $this->isTextPresent("Add Listing"), "Add Listing text not found");
    }

}
?>