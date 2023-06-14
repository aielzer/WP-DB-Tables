<?php
/*
Plugin Name: Custom Database Tables
Description: Designed for specific client, plants databases.
Author: Ailene Pecayo
Author URI: http://ailenepecayo.com/
*/

function create_the_custom_table() {
    global $wpdb;
  
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $table_name1 = $wpdb->prefix . 'soh_availability_bareroot';
    $table_name2 = $wpdb->prefix . 'term_taxonomymeta';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name1 . " (
      id                bigint(20) unsigned NOT NULL auto_increment,
      size              varchar(255) default NULL,
      plant_name        varchar(255) NOT NULL,
      common_name       varchar(255) default NULL,
      plant_slug        varchar(255) NOT NULL,
      seed_source       varchar(255) default NULL,
      stem_type         varchar(255) default NULL,
      category          varchar(255) default NULL,
      stems             varchar(255) default NULL,
      bundle            varchar(255) default NULL,
      restoration_grade boolean NOT NULL default '0',
      bulb              boolean NOT NULL default '0',
      harvested         boolean NOT NULL default '0',
      quantity          bigint(20) unsigned NOT NULL default '0',
      price             decimal(10,2) default NULL, 
      import_date       datetime NOT NULL default '0000-00-00 00:00:00',
      price_<100        decimal(10,2) default NULL,
      price_100+        decimal(10,2) default NULL,
      PRIMARY KEY (id),
      KEY seed_source (seed_source),
      KEY stem_type (stem_type)
    ) $charset_collate;";
    dbDelta($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name2 . " (
		meta_id bigint(20) unsigned NOT NULL auto_increment,
		term_taxonomy_id bigint(20) unsigned NOT NULL default '0',
		meta_key varchar(255) default NULL,
		meta_value longtext,
		PRIMARY KEY  (meta_id),
		KEY term_taxonomy_id (term_taxonomy_id),
		KEY meta_key (meta_key)
    ) $charset_collate;";
    dbDelta($sql);    
}

register_activation_hook(__FILE__, 'create_the_custom_table');
