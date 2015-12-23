<?php
class MarkerCluster extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMarkerCluster()
    {
        //make sure marker cluster plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("geodirectory-marker-cluster")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "marker cluster plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }

        //make sure marker cluster enabled in home map
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=design_settings&active_tab=geodir_marker_cluster_settings');
        $this->byName('save')->click();
        $this->waitForPageLoadAndCheckForErrors();

        $this->maybeAdminLogin(self::GDTEST_BASE_URL);
        //todo: Find a way to check cluster count exists on page
    }
}
?>