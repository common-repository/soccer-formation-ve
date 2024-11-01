<?php

if ( ! current_user_can('manage_options')) {
    wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'soccer-formation-ve'));
}

?>

<!-- output -->

<div class="wrap">

    <h2><?php esc_html_e('Soccer Formation VE - Soccer Engine', 'soccer-formation-ve'); ?></h2>

    <div id="daext-menu-wrapper">

        <p><?php echo esc_html__('For professional users, we distribute ', 'soccer-formation-ve') . '<a href="https://daext.com/soccer-engine/">' . esc_attr__('Soccer Engine', 'soccer-formation-ve') . '</a> ' . esc_attr__(', a complete solution to store and display soccer data on a WordPress website.', 'soccer-formation-ve') . '</p>'; ?>
        <p><?php esc_html_e('This plugin can be used for example by:', 'soccer-formation-ve'); ?></p>
        <ul>
            <li><?php esc_html_e('Clubs that want to register and display the results of their senior and junior teams.', 'soccer-formation-ve'); ?></li>
            <li><?php esc_html_e('Clubs that want to create an advanced registry of players, staff members, match results, competitions and formations.', 'soccer-formation-ve'); ?></li>
            <li><?php esc_html_e('Bloggers that wants to review and analyze matches with timelines and commentaries.', 'soccer-formation-ve'); ?></li>
            <li><?php esc_html_e('The organizers of local competitions that want to list fixtures, results, and awards of the competition.', 'soccer-formation-ve'); ?></li>
            <li><?php esc_html_e('Transfer market news and rumors related websites interested in creating a registry of player transfers, team contracts, player agencies, and agency contracts.', 'soccer-formation-ve'); ?></li>
            <li><?php esc_html_e('News networks that want to improve the soccer section with results, standings table, and fixtures.', 'soccer-formation-ve'); ?></li>
        </ul>
        <h2><?php esc_html_e('Additional Benefits for the customers of Soccer Engine', 'soccer-formation-ve'); ?></h2>
        <ul>
            <li><?php esc_html_e('24 hours support provided 7 days a week', 'soccer-formation-ve'); ?></li>
            <li><?php echo esc_html__('30 day money back guarantee (more information is available on the', 'soccer-formation-ve') . ' <a href="https://daext.com/refund-policy/">' . esc_html__('Refund Policy', 'soccer-formation-ve') . '</a> ' . esc_html__('page', 'soccer-formation-ve') . ')'; ?></li>
        </ul>
        <h2><?php esc_html_e('Get Started', 'soccer-formation-ve'); ?></h2>
        <p><?php echo esc_html__('Download ', 'soccer-formation-ve') . ' <a href="https://daext.com/soccer-engine/">' . esc_html__('Soccer Engine', 'soccer-formation-ve') . '</a> ' . esc_attr__('now by selecting one of the available plans.', 'soccer-formation-ve'); ?></p>
    </div>

</div>

