# Kjellberg Framework for WordPress

## General
#### Require a plugin
```php
/** 
 * Tells the user to download another plugin from WordPress plugin repository.
 * @param $name
 * @param $slug
*/

// Require "Advanced Custom Fields"
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

// Creates a post type "Coupon" for coupons
Posttype::create( 'Coupons', 'coupons' );
```
#### Set arguments for your post type
```php
/**
 * Register arguments for your post type
 * @param $key
 * @param $value
*/

// Creates a post type "Coupon" for coupons
$coupons = Posttype::create( 'Coupons', 'coupons' );

// Set 'menu_position' to 5.
$coupons->set( 'menu_position', 5 );

// Register taxonomies
$coupons->set( 'taxonomies', array( 'category', 'post_tag' ) );
```
