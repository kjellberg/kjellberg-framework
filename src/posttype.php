<?php
if ( ! class_exists( 'Posttype' ) ) {
	class Posttype {
		private $_function_name;
		private $_args = array();

		/**
		 * Register a Post Type
		 *
		 * @param string title
		 * @param string $function_name
		 * @param array $args
		*/
		public static function create( $name, $function_name, $args = array() ) {

			$posttype = new Posttype();
			$posttype->_function_name = $function_name;

			if ( empty( $args ) ) {
				$posttype->_args = array(
					'labels' => array(
						'name' => $name,
						'singular_name' => $name,
					),
					'public' => true,
					'has_archive' => true,
			    );
		    } else {
		    	$posttype->_args = $args;
		    }

			add_action( 'init', array( $posttype, 'register_post_type' ) );

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

		public function register_post_type() {
			register_post_type( $this->_function_name, $this->_args );
		}
	}
}
