=== Plugin Name ===
Contributors: elbuntu
Tags: Buddypress, Profile, Social Network, Social
Requires at least: 2.8
Tested up to: 3.4
Stable tag: 1.6

This plugin is designed to help you monetize your social network by hiding the premium profile fields from non-paying members. 

== Description ==

Profiles Manager is designed to help you monetize your social network by hiding the premium profile fields from non-paying members. This plugin
works with any kind of payment system in place but is tested with s2member.

Features:

* Hide BuddyPress Profile Groups to certain members
* Easy to use UI
* Create upgrade account menu item on free members profiles.

== Installation ==

Requirements:

- Buddypress 1.2.7 or higher.
- Wordpress 2.8 or higher

1. Upload profiles-manager-for-buddypress folder to your Wordpress Plugins folder.
2. Go to your buddy-press template and search for edit.php under members/single/profile.
3. Change bp_profile_group_tabs(); with  bp_pm_group_tabs();
4. Activate the Profiles Manager in wp-admin under plugins.
5. Go to BPM menu
6. Your all set!

== Removing the plugin ==

- Deactivate The Plugin 
- Replace bp_pm_group_tabs(); with bp_profile_group_tabs();

== Frequently Asked Questions ==

-- Where is edit.php? --

It is located in your BuddyPress theme under members/single/profile/edit.php


-- Other Information --

If you are having difficulties getting this plugin to work please email me with the details 
at ashley.gary.johnson@gmail.com or comment on the plugin page.

== Changelog ==

= 1.6 =

* Fixed: Removed $wpdb->prepare errors from subscriptions page


= 1.5 =

* Last Update for Free Version to remove $wpdb->prepare error.
* Will only work on older versions of buddypress with old theming

= 1.2.1 =

* Minor Bug Fixes

= 1.2 =

* Easier to use UI 
* Changed Shortcode Settings
* Updated frontend code.

= 1.1 =

* Fixed Bugs with DB Queries

= 1.0 =

* Redeveloped using a fork of Elvito BP
* Updated for newer versions of Wordpress/BuddyPress

<?php code(); // goes in backticks ?>