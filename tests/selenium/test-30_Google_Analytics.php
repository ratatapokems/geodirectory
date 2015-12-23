<?php
class GoogleAnalytics extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGoogleAnalytics()
    {
        //make sure Google Analytics Authorized
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=general_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Google Analytics')->click();

        $value = $this->byId('geodir_ga_id')->value();
        if (empty($value)) {
            echo "Google Analytics not configured";
        }

        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>