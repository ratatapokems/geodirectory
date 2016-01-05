<?php
class AddReview extends GD_Test
{
    public function setUp()
    {
        parent::setUp();

        //skip test if already completed.
        if ($this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            $this->markTestSkipped('Skipping '.pathinfo(__FILE__, PATHINFO_FILENAME).' since its already completed......');
            return;
        }
    }

    public function testAddReview()
    {
        $this->logInfo('Adding a review......');
        $this->maybeUserLogin(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/attractions/test-listing/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byLinkText('Reviews')->click();
        $this->byId('geodir_overallrating')->value('4');
        $this->byId('comment')->value('Cool xyz');
        $this->byId('submit')->click();
        $this->waitForPageLoadAndCheckForErrors();
    }

    public function tearDown()
    {
        if (!$this->skipTest($this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME)), $this->getCompletedFileNumber())) {
            //write current file number to completed.txt
            $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
            $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
            fwrite($completed, $CurrentFileNumber);
        }
    }
}
?>