<?php
class SortListing extends GD_Test
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

    public function testSortListing()
    {
        $this->logInfo('Testing list sorting......');
        //Make sure sorting options available
        $this->url(self::GDTEST_BASE_URL.'places/');
        $this->waitForPageLoadAndCheckForErrors();
        $this->select($this->byId('sort_by'))->selectOptionByLabel('Review Desc');
        $this->waitForPageLoadAndCheckForErrors();
    }

    public function tearDown()
    {
        //write current file number to completed.txt
        $CurrentFileNumber = $this->getCurrentFileNumber(pathinfo(__FILE__, PATHINFO_FILENAME));
        $completed = fopen("tests/selenium/completed.txt", "w") or die("Unable to open file!");
        fwrite($completed, $CurrentFileNumber);
    }
}
?>