<?php
class LoginUser extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testLogin()
    {
        $this->url(self::GDTEST_BASE_URL.'gd-login/?signup=1');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Sign In"), "No text found");
        $this->byId('user_login')->value('test@test.com');
        $this->byId('user_pass')->value('12345');
        $this->byId('rememberme')->click();
        // Submit the form
        $this->byId('cus_loginform')->submit();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertFalse( $this->isTextPresent("Invalid Username/Password."), "Invalid Username/Password.");
        $this->assertTrue( $this->isTextPresent("Add Listing"), "Add Listing text not found");
    }

}
?>