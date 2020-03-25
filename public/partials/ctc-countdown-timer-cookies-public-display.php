<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/public/partials
 */

?>
 
<?php wp_enqueue_style( 'ctc_countdown_style', plugin_dir_url(__DIR__).'css/ctc-countdown-timer-cookies-public'.(SCRIPT_DEBUG?'':'.min').'.css')?>
<?php 
wp_register_script( 'ctc_countdown_script', plugin_dir_url(__DIR__).'js/ctc-countdown-timer-cookies-public'.(SCRIPT_DEBUG?'':'.min').'.js');
wp_localize_script('ctc_countdown_script', 'ctc_options', $ctc_options);
wp_enqueue_script('ctc_countdown_script');
        ?>


        <div id="ctc_countdown">
            <div>
                <span class="days"></span>
                <div class="smalltext"><?php echo esc_html_e('Days',$this->plugin_name) ?></div>
            </div>
            <div>
                <span class="hours"></span>
                <div class="smalltext"><?php echo esc_html_e('Hours',$this->plugin_name) ?></div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext"><?php echo esc_html_e('Minutes',$this->plugin_name) ?></div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext"><?php echo esc_html_e('Secondes',$this->plugin_name) ?></div>
            </div>
        </div>