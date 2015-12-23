<?php
class ReCaptcha extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testReCaptcha()
    {
        //make sure ReCaptcha plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-re-captcha")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "ReCaptcha plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=geodir_recaptcha&subtab=gdcaptcha_settings');
        $value = $this->byId('geodir_recaptcha_site_key')->value();
        if (empty($value)) {
            echo "Google ReCaptcha not configured";
        }

        $to_save = false;
        $is_checked_1 = $this->byId('geodir_recaptcha_registration')->attribute('checked');
        if (!$is_checked_1) {
            $this->byId('geodir_recaptcha_registration')->click();
            $to_save = true;
        }

        $is_checked_2 = $this->byId('geodir_recaptcha_add_listing')->attribute('checked');
        if (!$is_checked_2) {
            $this->byId('geodir_recaptcha_add_listing')->click();
            $to_save = true;
        }

        $is_checked_3 = $this->byId('geodir_recaptcha_claim_listing')->attribute('checked');
        if (!$is_checked_3) {
            $this->byId('geodir_recaptcha_claim_listing')->click();
            $to_save = true;
        }

        $is_checked_4 = $this->byId('geodir_recaptcha_comments')->attribute('checked');
        if (!$is_checked_4) {
            $this->byId('geodir_recaptcha_comments')->click();
            $to_save = true;
        }

        $is_checked_5 = $this->byId('geodir_recaptcha_send_to_friend')->attribute('checked');
        if (!$is_checked_5) {
            $this->byId('geodir_recaptcha_send_to_friend')->click();
            $to_save = true;
        }

        $is_checked_6 = $this->byId('geodir_recaptcha_send_enquery')->attribute('checked');
        if (!$is_checked_6) {
            $this->byId('geodir_recaptcha_send_enquery')->click();
            $to_save = true;
        }

        $is_checked_7 = $this->byId('geodir_recaptcha_buddypress')->attribute('checked');
        if (!$is_checked_7) {
            $this->byId('geodir_recaptcha_buddypress')->click();
            $to_save = true;
        }

        if ($to_save) {
            $this->byName('save')->click();
            $this->waitForPageLoadAndCheckForErrors();
        }

        //Signup
        $this->url(self::GDTEST_BASE_URL.'gd-login/?signup=1');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Sign Up Now"), "Not in signup page");
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in signup page");

        //Add Listing
        $this->url(self::GDTEST_BASE_URL.'add-listing/?listing_type=gd_place');
        $this->waitForPageLoadAndCheckForErrors();
        if ($this->isTextPresent("Sign In")) {
            $this->byId('user_login')->value('test@test.com');
            $this->byId('user_pass')->value('12345');
            $this->byId('rememberme')->click();
            // Submit the form
            $this->byId('cus_loginform')->submit();
            $this->waitForPageLoadAndCheckForErrors();
            $this->url(self::GDTEST_BASE_URL.'add-listing/?listing_type=gd_place');
        }
        $this->assertTrue( $this->isTextPresent("Add Place"), "Not in Add Listing page");
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in Add Listing page");

        //claim
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('gd-claim-button')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in claim form");

        //reviews
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Reviews')->click();
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in reviews form");

        //send enquiry
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('b_send_inquiry')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in Send Enquiry form");

        //send to friend
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('b_sendtofriend')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("I'm not a robot"), "Recaptcha field not found in Send To Friend form");

        //buddypress
        //Todo: assert buddypress page

    }
}
?>