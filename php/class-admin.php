<?php
/**
 * WP Admin resources.
 *
 * @package   Block_Lab
 * @copyright Copyright(c) 2018, Block Lab
 * @license   http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */

namespace Block_Lab;

/**
 * Class Admin
 */
class Admin extends Component_Abstract {
	/**
	 * Display Pro version messaging
	 *
	 * @var bool
	 */
	public $show_pro;

	/**
	 * Plugin settings.
	 *
	 * @var Settings
	 */
	public $settings;

	/**
	 * Plugin license.
	 *
	 * @var License
	 */
	public $license;

	/**
	 * Initialise the Admin component.
	 */
	public function init() {
		$this->show_pro = apply_filters( 'block_lab_show_pro', false );
		if ( $this->show_pro ) {
			$this->settings = new Settings();
			$this->license  = new License();
			block_lab()->register_component( $this->settings );
			block_lab()->register_component( $this->license );
		}
	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		if ( $this->show_pro ) {
			add_action( 'admin_menu', array( $this, 'add_submenu_pages' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
	}

	/**
	 * Enqueue scripts and styles used globally in the WP Admin.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_style(
			'block-lab',
			$this->plugin->get_url( 'css/admin.css' ),
			array(),
			$this->plugin->get_version()
		);
	}

	/**
	 * Add submenu pages to the Block Lab menu.
	 */
	public function add_submenu_pages() {
		if ( ! block_lab()->is_pro() ) {
			add_submenu_page(
				'edit.php?post_type=block_lab',
				__( 'Block Lab Pro', 'block-lab' ),
				__( 'Go Pro', 'block-lab' ),
				'manage_options',
				'block-lab-pro',
				array( $this, 'render_page_pro' )
			);
		} else {
			add_submenu_page(
				'edit.php?post_type=block_lab',
				__( 'Import', 'block-lab' ),
				__( 'Import', 'block-lab' ),
				'manage_options',
				'block-lab-import',
				array( $this, 'render_page_import' )
			);
		}
	}

	/**
	 * Render the Pro upgrade page.
	 */
	public function render_page_pro() {
		?>
		<div class="wrap block-lab-pro">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<?php
	}

	/**
	 * Render the Import page.
	 */
	public function render_page_import() {
		?>
		<div class="wrap block-lab-import">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<?php
	}
}
