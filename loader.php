<?php

    /*
     Plugin Name: Profiles Manager 
     Plugin URI: http://elbuntu.com
     Description: Profiles Manager  is designed to help you monetize your social network by hiding the premium profile fields from non-paying members.
     Author: Ashley Johnson
     Author URI: http://www.elbuntu.com
     License: GNU GENERAL PUBLIC LICENSE 3.0 http://www.gnu.org/licenses/gpl.txt
     Version: 1.6
     Text-Domain: profiles-manager
     Site Wide Only: true
    */

    /********************************
     * Activate the plugin for use! *
     *******************************/

    function bpm_activate() {

        //Activate the plugin and install the tables

        global $wpdb;

        $wpdb->query("CREATE TABLE bpm_settings (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            option_name varchar(255),
            option_value varchar(255));");

        $wpdb->query("CREATE TABLE bpm_profile (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            wp_level varchar(255),
            wp_group varchar(255),
            m_hidden varchar(255),
            p_hidden varchar(255));");

        $wpdb->query("CREATE TABLE bpm_commerce (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            price text,
            term varchar(255),
            currency varchar(255),
            membership varchar(255));");

        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "button_en", ""));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "button_text", "sometext"));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "button_link", "http://your.com/page"));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "version", "1.0"));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "paypal", "sample@yourdomain.com"));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "serial", ""));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "message", ""));
        $wpdb->query(sprintf("INSERT INTO bpm_settings (option_name, option_value) VALUES ('%s', '%s')", "currency", "EUR"));
        
    }

    register_activation_hook( __FILE__, 'bpm_activate' );

    function bpm_deactivate() {

        //Remove tables
        global $wpdb;

        $wpdb->query("DROP TABLE bpm_settings");
        $wpdb->query("DROP TABLE bpm_profile");
        $wpdb->query("DROP TABLE bpm_commerce");
    }

    register_deactivation_hook( __FILE__, 'bpm_deactivate');

    //Build the backend menu

    function bpm_menu() {

        global $bp;

        if(!is_super_admin()):
            return false;
        endif;

        require ( dirname( __FILE__ ) . '/admin/admin.php' );

        add_menu_page('Profiles Manager', 'BPM', 'manage_options', 'bpm-menu', 'init');
        add_submenu_page( 'bpm-menu', 'Field Management', 'Profile Manager', 'manage_options', 'bpm-profile', 'init_profiles');
        add_submenu_page( 'bpm-menu', 'Subscriptions', 'Subscriptions', 'manage_options', 'bpm-commerce', 'init_subscription');

    }

    add_action( 'admin_menu', 'bpm_menu' );

    //INCLUDE FRONT END 
    require( dirname( __FILE__ ) . '/frontEngine.php' );

?>