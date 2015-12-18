<?php
class SendEnquiry extends GD_Test
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSendEnquiry()
    {
        $this->url(self::GDTEST_BASE_URL.'places/united-states/new-york/new-york/restaurants/buddakan/?comment_sorting=high_rating');
        $this->waitForPageLoadAndCheckForErrors();
        $this->byClassName('b_send_inquiry')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->byName('inq_name')->value('Test User');
        $this->byName('inq_email')->value('test@test.com');
        $this->byId('agt_mail_phone')->value('44444444444');
        $this->byName('Send')->click();
        $this->waitForPageLoadAndCheckForErrors();
        $this->assertTrue( $this->isTextPresent("Enquiry sent successfully"), "Success text not found");
    }
}
?>