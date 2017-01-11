# Kjellberg Framework for WordPress

### General
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
### Post Types
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
