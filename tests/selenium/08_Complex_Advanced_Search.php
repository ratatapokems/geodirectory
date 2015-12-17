<?php
class ComplexAdvancedSearch extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testComplexAdvancedSearch()
    {
        //make sure advance search filters plugin active
        $this->maybeAdminLogin(self::GDTEST_BASE_URL.'wp-admin/plugins.php');
        $this->waitForPageLoad();
        $this->checkForErrors();
        $is_active = $this->byId("geodirectory-advance-search-filters")->attribute('class');
        $this->assertFalse( strpos($is_active, 'inactive'), "Advance Search Filters plugin not active");
        if (strpos($is_active, 'inactive')) {
            return;
        }
        $this->url(self::GDTEST_BASE_URL);
        $this->waitForPageLoad();
        $this->byClassName('search_text')->value('Test');
        $this->byClassName('showFilters')->click();
        $this->byName('sgd_placecategory[]')->value("2");
        $this->byClassName('geodir_submit_search')->click();
        $this->waitForPageLoad();
        $this->assertTrue( $this->isTextPresent("Search Places For"), "Not in search results page");
    }
}
?>