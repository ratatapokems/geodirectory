# GeoDirectory Unit Tests

## Installation ##
1. Install PHPUnit
    1. Note: According to [WP-CLI Wiki](https://github.com/wp-cli/wp-cli/wiki/Plugin-Unit-Tests) PHPUnit 5.x not supported. To install 4.8 follow these steps
        1. wget https://phar.phpunit.de/phpunit-old.phar
        2. chmod +x phpunit-old.phar
        3. mv phpunit-old.phar /usr/local/bin/phpunit
2. Install [WP-CLI](http://wp-cli.org/#install)
3. cd to this plugin directory. Ex: cd /Users/username/Sites/whoop/wp-content/plugins/geodirectory
4. Make a directory for wordpress testing under your web root. 
    1. I call the directory "wp_tests". 
    2. So my test site installation path looks like this.  /Users/giri/Sites/wp_tests
5. Enter the command in this format:  
    1. bash bin/install-wp-tests.sh [db-name] [db-user] [db-pass] [db-host] [wp-version] [installation-path]  
    2. Ex: bash bin/install-wp-tests.sh wordpress_test root 'root' localhost latest /Users/giri/Sites/wp_tests  
    3. Note: Database will be automatically created by script. So don't create one manually. 
    4. For installation-path use the path from step 4. 
    5. This will put all testing files under wp_tests
6. Open bash_profile with your favorite editor. 
    1. nano ~/.bash_profile 
    2. Add this line at the end of the file
        1. export WP_TESTS_DIR="/Users/username/Sites/wp_tests/wordpress-tests-lib" 
        2. Note: wordpress-tests-lib should be added to the path you got from step 4
7. Finally cd to geodirectory folder again and then run this command.
    1. phpunit 
    2. If everything setup correctly, you will see unit test results in terminal
