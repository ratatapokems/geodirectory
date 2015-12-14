<?php
class LoginUser extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setSeleniumServerRequestsTimeout(60);
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/whoop/');
    }

    public function testLogin()
    {
        $this->url('http://localhost/whoop/gd-login/?signup=1');
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        $this->assertTrue( $this->isTextPresent("Sign In"), "No text found");
        $this->byId('user_login')->value('test@test.com');
        $this->byId('user_pass')->value('12345');
        $this->byId('rememberme')->click();
        // Submit the form
        $this->byId('cus_loginform')->submit();
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        $this->assertFalse( $this->isTextPresent("Invalid Username/Password."), "Invalid Username/Password.");
        $this->assertTrue( $this->isTextPresent("Add Listing"), "Add Listing text not found");
    }

    function isTextPresent($search)
    {
        $source = $this->source();
        if ( strpos((string)$source,$search) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }

}
?>