<?php

if ( ! current_user_can('manage_options')) {
    wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'soccer-formation-ve'));
}

?>

<!-- output -->

<div class="wrap">

    <h2><?php esc_html_e('Soccer Formation VE - Help', 'soccer-formation-ve'); ?></h2>

    <div id="daext-menu-wrapper">

        <p><?php esc_html_e('Visit the resources below to find your answers or to ask questions directly to the plugin developers.', 'soccer-formation-ve'); ?></p>
        <ul>
            <li><a href="https://daext.com/doc/soccer-formation-ve/"><?php esc_html_e('Plugin Documentation', 'soccer-formation-ve'); ?></a></li>
            <li><a href="https://daext.com/support/"><?php esc_html_e('Support Conditions', 'soccer-formation-ve'); ?></li>
            <li><a href="https://daext.com"><?php esc_html_e('Developer Website', 'soccer-formation-ve'); ?></a></li>
            <li><a href="https://wordpress.org/plugins/soccer-formation-ve/"><?php esc_html_e('WordPress.org Plugin Page', 'soccer-formation-ve'); ?></a></li>
            <li><a href="https://wordpress.org/support/plugin/soccer-formation-ve/"><?php esc_html_e('WordPress.org Support Forum', 'soccer-formation-ve'); ?></a></li>
        </ul>

    </div>

</div>