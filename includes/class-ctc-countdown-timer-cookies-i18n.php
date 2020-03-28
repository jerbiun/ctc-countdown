<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/includes
 * @author     Jerbik <jerbiun@gmail.com>
 */
class Ctc_Countdown_Timer_Cookies_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ctc-countdown-timer-cookies',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
