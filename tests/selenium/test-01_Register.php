<?php
class Register extends GD_Test
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

    public function testRegister()
    {
        $this->logInfo('Registering new user......');
        $this->url(self::GDTEST_BASE_URL.'gd-login/?signup=1');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Sign Up Now"), "No text found");
        $this->byId('user_email')->value($this->randomEmailID());
        $this->byId('user_fname')->value('Test User');
        // Submit the form
        $this->byId('cus_registerform')->submit();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertFalse( $this->isTextPresent("New user registration disabled."), "New user registration disabled.");
        $this->assertFalse( $this->isTextPresent("This email is already registered."), "This email is already registered.");
        $this->assertTrue( $this->isTextPresent("Add Listing"), "Add Listing text not found");
    }

    public function tearDown()
    {
        //write current file number to completed.txt
        $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
        $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
        fwrite($completed, $CurrentFileNumber);
    }

}
?>