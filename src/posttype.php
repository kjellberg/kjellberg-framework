<?php
if ( ! class_exists( 'Posttype' ) ) {
	class Posttype {
		private $_function_name;
		private $_args = array();


		/**
		 * Register a Post Type
		 * @param $title
		 * @param $function_name
		*/
		public static function create( $name, $function_name, $public = true, $has_archive = true ) {

			$posttype = new Posttype();
			$posttype->_function_name = $function_name;
			$posttype->_args = array(
				'labels' => array(
					'name' => $name,
					'singular_name' => $name,
				),
				'public' => $public,
				'has_archive' => $has_archive,
		    );

			add_action( 'init', array( $posttype, 'register_post_type' ) );

			return $posttype;
		}

		/**
		 * Register arguments for your post type
		 * @param $key
		 * @param $value
		*/
		public function set( $key, $value ) {
			$this->_args[ $key ] = $value;
		}

		public function register_post_type() {
			register_post_type( $this->_function_name, $this->_args );
		}
	}
}
