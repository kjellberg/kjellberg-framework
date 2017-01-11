<?php
if ( ! class_exists( 'Notice' ) ) {
	class Notice {

		private $_message;
		private $_class;
		private $_escape_html;

		/**
		 * Constructor for admin notice.
		 *
		 * @param string $message (required)
		 * @param string $class
		 * @param boolean $dissmissible
		 * @param boolean $escape_attr
		*/
		public function __construct( $message, $class, $dismissible, $escape_attr ) {
			$this->_message = $message;
			$this->_class = $class;
			$this->_escape_html = $escape_attr;

			if ( true === $dismissible ) {
				$this->_class = $this->_class . ' is-dismissible';
			}
		}

		/**
		 * Prints a green Admin Notice
		 *
		 * @param string $message (required)
		 * @param boolean $dissmissible
		 * @param boolean $escape_attr
		*/
		public static function success( $message, $dismissible = true, $escape_attr = true ) {
			$notice = new Notice( $message, 'success', $dismissible, $escape_attr );
			add_action( 'admin_notices', array( $notice, 'hook' ) );
		}

		/**
		 * Prints a red Error Notice
		 *
		 * @param string $message (required)
		 * @param boolean $dissmissible
		 * @param boolean $escape_attr
		*/
		public static function error( $message, $dismissible = true, $escape_attr = true ) {
			$notice = new Notice( $message, 'error', $dismissible, $escape_attr );
			add_action( 'admin_notices', array( $notice, 'hook' ) );
		}

		/**
		 * Prints a blue Admin Notice
		 *
		 * @param string $message (required)
		 * @param boolean $dissmissible
		 * @param boolean $escape_attr
		*/
		public static function information( $message, $dismissible = true, $escape_attr = true ) {
			$notice = new Notice( $message, 'info', $dismissible, $escape_attr );
			add_action( 'admin_notices', array( $notice, 'hook' ) );
		}

		/**
		 * Prints an yellow Admin Notice
		 *
		 * @param string $message (required)
		 * @param boolean $dissmissible
		 * @param boolean $escape_attr
		*/
		public static function warning( $message, $dismissible = true, $escape_attr = true ) {
			$notice = new Notice( $message, 'warning', $dismissible, $escape_attr );
			add_action( 'admin_notices', array( $notice, 'hook' ) );
		}

		/**
		 * Creates the notice on admin_notices hook
		*/
		public function hook() {

			$class = $this->_class;
			$message = $this->_message;

			if ( true === $this->_escape_html ) {
				$class = esc_attr( $class );
				$message = esc_attr( $message );
			}
		?>
		<div class="notice notice-<?php echo $class; ?>">
			<p><?php echo $message; ?></p>
		</div>
		<?php
		}
	}
}
