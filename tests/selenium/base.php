<?php
class GD_Test extends PHPUnit_Extensions_Selenium2TestCase {

    const GDTEST_BASE_URL = 'http://localhost/whoop/';

    public function setUp()
    {
        $this->setSeleniumServerRequestsTimeout(60);
        $this->setBrowser('firefox');
        $this->setBrowserUrl(self::GDTEST_BASE_URL);
        $this->prepareSession()->currentWindow()->maximize();
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

    function waitForPageLoadAndCheckForErrors($timeout=10000)
    {
        // Wait 10 seconds
        $this->timeouts()->implicitWait($timeout);
        $this->checkForErrors();
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

    function maybeUserLogin($redirect, $force=false) {
        if ($force) {
            $this->url(self::GDTEST_BASE_URL.'wp-admin/');
            if ($this->isTextPresent("forgetmenot")) {
                $this->byId('user_login')->value('test@test.com');
                $this->byId('user_pass')->value('12345');
                $this->byId('rememberme')->click();
                // Submit the form
                $this->byId('wp-submit')->submit();
                $this->waitForPageLoadAndCheckForErrors();
            }
        }
        $this->url($redirect);
        $this->waitForPageLoadAndCheckForErrors();
        if ($this->isTextPresent("Sign In")) {
            $this->byId('user_login')->value('test@test.com');
            $this->byId('user_pass')->value('12345');
            $this->byId('rememberme')->click();
            // Submit the form
            $this->byId('cus_loginform')->submit();
            $this->waitForPageLoadAndCheckForErrors();
            $this->url($redirect);
        }
    }

    function maybeAdminLogin($redirect) {
        $this->url($redirect);
        $this->waitForPageLoadAndCheckForErrors();
        if ($this->isTextPresent("forgetmenot")) {
            $this->byId('user_login')->value('admin');
            $this->byId('user_pass')->value('admin');
            $this->byId('rememberme')->click();
            // Submit the form
            $this->byId('wp-submit')->submit();
            $this->waitForPageLoadAndCheckForErrors();
            $this->url($redirect);
        }
    }
}