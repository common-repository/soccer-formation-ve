<?php

//Exit if this file is called outside wordpress
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { die(); }

require_once( plugin_dir_path( __FILE__ ) . 'shared/class-daextsfve-shared.php' );
require_once( plugin_dir_path( __FILE__ ) . 'admin/class-daextsfve-admin.php' );

//delete options
Daextsfve_Admin::un_delete_options();

//delete database tables
Daextsfve_Admin::un_delete_database_tables();

