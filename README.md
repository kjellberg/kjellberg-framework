# Kjellberg Framework for WordPress

## Table of contents
1. [Installation & Usage](#installation--usage)
2. [Features and methods](#features-and-methods)
	1. [General](#general)
		1. [Require a Plugin](#require-a-plugin)
		2. [Create Admin Notices](#create-admin-notices)
	2. [Post Types](#post-types)
		1. [Create a Post Type](#create-a-post-type)
		2. [Set Post Type Arguments](#set-arguments-for-your-post-type)
		3. [Set Post Type Labels](#set-labels-for-your-post-type)
		4. [Add admin columns](#add-an-admin-column-for-your-post-type)

## Installation & Usage
The framework calls the hook ```kframework_loaded``` when it's successfully loaded. So to make sure that Kjellberg Framework is installed and loaded before your code, you should **ALWAYS** wait for the ```kframework_loaded```-hook before calling any Kjellberg Framework classes.

**Example:**
```php
// Wait for framework too load.
add_action( 'kframework_loaded', 'init_kjellberg_coupons' );

function init_kjellberg_coupons() {
	// Create a post type for "Coupons".
	Posttype::create( 'Coupons', 'coupons' );
}
```


## Features and methods
### General

#### Require a plugin
```php
/** 
 * Tells the user to download another plugin from WordPress plugin repository.
 * @param $name (required)
 * @param $slug (required)
*/

// Require "Advanced Custom Fields".
Requires::plugin( 'Advanced Custom Fields', 'advanced-custom-fields' );
```

![require-plugins](https://cloud.githubusercontent.com/assets/2277443/21863989/ea0b9178-d83f-11e6-9274-52a387b44cc6.png)

#### Create admin notices
```php
/**
 * Prints an admin notice
 *
 * @param string $message (required)
 * @param boolean $dissmissible (optional), default: true
 * @param boolean $escape_attr (optional), default: true
*/

Notice::success( 'This is a success message' );
Notice::information( 'This is an information message' );
Notice::warning( 'This is a update message' );
Notice::error( 'This is a error message' );

Notice::information( 'This is a non dismissible information message', false );
Notice::information( 'This is a <strong>HTML-formatted</strong> message', true, false );
```

![notice-boxes](https://cloud.githubusercontent.com/assets/2277443/21863937/b5f3e7aa-d83f-11e6-8bc6-6c88462118aa.png)


## Post Types
#### Create a post type
```php
/** 
 * Register a Post Type
 * @param $title (required)
 * @param $function_name (required)
 * @param $args (optional)
*/

// Create a post type for "Coupons".
Posttype::create( 'Coupons', 'coupons' );
```
#### Set arguments for your post type
```php
/**
 * Register arguments for your post type
 * @param $key (required)
 * @param $value (required)
*/

// Create a post type for "Coupons".
$coupons = Posttype::create( 'Coupons', 'coupons' );

// Set 'menu_position' to 5.
$coupons->set( 'menu_position', 5 );

// Register taxonomies.
$coupons->set( 'taxonomies', array( 'category', 'post_tag' ) );

// Use a custom slug for our post type
$coupons->set( 'rewrite', array( 'slug' => 'coupons' ) );
```

#### Set labels for your post type
```php
// Create a post type for "Coupons".
$coupons = Posttype::create( 'Coupons', 'coupons' );

// "Labels" is a post type argument, so we can use ->set() to register labels.
$coupons->set('labels', array(
	'name'                  => _x( 'Coupons', 'Coupon General Name', 'text_domain' ),
	'singular_name'         => _x( 'Coupon', 'Coupon Singular Name', 'text_domain' ),
	'menu_name'             => __( 'Coupons', 'text_domain' ),
	'name_admin_bar'        => __( 'Coupon', 'text_domain' ),
	'archives'              => __( 'Coupon Archives', 'text_domain' ),
	'attributes'            => __( 'Coupon Attributes', 'text_domain' ),
	'parent_item_colon'     => __( 'Parent Coupon:', 'text_domain' ),
	'all_items'             => __( 'All Coupons', 'text_domain' ),
	'add_new_item'          => __( 'Add New Coupon', 'text_domain' ),
	'add_new'               => __( 'Add New', 'text_domain' ),
	'new_item'              => __( 'New Coupon', 'text_domain' ),
	'edit_item'             => __( 'Edit Coupon', 'text_domain' ),
	'update_item'           => __( 'Update Coupon', 'text_domain' ),
	'view_item'             => __( 'View Coupon', 'text_domain' ),
	'view_items'            => __( 'View Coupons', 'text_domain' ),
	'search_items'          => __( 'Search Coupon', 'text_domain' ),
	'not_found'             => __( 'Not found', 'text_domain' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
	'featured_image'        => __( 'Featured Image', 'text_domain' ),
	'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
	'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
	'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
	'insert_into_item'      => __( 'Insert into Coupon', 'text_domain' ),
	'uploaded_to_this_item' => __( 'Uploaded to this Coupon', 'text_domain' ),
	'items_list'            => __( 'Coupons list', 'text_domain' ),
	'items_list_navigation' => __( 'Coupons list navigation', 'text_domain' ),
	'filter_items_list'     => __( 'Filter Coupons list', 'text_domain' ),
));
```

#### Add an admin column for your post type.
```php
// Create a post type for "Coupons".
$coupons = Posttype::create( 'Coupons', 'coupons' );

/**
 * Add admin column
 * Register a custom admin column for the Custom Post types dashboard page.
 *
 * @param string $label (required)
 * @param callback $callback_function (required)
*/

$coupons->add_admin_column( 'Post ID', 'coupons_column_shortcode' );

// Admin column callback.
function coupons_column_shortcode( $post ) {
	$post_id = $post->ID; // $post references to the current row.
	return "ID: {$post_id}";
}
```

![add_admin_column](https://cloud.githubusercontent.com/assets/2277443/21963534/ef5693e4-db3c-11e6-93ba-c80ccff6abee.png)
