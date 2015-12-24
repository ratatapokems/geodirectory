<?php
class Initialize extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testInitialize()
    {
        // Check plugins available
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();

        $stop_script = false;

        if (!$this->isElementExists("geodirectory")) {
            echo "Event manager not installed";
            echo "\n";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-advance-search-filters")) {
            echo "GeoDirectory Advance Search Filters not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-affiliatewp-integration")) {
            echo "GeoDirectory AffiliateWP Integration not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-ajax-duplicate-alert")) {
            echo "GeoDirectory Ajax Duplicate Alert not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-buddypress-integration")) {
            echo "GeoDirectory BuddyPress Integration not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-claim-manager")) {
            echo "GeoDirectory Claim Manager not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-custom-post-types")) {
            echo "GeoDirectory Custom Post Types not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-events")) {
            echo "GeoDirectory Events not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("gd-booster")) {
            echo "GD Booster not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-location-manager")) {
            echo "GeoDirectory Location Manager not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-marker-cluster")) {
            echo "GeoDirectory Marker Cluster not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-payment-manager")) {
            echo "GeoDirectory Payment Manager not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-re-captcha")) {
            echo "GeoDirectory Re-Captcha not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-review-rating-manager")) {
            echo "GeoDirectory Review Rating Manager not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-social-importer")) {
            echo "GeoDirectory Social Importer not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("stripe-payment-geodirectory-add-on")) {
            echo "Stripe Payment GeoDirectory Add-on not installed";
            echo "\n";
            $stop_script = true;
        }

        if (!$this->isElementExists("buddypress")) {
            echo "BuddyPress not installed";
            echo "\n";
            $stop_script = true;
        }

        if($stop_script) {
            echo "Stopping the script. Please fix the errors to continue";
            return;
        }


        //Activate WordPress database reset
        $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $this->hideAdminBar();
        if (is_int(strpos($this->byId("wordpress-database-reset")->attribute('class'), 'inactive'))) {
            $this->byXPath("//tr[@id='wordpress-database-reset']//span[@class='activate']/a")->click();
        }
        $this->waitForPageLoadAndCheckForErrors();

        //reset the db
        $this->url(self::GDTEST_BASE_URL.'wp-admin/tools.php?page=database-reset');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('select-all')->click();
        $this->waitForPageLoadAndCheckForErrors(5000);
        $this->byId('db-reset-reactivate-theme-data')->click();
        $code = $this->byId('security-code')->text();
        $this->byId('db-reset-code-confirm')->value($code);
        $this->waitForPageLoadAndCheckForErrors(5000);
        $this->byId('db-reset-submit')->click();
        $this->acceptAlert();
        $this->waitForPageLoadAndCheckForErrors();

        // make sure all plugins not active. We will activate it programatically.
        $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $this->hideAdminBar();

        if (!is_int(strpos($this->byId("geodirectory")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-advance-search-filters")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Advance Search Filters is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-affiliatewp-integration")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory AffiliateWP Integration is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-ajax-duplicate-alert")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Ajax Duplicate Alert is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-buddypress-integration")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory BuddyPress Integration is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-claim-manager")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Claim Manager is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-custom-post-types")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Custom Post Types is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-events")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Events is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("gd-booster")->attribute('class'), 'inactive'))) {
            echo "GD Booster is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-location-manager")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Location Manager is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-marker-cluster")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Marker Cluster is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-payment-manager")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Payment Manager is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-re-captcha")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Re-Captcha is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-review-rating-manager")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Review Rating Manager is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("geodirectory-social-importer")->attribute('class'), 'inactive'))) {
            echo "GeoDirectory Social Importer is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("stripe-payment-geodirectory-add-on")->attribute('class'), 'inactive'))) {
            echo "Stripe Payment GeoDirectory Add-on is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if (!is_int(strpos($this->byId("buddypress")->attribute('class'), 'inactive'))) {
            echo "BuddyPress is active. Please deactivate it. It will be activated programatically.";
            echo "\n";
            $stop_script = true;
        }

        if($stop_script) {
            echo "Stopping the script. Please fix the errors to continue";
            return;
        }

        //make sure GDF theme installed
        $this->url(self::GDTEST_BASE_URL.'wp-admin/themes.php');
        $this->waitForPageLoadAndCheckForErrors();
        if (!$this->isElementExists("geodirectory_framework-name")) {
            echo "GeoDirectory Framework theme not installed";
            echo "\n";
            $stop_script = true;
        }

        if($stop_script) {
            echo "Stopping the script. Please fix the errors to continue";
            return;
        }

        //Activate GDF theme if not active
        $is_active = $this->byXPath("//div[contains(@class, 'theme') and contains(@class, 'active')]")->attribute('aria-describedby');
        if (strpos($is_active, 'geodirectory_framework-name')) {
            //GDF already active
        } else {
            //Activate GDF
            $this->byXPath("//div[contains(@aria-describedby, 'geodirectory_framework-action') and contains(@aria-describedby, 'geodirectory_framework-name')]//div[@class='theme-actions']//a[contains(@class, 'activate')]")->click();
            $this->waitForPageLoadAndCheckForErrors();
            $this->assertTrue( $this->isTextPresent("New theme activated"), "'New theme activated' text not found");
        }

        //Activate Geodirectory core
        $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $this->hideAdminBar();
        $this->byXPath("//tr[@id='geodirectory']//span[@class='activate']/a")->click();
        $this->waitForPageLoadAndCheckForErrors(20000);

        //set default location
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=default_location_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('city')->value('New York');
        $this->byId('set_address_button')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byId('location_save')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Your settings have been saved"), "'Your settings have been saved' text not found");
        $this->waitForPageLoadAndCheckForErrors();

        //install place dummy data
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Dummy Data')->click();
        $this->select($this->byClassName('selected_sample_data'))->selectOptionByLabel('10');
        $this->byId('geodir_dummy_insert')->click();
        $this->waitForPageLoadAndCheckForErrors(60000);

        //make sure dummy data installed
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Dummy Data')->click();
        $this->assertTrue( $this->isTextPresent("GeoDirectory sample data has been populated"), "'GeoDirectory sample data has been populated' text not found");

        //Activate Geodirectory Events
        $this->url(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $this->hideAdminBar();
        $this->byXPath("//tr[@id='geodirectory-events']//span[@class='activate']/a")->click();
        $this->waitForPageLoadAndCheckForErrors(20000);

        //install Events dummy data
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Event Dummy Data')->click();
        $this->select($this->byXPath("//div[@id='sub_gdevent_dummy_data_settings']//select[@class='selected_sample_data']"))->selectOptionByLabel('10');
        $this->byXPath("//div[@id='sub_gdevent_dummy_data_settings']//a[@id='geodir_dummy_insert']")->click();
        $this->waitForPageLoadAndCheckForErrors(60000);

        //make sure Events dummy data installed
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=general_settings&active_tab=gdevent_dummy_data_settings');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("GeoDirectory sample data has been populated"), "'GeoDirectory sample data has been populated' text not found");

        //set home page
        $this->url(self::GDTEST_BASE_URL.'wp-admin/options-reading.php');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byXPath("//input[@value='page']")->click();
        $this->select($this->byId("page_on_front"))->selectOptionByLabel('GD Home page');
        $this->byId("submit")->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Settings saved"), "'Settings saved' text not found");

    }

}
?>