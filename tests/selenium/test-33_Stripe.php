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
            $this->logInfo('Activating stripe payment geodirectory add on......');
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
            $this->waitForPageLoadAndCheckForErrors();
            $this->hideAdminBar();
            $this->byXPath("//tr[@id='stripe-payment-geodirectory-add-on']//span[@class='activate']/a")->click();
            $this->waitForPageLoadAndCheckForErrors(20000);
            //go back to plugin page
            $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        }

        $is_active1 = $this->byId("stripe-payment-geodirectory-add-on")->attribute('class');
        $this->assertFalse( strpos($is_active1, 'inactive'), "stripe payment geodirectory add on plugin not active");


        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=paymentmanager_fields&subtab=geodir_payment_options');
        $this->waitForPageLoadAndCheckForErrors();
        //todo: find a way to check strip is active

        $this->url(self::GDTEST_BASE_URL.'author/admin/?geodir_dashbord=true&stype=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('geodir-upgrade')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byCssSelector('css=#geodir_price_package_8 > input[name="package_id"]')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('geodir_accept_term_condition')->click();
        $this->byCssSelector('css=#geodir-add-listing-submit > input.geodir_button')->click();
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