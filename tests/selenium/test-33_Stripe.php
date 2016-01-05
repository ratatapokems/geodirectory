<?php
class Stripe extends GD_Test
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

    public function testStripe()
    {
        $this->logInfo('Testing stripe......');
        //make sure Stripe payment plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $is_active = $this->byId("stripe-payment-geodirectory-add-on")->attribute('class');
        if (is_int(strpos($is_active, 'inactive'))) {
            //Activate Geodirectory stripe payment geodirectory add on
            $this->maybeActivatePlugin("stripe-payment-geodirectory-add-on", 20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("stripe-payment-geodirectory-add-on")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "stripe payment geodirectory add on plugin not active");


        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=paymentmanager_fields&subtab=geodir_payment_options');
        $this->waitForPageLoadAndCheckForErrors();

        $this->url(self::GDTEST_BASE_URL.'author/admin/?geodir_dashbord=true&stype=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('geodir-upgrade')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byXPath("(//div[@class='geodir_package']/input[@type='radio'])[2]")->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('geodir_accept_term_condition')->click();
        $this->byXPath("//div[@id='geodir-add-listing-submit']//input[@type='submit']")->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byCssSelector('css=input[name="Submit and Pay"]')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gd_pmethod_stripe')->click();
        $this->byId('gd_checkout_paynow')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('email')->value('test@test.com');
        $this->byId('card_number')->value('4242424242424242');
        $this->byId('cc-exp')->value('12 / 20');
        $this->byId('cc-csc')->value('333');
        $this->byId('submitButton')->click();
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