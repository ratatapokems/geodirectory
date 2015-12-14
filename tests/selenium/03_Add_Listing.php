<?php
class AddListing extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setSeleniumServerRequestsTimeout(60);
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/whoop/');
    }

    public function testAddListing()
    {
        $this->url('http://localhost/whoop/add-listing/?listing_type=gd_place');
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        if ($this->isTextPresent("Sign In")) {
            $this->byId('user_login')->value('test@test.com');
            $this->byId('user_pass')->value('12345');
            $this->byId('rememberme')->click();
            // Submit the form
            $this->byId('cus_loginform')->submit();
            // Wait 10 seconds
            $this->timeouts()->implicitWait(10000);
            $this->url('http://localhost/whoop/add-listing/?listing_type=gd_place');
        }
        $this->assertTrue( $this->isTextPresent("Add Place"), "Add Place text not found");
        $this->byId('post_title')->value('Test Listing');
        $this->byId('post_desc')->value('Test Desc');
        $this->byId('post_tags')->value('tag1,tag2');
        $this->byId('post_address')->value('350 Fifth Avenue');
        $this->byId('post_set_address_button')->click();
        $this->timeouts()->implicitWait(10000);
        $this->byId('geodir_timing')->value('10.00 am to 6 pm every day');
        $this->byId('geodir_contact')->value('444444444444');
        $this->byId('geodir_email')->value('test@test.com');
        $this->byId('geodir_website')->value('http://test.com');
        $this->byId('geodir_twitter')->value('http://twitter.com/test');
        $this->byId('geodir_facebook')->value('http://facebook.com/test');
        $this->byId('geodir_special_offers')->value('Test Offer');
        $this->byId('geodir_accept_term_condition')->click();
        // Submit the form
        $this->byId('geodir-add-listing-submit')->submit();
        // Wait 10 seconds
        $this->timeouts()->implicitWait(20000);
        $this->assertTrue( $this->isTextPresent("This is a preview of your listing"), "Not in preview page.");
        // Submit the form
        $this->byClassName('geodir_publish_button')->click();
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
        $this->assertTrue( $this->isTextPresent("Thank you, your information has been successfully received"), "Not in success page");
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