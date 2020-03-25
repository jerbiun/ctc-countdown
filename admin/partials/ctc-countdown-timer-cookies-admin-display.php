<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/admin/partials
 */
?>

 <?php    wp_nonce_field( 'ctc_countdown_nonce', 'ctc_countdown_nonce' ) ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php echo esc_html_e('Days',$this->plugin_name) ?></th>
                <td>
                    <input class="regular-text" type="text" 
                           name="ctc_days" id="ctc_days" value="<?php echo isset($ctc_options['_ctc_days'])?$ctc_options['_ctc_days']:'' ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html_e('Hours',$this->plugin_name) ?></th>
                <td>
                    <input class="regular-text" type="text" 
                           name="ctc_hours" id="ctc_hours" value="<?php echo isset($ctc_options['_ctc_hours'])?$ctc_options['_ctc_hours']:'' ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html_e('Minutes',$this->plugin_name) ?></th>
                <td><input class="regular-text" type="text" 
                           name="ctc_minutes" id="ctc_minutes" value="<?php echo isset($ctc_options['_ctc_minutes'])?$ctc_options['_ctc_minutes']:'' ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html_e('Secondes',$this->plugin_name) ?></th>
                <td><input class="regular-text" type="text" 
                           name="ctc_secondes" id="ctc_secondes" value="<?php echo isset($ctc_options['_ctc_secondes'])?$ctc_options['_ctc_secondes']:'' ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">Redirection</th>
                <td>
                 <?php
                 $args = array(
                'selected'              =>    isset($ctc_options['_ctc_redirect'])?$ctc_options['_ctc_redirect']:'' ,
                'name'                  => 'ctc_redirect',
                'id'                    => 'ctc_redirect',  
                'show_option_none'      => 'Select...',  
                'option_none_value'     => 'Select...',  
           ); 
            wp_dropdown_pages($args);
                 ?>
                </td>
            </tr>
        </tbody>
    </table>
    <button type='button' class="button ctc_reset_data" ><?php echo esc_html_e('Reset all user data',$this->plugin_name) ?></button>