<?php
class GD_Test extends PHPUnit_Extensions_Selenium2TestCase {

    const GDTEST_BASE_URL = 'http://localhost/whoop/';

    public function setUp()
    {
        $this->setSeleniumServerRequestsTimeout(60);
        $this->setBrowser('firefox');
        $this->setBrowserUrl(self::GDTEST_BASE_URL);
    }

    function isTextPresent($search)
    {
        $source = $this->source();
        if ( strpos((string)$source,$search) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }

    function randomEmailID()
    {
        return md5(uniqid(rand(), true)).'@gmail.com';
    }

    function waitForPageLoad()
    {
        // Wait 10 seconds
        $this->timeouts()->implicitWait(10000);
    }

    function checkForErrors()
    {
        $elements = $this->elements($this->using('css selector')->value('.xdebug-error'));
        if ($elements) {
            $total = count($elements);
            echo "\n";
            echo $total.' errors found';
            echo "\n";
            $count = 0;
            foreach ($elements as $i => $element) {
                $count++;
                if ($errors = $element->attribute('innerHTML')) {
                    echo "\n";
                    echo "========================================================================";
                    echo "\n";
                    echo strip_tags($errors);
                    if ($count == $total) {
                        echo "\n";
                        echo "========================================================================";
                        echo "\n";
                    }
                }
            }
        }
    }
}