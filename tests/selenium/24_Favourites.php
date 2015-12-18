<?php
class Favourites extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testFavourites()
    {
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $elements = $this->elements($this->using('css selector')->value('.geodir-addtofav-icon'));
        if ($elements) {
            $elements[0]->click();
        }
        $this->waitForPageLoadAndCheckForErrors();
        $this->url(self::GDTEST_BASE_URL.'author/admin/?geodir_dashbord=true&stype=gd_place&list=favourite');
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Favorite Places"), "Not in Favourites page");
    }
}
?>