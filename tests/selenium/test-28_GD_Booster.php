<?php
class GDBooster extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGDBooster()
    {
        //make sure GD Booster plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoadAndCheckForErrors();
        $is_active = $this->byId("gd-booster")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "GD Booster plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }


    }
}
?>