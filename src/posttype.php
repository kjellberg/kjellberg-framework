<?php
if ( ! class_exists( 'Posttype' ) ) {
	class Posttype {
		private $_function_name;
		private $_args = array();
		private $_column_labels = array();
		private $_column_callbacks = array();
		private $_column_deleted = array();

		/**
		 * Register a Post Type
		 *
		 * @param string $name
		 * @param string $function_name
		 * @param array $args
		*/
		public static function create( $name, $function_name, $args = array() ) {

			$posttype = new Posttype();
			$posttype->_function_name = $function_name;

			if ( empty( $args ) ) {
				// Default arguments if $args is empty.
				$posttype->_args = array(
					'labels' => array(
						'name' => $name,
						'singular_name' => $name,
					),
					'public' => true,
					'has_archive' => true,
			    );
		    } else {
		    	// Set user specified arguments.
		    	$posttype->_args = $args;
		    }

		    // Register the custom post type.
			add_action( 'init', array( $posttype, 'register_post_type' ) );

			// Filter for registering labels (thead) for custom post type columns.
			add_filter( 'manage_' . $function_name . '_posts_columns' , array( $posttype, 'register_admin_columns_thead' ) );

			// Adds a hook for registering admin columns data in table.
			add_action( 'manage_' . $function_name . '_posts_custom_column', array( $posttype, 'register_admin_columns' ) );

			// Returns a reference to the post type so we can edit it after creation.
			return $posttype;
		}

		/**
		 * Register arguments for your post type
		 *
		 * @param string $key
		 * @param string $value
		*/
		public function set( $key, $value ) {
			$this->_args[ $key ] = $value;
		}

		/**
		 * Add admin column
		 * Register a custom admin column for the Custom Post types admin table.
		 *
		 * @param string $label (required)
		 * @param callback $callback_function (required)
		*/
		public function add_admin_column( $label, $callback_function ) {
			// Creates thead label for column.
			$this->_column_labels[ sanitize_title( $label ) ] = $label;

			// Save our callback function in a array for later use.
			$this->_column_callbacks[ sanitize_title( $label ) ] = $callback_function;
		}

		/**
		 * Remove admin column
		 * Remove a column from post types admin table.
		 *
		 * @param string $key (required)
		*/
		public function remove_admin_column( $key ) {
			// Store deleted $key in an array for later when running filter.
			$this->_column_deleted[ $key ] = 1;
		}

		/**
		 * Register admin columns label
		 * Merge new columns into 'manage_{$posttype}_posts_columns'-filter.
		 *
		 * @param array $columns Default columns.
		*/
		public function register_admin_columns_thead( $columns ) {

			// Loop trough all $columns and unset those who matches with the $this->_column_deleted array.
			foreach ( $columns as $key => $value ) {
				if ( isset( $this->_column_deleted[ $key ] ) ) {
					unset( $columns[ $key ] );
				}
			}

			if ( isset( $columns['date'] ) ) {
				// Unset date column if set so that we can add it to the end of array.
				$date_label = $columns['date'];
				unset( $columns['date'] );
			}

			// Merge new columns into the default columns.
			$columns = array_merge( $columns, $this->_column_labels );

			if ( isset( $date_label ) ) {
				// Add date column again in the end of array.
				$columns['date'] = $date_label;
			}

			return $columns;
		}

		/**
		 * Register admin columns
		 * Add hooks for registering admin columns data in table.
		 * Runs at 'manage_{$posttype}_posts_custom_column'-hook.
		 *
		 * @param array $columns Default columns.
		*/
		public function register_admin_columns( $column ) {
			if ( isset( $this->_column_callbacks[ $column ] ) ) {

				// Get the global $post variable for current row.
				global $post;

				// Get our callback function name from saved array.
				$callback_function = $this->_column_callbacks[ $column ];

				// Call function and echo the response.
				echo call_user_func( $callback_function, $post );
			}
		}

		/**
		 * Register our post type.
		 * Runs at 'init'-hook.
		*/
		public function register_post_type() {
			register_post_type( $this->_function_name, $this->_args );
		}
	}
}
