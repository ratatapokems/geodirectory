<?php
class Test_Listings extends WP_UnitTestCase {

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

    public function test_insert_listing() {
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
        $this->assertTrue(is_int($post_id));
    }

    public function test_insert_taxonomy() {
        $this->test_insert_listing();
        register_taxonomy(
            'gd_placecategory',
            'gd_place',
            array(
                'label' => __( 'Category' ),
                'rewrite' => array( 'slug' => 'gd_category' ),
                'hierarchical' => true,
            )
        );
        // Let's create a category
        $this->cat = $this->factory->term->create(array(
            'taxonomy' => 'gd_placecategory'
        ));
        var_dump($this->cat);
        $this->assertTrue(is_int($this->cat));
    }

}
