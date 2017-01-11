<?php
if ( ! class_exists( 'Requires' ) ) {
	class Requires {
		public static function plugin( $name, $slug ) {
			$required_plugin = new RequirePlugin( $name, $slug );
			add_action( 'tgmpa_register', array( $required_plugin, 'hook' ) );
		}
	}
}

if ( ! class_exists( 'RequirePlugin' ) ) {
	class RequirePlugin {
		private $_name = '';
		private $_slug = '';

		public function __construct( $name, $slug ) {
			$this->_name = $name;
			$this->_slug = $slug;
		}

		public function hook() {
			$plugins = array(

				array(
					'name'      => $this->_name,
					'slug'      => $this->_slug,
					'required'  => true,
				),

			);

			$config = array(
				'id'           => 'kframework',
				'default_path' => '',
				'menu'         => 'kframework-required-plugins',
				'parent_slug'  => 'plugins.php',
				'capability'   => 'manage_options',
				'has_notices'  => true,
				'dismissable'  => true,
				'dismiss_msg'  => '',
				'is_automatic' => true,
				'message'      => '',
			);

			tgmpa( $plugins, $config );
		}
	}
}

