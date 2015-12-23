<?php
class AddReview extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testAddReview()
    {
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Reviews')->click();
        //Todo: find a way to rate the stars
        $this->byId('comment')->value('Cool xyz');
        $this->byId('submit')->click();
        $this->waitForPageLoadAndCheckForErrors();
    }
}
?>