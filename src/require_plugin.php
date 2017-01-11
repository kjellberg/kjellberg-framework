<?php
if ( ! class_exists( 'Requires' ) ) {
	class Requires {

		/**
		 * Require install of another plugin.
		 *
		 * @param string $name
		 * @param string $title
		*/
		public static function plugin( $name, $slug ) {
			$required_plugin = new KB_RequirePlugin( $name, $slug );
			add_action( 'tgmpa_register', array( $required_plugin, 'tgmpa_register' ) );
		}
	}
}

if ( ! class_exists( 'KB_RequirePlugin' ) ) {
	class KB_RequirePlugin {
		private $_name = '';
		private $_slug = '';

		public function __construct( $name, $slug ) {
			$this->_name = $name;
			$this->_slug = $slug;
		}

		public function tgmpa_register() {
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

