# Kjellberg Framework for WordPress

## General
#### Require a plugin
```php
/** 
 * Tells the user to download another plugin from WordPress plugin repository.
 * @param $name
 * @param $slug
*/

// Require "Advanced Custom Fields".
Requires::plugin( 'Advanced Custom Fields', 'advanced-custom-fields' );
```
## Post Types
#### Create
```php
/** 
 * Register a Post Type
 * @param $title
 * @param $function_name
*/

// Creates a post type for "Coupons".
Posttype::create( 'Coupons', 'coupons' );
```
#### Set arguments for your post type
```php
/**
 * Register arguments for your post type
 * @param $key
 * @param $value
*/

// Creates a post type for "Coupons".
$coupons = Posttype::create( 'Coupons', 'coupons' );

// Set 'menu_position' to 5.
$coupons->set( 'menu_position', 5 );

// Register taxonomies.
$coupons->set( 'taxonomies', array( 'category', 'post_tag' ) );
```

#### Set labels for your post type
```php
/**
 * "Labels" is a post type argument, so we can use ->set() to register labels.
*/

$coupons = Posttype::create( 'Coupons', 'coupons' );
$coupons->set('labels', array(
  'name'                  => __( 'Coupons', 'text_domain' ),
  'singular_name'         => __( 'Coupon', 'text_domain' ),
  'menu_name'             => __( 'Coupons', 'text_domain' ),
  'add_new_item'          => __( 'Add New Coupon', 'text_domain' ),
  ...
  'new_item'              => __( 'New Coupon', 'text_domain' ),
  'edit_item'             => __( 'Edit Coupon', 'text_domain' ),
  'update_item'           => __( 'Update Coupon', 'text_domain' ),
  ...
));
```
