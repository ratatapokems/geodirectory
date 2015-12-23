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
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-advance-search-filters")) {
            echo "GeoDirectory Advance Search Filters not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-affiliatewp-integration")) {
            echo "GeoDirectory AffiliateWP Integration not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-ajax-duplicate-alert")) {
            echo "GeoDirectory Ajax Duplicate Alert not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-buddypress-integration")) {
            echo "GeoDirectory BuddyPress Integration not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-claim-manager")) {
            echo "GeoDirectory Claim Manager not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-custom-post-types")) {
            echo "GeoDirectory Custom Post Types not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-events")) {
            echo "GeoDirectory Events not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("gd-booster")) {
            echo "GD Booster not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-location-manager")) {
            echo "GeoDirectory Location Manager not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-marker-cluster")) {
            echo "GeoDirectory Marker Cluster not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-payment-manager")) {
            echo "GeoDirectory Payment Manager not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-re-captcha")) {
            echo "GeoDirectory Re-Captcha not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-review-rating-manager")) {
            echo "GeoDirectory Review Rating Manager not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("geodirectory-social-importer")) {
            echo "GeoDirectory Social Importer not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("stripe-payment-geodirectory-add-on")) {
            echo "Stripe Payment GeoDirectory Add-on not installed";
            $stop_script = true;
        }

        if (!$this->isElementExists("buddypress")) {
            echo "BuddyPress not installed";
            $stop_script = true;
        }

        if($stop_script) {
            return;
        }

        // make sure all plugins not active. We will activate it programatically.
        if (!strpos($this->byId("geodirectory")->attribute('class'), 'inactive')) {
            echo "Event manager is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-advance-search-filters")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Advance Search Filters is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-affiliatewp-integration")->attribute('class'), 'inactive')) {
            echo "GeoDirectory AffiliateWP Integration is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-ajax-duplicate-alert")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Ajax Duplicate Alert is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-buddypress-integration")->attribute('class'), 'inactive')) {
            echo "GeoDirectory BuddyPress Integration is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-claim-manager")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Claim Manager is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-custom-post-types")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Custom Post Types is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-events")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Events is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("gd-booster")->attribute('class'), 'inactive')) {
            echo "GD Booster is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-location-manager")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Location Manager is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-marker-cluster")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Marker Cluster is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-payment-manager")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Payment Manager is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-re-captcha")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Re-Captcha is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-review-rating-manager")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Review Rating Manager is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("geodirectory-social-importer")->attribute('class'), 'inactive')) {
            echo "GeoDirectory Social Importer is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("stripe-payment-geodirectory-add-on")->attribute('class'), 'inactive')) {
            echo "Stripe Payment GeoDirectory Add-on is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if (!strpos($this->byId("buddypress")->attribute('class'), 'inactive')) {
            echo "BuddyPress is active. Please deactivate it. It will be activated programatically.";
            $stop_script = true;
        }

        if($stop_script) {
            return;
        }


    }

}
?>