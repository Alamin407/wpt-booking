<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\CptCallbacks;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomPostTypeManager extends BaseController{

    public $settings;

    public $callbacks;

    public $cpt_callbacks;
    
    public $subpages = array();

    public $custom_post_type = array();

    public function register(){

        if( ! $this->activated( 'cpt_manager' ) ){
            return;
        }

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->cpt_callbacks = new CptCallbacks();

        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addSubpages( $this->subpages )->register();

        $this->storeCustomPostTypes();

        if( ! empty( $this->custom_post_type ) ){
            add_action( 'init', [ $this, 'activate' ] );
        }

        add_action( 'add_meta_boxes', [ $this, 'add_car_status_meta_box' ] );
        add_action('save_post', [$this, 'save_car_status']);
        add_filter('manage_car_posts_columns', [$this, 'add_car_status_column']);
        add_action('manage_car_posts_custom_column', [ $this, 'display_car_status_value', 10, 2 ]);
    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'car_bookings',
                'page_title'  => 'CPT Manager',
                'menu_title'  => 'CPT Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'cpt_manager',
                'callback'    => [$this->callbacks, 'adminCpt'],
            ],
        ];
    }

    public function setSettings(){

        $args = array();

        $args[] = array(
            'option_group' => 'booking_cpt_settings',
            'option_name'  => 'car_bookings_cpt',
            'callback'     => [ $this->cpt_callbacks, 'cptSenetize' ]
        );

        $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = array(
            array(
                'id'        => 'booking_cpt_index',
                'title'     => 'Custom Post Type Manager',
                'callback'  => [ $this->cpt_callbacks, 'cptSectionsManager' ],
                'page'      => 'cpt_manager',
            ),
        );

        $this->settings->setSections($args);
    }

    public function setFields(){

        $args = array(
            array(
				'id' => 'post_type',
				'title' => 'Custom Post Type ID',
				'callback' => [ $this->cpt_callbacks, 'textField' ],
				'page' => 'cpt_manager',
				'section' => 'booking_cpt_index',
				'args' => array(
					'option_name' => 'car_bookings_cpt',
					'label_for' => 'post_type',
					'placeholder' => 'eg. product'
				)
			),
			array(
				'id' => 'singular_name',
				'title' => 'Singular Name',
				'callback' => [ $this->cpt_callbacks, 'textField' ],
				'page' => 'cpt_manager',
				'section' => 'booking_cpt_index',
				'args' => array(
					'option_name' => 'car_bookings_cpt',
					'label_for' => 'singular_name',
					'placeholder' => 'eg. Product'
				)
			),
			array(
				'id' => 'plural_name',
				'title' => 'Plural Name',
				'callback' => [ $this->cpt_callbacks, 'textField' ],
				'page' => 'cpt_manager',
				'section' => 'booking_cpt_index',
				'args' => array(
					'option_name' => 'car_bookings_cpt',
					'label_for' => 'plural_name',
					'placeholder' => 'eg. Products'
				)
			),
			array(
				'id' => 'public',
				'title' => 'Public',
				'callback' => [ $this->cpt_callbacks, 'checkboxField' ],
				'page' => 'cpt_manager',
				'section' => 'booking_cpt_index',
				'args' => array(
					'option_name' => 'car_bookings_cpt',
					'label_for' => 'public',
					'class' => 'ui-toggle'
				)
			),
			array(
				'id' => 'has_archive',
				'title' => 'Archive',
				'callback' => [ $this->cpt_callbacks, 'checkboxField' ],
				'page' => 'cpt_manager',
				'section' => 'booking_cpt_index',
				'args' => array(
					'option_name' => 'car_bookings_cpt',
					'label_for' => 'has_archive',
					'class' => 'ui-toggle'
				)
			)
        );

        $this->settings->setFields($args);
    }

    public function storeCustomPostTypes(){
        $options = get_option( 'car_bookings_cpt' );

        $this->custom_post_type[] = array(
                'post_type'          => $options[ 'post_type' ], //car_booking_cars
                'name'               => $options[ 'plural_name' ], //Cars
                'singular_name'      => $options[ 'singular_name' ], //Car
                'add_new'            => 'Add New ', //Add New Car
                'add_new_item'       => 'Add New ' . $options[ 'singular_name' ], //Add New Car
                'edit_item'          => 'Edit '. $options[ 'singular_name' ], //Edit Car
                'new_item'           => 'New ' . $options[ 'singular_name' ], //New Car
                'all_items'          => 'All ' . $options[ 'plural_name' ], //All Cars
                'view_item'          => 'View ' . $options[ 'singular_name' ], //View Car
                'search_items'       => 'Search ' . $options[ 'singular_name' ], //Search Cars
                'not_found'          => 'No ' . $options[ 'singular_name' ] . ' Found', //No cars found
                'not_found_in_trash' => 'No ' . $options[ 'singular_name' ] . ' Found in trush', //No cars found in Trash
                'menu_name'          => $options[ 'plural_name' ], //Cars
                'public'             => $options[ 'public' ],
                'has_archive'        => $options[ 'has_archive' ],
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => $options[ 'plural_name' ], //cars
                'capability_type'    => 'post', //post
                'hierarchical'       => false,
                'menu_position'      => 9, //9
                'menu_icon'          => 'dashicons-car', //dashicons-car
                'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields', 'post-formats', 'page-attributes'),
                'taxonomies'         => array('category', 'post_tag'),

        );
    }

    public function activate(){

        foreach( $this->custom_post_type as $post_type ){
            register_post_type($post_type[ 'post_type' ],
                array(
                    'labels'    => array(
                        'name'               => $post_type[ 'name' ],
                        'singular_name'      => $post_type[ 'singular_name' ],
                        'add_new'            => $post_type[ 'add_new' ],
                        'add_new_item'       => $post_type[ 'add_new_item' ],
                        'edit_item'          => $post_type[ 'edit_item' ],
                        'new_item'           => $post_type[ 'new_item' ],
                        'all_items'          => $post_type[ 'all_items' ],
                        'view_item'          => $post_type[ 'view_item' ],
                        'search_items'       => $post_type[ 'search_items' ],
                        'not_found'          => $post_type[ 'not_found' ],
                        'not_found_in_trash' => $post_type[ 'not_found_in_trash' ],
                        'menu_name'          => $post_type[ 'menu_name' ],
                    ),
                    'public'                => $post_type[ 'public' ],
                    'has_archive'           => $post_type[ 'has_archive' ],
                    'publicly_queryable'    => $post_type[ 'publicly_queryable' ],
                    'show_ui'               => $post_type[ 'show_ui' ],
                    'show_in_menu'          => $post_type[ 'show_in_menu' ],
                    'query_var'             => $post_type[ 'query_var' ],
                    'rewrite'               => array('slug' => $post_type[ 'rewrite' ]),
                    'capability_type'       => $post_type[ 'capability_type' ],
                    'hierarchical'          => $post_type[ 'hierarchical' ],
                    'menu_position'         => $post_type[ 'menu_position' ],
                    'menu_icon'             => $post_type[ 'menu_icon' ],
                    'supports'              => $post_type[ 'supports' ],
                    'taxonomies'            => $post_type[ 'taxonomies' ],
                )
            );
        }
    }

    public function add_car_status_meta_box($post_type) {

        $options = get_option( 'car_bookings_cpt' );

        $post_types = array( $options[ 'post_type' ] );

        if( is_array( $post_types ) ){
            add_meta_box(
                'car_status_meta_box',
                $options[ 'singular_name' ]  . ' Status',
                [ $this, 'render_car_status_meta_box' ],
                $post_type,
                'side',
                'default'
            );
        }

    }

    public function render_car_status_meta_box($post) {
        $options = get_option( 'car_bookings_cpt' );
        $car_status = get_post_meta($post->ID, '_' . $options[ 'singular_name' ] . '_status', true);
        ?>
        <label for="car_status">Status:</label>
        <select name="car_status" id="car_status">
            <option value="available" <?php selected($car_status, 'available'); ?>>Available</option>
            <option value="booked" <?php selected($car_status, 'booked'); ?>>Booked</option>
        </select>
        <?php
    }

    public function save_car_status($post_id) {
        if (isset($_POST['car_status'])) {
            update_post_meta($post_id, '_car_status', sanitize_text_field($_POST['car_status']));
        }
    }

    // Add status column to admin list table
    public function add_car_status_column($columns) {
        $columns['car_status'] = 'Status';
        return $columns;
    }

    // Display status value in the admin list table
    public function display_car_status_value($column, $post_id) {
        if ($column == 'car_status') {
            $car_status = get_post_meta($post_id, '_car_status', true);
            echo ucfirst($car_status);
        }
    }
}