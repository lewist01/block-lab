<?php
/**
 * User control.
 *
 * @package   Block_Lab
 * @copyright Copyright(c) 2018, Block Lab
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */

namespace Block_Lab\Blocks\Controls;

/**
 * Class User
 */
class User extends Control_Abstract {

	/**
	 * Control name.
	 *
	 * @var string
	 */
	public $name = 'user';

	/**
	 * User constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->label = __( 'User', 'block-lab' );
	}

	/**
	 * Register settings.
	 *
	 * @return void
	 */
	public function register_settings() {
		$this->settings[] = new Control_Setting(
			array(
				'name'     => 'placeholder',
				'label'    => __( 'Placeholder Text', 'block-lab' ),
				'type'     => 'text',
				'default'  => __( 'Enter a username', 'block-lab' ),
				'sanitize' => 'sanitize_text_field',
			)
		);
		$this->settings[] = new Control_Setting(
			array(
				'name'     => 'name_to_display',
				'label'    => __( 'Display name as', 'block-lab' ),
				'type'     => 'user_select',
				'default'  => '',
				'sanitize' => 'sanitize_text_field',
			)
		);
	}
}