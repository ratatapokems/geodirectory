<?php
class CheckLoginBox extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCheckLoginBox()
    {
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("gdf_welcome_login_wrap"), "Login welcome widget not found");
        $this->byName('log')->value('test@test.com');
        $this->byName('pwd')->value('12345');
        // Submit the form
        $this->byClassName('b_signin')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertFalse( $this->isTextPresent("Invalid Username/Password."), "Invalid Username/Password.");
        $this->assertTrue( $this->isTextPresent("Welcome,"), "Welcome text not found");
    }
}
?>