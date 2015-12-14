<?php
class RegisterUser extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setSeleniumServerRequestsTimeout(60);
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/whoop/');
    }

    public function testRegister()
    {
        $this->url('http://localhost/whoop/gd-login/?signup=1');
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        $this->assertTrue( $this->isTextPresent("Sign Up Now"), "No text found");
        $this->byId('user_email')->value($this->randomEmailID());
        $this->byId('user_fname')->value('Test User');
        // Submit the form
        $this->byId('cus_registerform')->submit();
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        $this->assertFalse( $this->isTextPresent("New user registration disabled."), "New user registration disabled.");
        $this->assertFalse( $this->isTextPresent("This email is already registered."), "This email is already registered.");
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

    function randomEmailID()
    {
        return md5(uniqid(rand(), true)).'@gmail.com';
    }

}
?>