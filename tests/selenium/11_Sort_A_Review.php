<?php
class SortReview extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSortReview()
    {
        //make sure advance search filters plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoad();
        $this->checkForErrors();
        $is_active = $this->byId("geodirectory-review-rating-manager")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Review Rating Manager plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
        //Make sure Enable comment list sorting checked.
        $this->url(self::GDTEST_BASE_URL.'wp-admin/admin.php?page=geodirectory&tab=multirating_fields&subtab=geodir_multirating_options');
        $this->waitForPageLoad();
        $is_checked = $this->byId('geodir_reviewrating_enable_sorting')->attribute('checked');
        if (!$is_checked) {
            $this->byId('geodir_reviewrating_enable_sorting')->click();
            $this->byName('save')->click();
            $this->waitForPageLoad();
        }
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/?comment_sorting=high_rating');
        $this->waitForPageLoad();
    }
}
?>