<?php
class ClaimAListing extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testClaimAListing()
    {
        //make sure claim manager plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-claim-manager")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Claim Manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('geodir_claim_enable')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('geodir_full_name')->value('Test User');
        $this->byId('geodir_user_number')->value('44444444444');
        $this->byId('geodir_user_position')->value('Business Manager');
        $this->byName('geodir_Send')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Request sent successfully"), "Success text not found");
        //Goto claim page
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=claimlisting_fields&subtab=manage_geodir_claim_listing');
    }
}
?>