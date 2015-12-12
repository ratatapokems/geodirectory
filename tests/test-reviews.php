<?php
class Test_Reviews extends WP_UnitTestCase {
    public function setUp() {
        parent::setUp();

        $location_args = array(
            'city' => 'New York',
            'region' => 'New York',
            'country' => 'United States',
            'geo_lat' => '40.7127837',
            'geo_lng' => '-74.00594130000002',
            'is_default' => '1',
            'update_city' => '0'
        );

        geodir_add_new_location($location_args);

        wp_set_current_user(1);

    }

    public function tearDown() {
        parent::tearDown();
    }

    function test_insert_review() {
        $time = current_time('mysql');

        $args = array(
            'listing_type' => 'gd_place',
            'post_title' => 'Test Listing Title',
            'post_desc' => 'Test Desc',
            'post_tags' => 'test1,test2',
            'post_address' => 'New York City Hall',
            'post_zip' => '10007',
            'post_latitude' => '40.7127837',
            'post_longitude' => '-74.00594130000002',
            'post_mapview' => 'ROADMAP',
            'post_mapzoom' => '10',
            'geodir_timing' => '10.00 am to 6 pm every day',
            'geodir_contact' => '1234567890',
            'geodir_email' => 'test@test.com',
            'geodir_website' => 'http://test.com',
            'geodir_twitter' => 'http://twitter.com/test',
            'geodir_facebook' => 'http://facebook.com/test',
            'geodir_special_offers' => 'Test offer'
        );
        $post_id = geodir_save_listing($args, true);

        $data = array(
            'comment_post_ID' => $post_id,
            'comment_author' => 'admin',
            'comment_author_email' => 'admin@admin.com',
            'comment_author_url' => 'http://wpgeodirectory.com',
            'comment_content' => 'content here',
            'comment_type' => '',
            'comment_parent' => 0,
            'user_id' => 1,
            'comment_author_IP' => '127.0.0.1',
            'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
            'comment_date' => $time,
            'comment_approved' => 1,
        );

        $comment_id = wp_insert_comment($data);

        $this->assertTrue(is_int($comment_id));
    }

    function test_insert_comment() {
        $comment_id = $this->factory->comment->create();

        $this->assertTrue(is_int($comment_id));
    }
}