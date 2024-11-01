<?php

//menu formations view

if ( !current_user_can( 'edit_posts' ) )  {
        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'soccer-formation-ve') );
}

?>

<!-- process data -->

<?php

//Initialize variables -------------------------------------------------------------------------------------------------
$dismissible_notice_a = [];

//Preliminary operations -----------------------------------------------------------------------------------------------
global $wpdb;

//Sanitization ---------------------------------------------------------------------------------------------

//Actions
$data['edit_id'] = isset($_GET['edit_id']) ? intval($_GET['edit_id'], 10) : null;
$data['delete_id'] = isset($_POST['delete_id']) ? intval($_POST['delete_id'], 10) : null;
$data['clone_id'] = isset($_POST['clone_id']) ? intval($_POST['clone_id'], 10) : null;
$data['update_id']    = isset( $_POST['update_id'] ) ? intval( $_POST['update_id'], 10 ) : null;
$data['form_submitted']    = isset( $_POST['form_submitted'] ) ? intval( $_POST['form_submitted'], 10 ) : null;

//Filter and search data
$data['s'] = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : null;

//Form data
$data['id'] = isset($_POST['update_id']) ? intval($_POST['update_id'], 10) : null;
$data['description'] = isset($_POST['description']) ? sanitize_text_field($_POST['description']) : null;
$data['layout_id'] = isset($_POST['layout_id']) ? intval($_POST['layout_id'], 10) : null;

for($i=1;$i<=11;$i++){
    $data['player_name_' . $i] = isset($_POST['player_name_' . $i]) ? sanitize_text_field($_POST['player_name_' . $i]) : null;
    $data['player_number_' . $i] = isset($_POST['player_number_' . $i]) ? sanitize_text_field($_POST['player_number_' . $i]) : null;
}

//Validation -----------------------------------------------------------------------------------------------

if( !is_null( $data['update_id'] ) or !is_null($data['form_submitted']) ) {

	//validation on "description"
	if ( mb_strlen( trim( $data['description'] ) ) === 0 or mb_strlen( trim( $data['description'] ) ) > 100 ) {
		$dismissible_notice_a[] = [
		  'message' => __( 'Please enter a valid value in the "Description" field.', 'soccer-formation-ve'),
          'class' => 'error'
        ];
		$invalid_data         = true;
	}

}

//update ---------------------------------------------------------------
if( !is_null($data['update_id']) and !isset($invalid_data) ){

    //update the database
    $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
    $safe_sql = $wpdb->prepare("UPDATE $table_name SET 
        description = %s,
        layout_id = %d,
        player_name_1 = %s,
        player_number_1 = %s,
        player_name_2 = %s,
        player_number_2 = %s,
        player_name_3 = %s,
        player_number_3 = %s,
        player_name_4 = %s,
        player_number_4 = %s,
        player_name_5 = %s,
        player_number_5 = %s,
        player_name_6 = %s,
        player_number_6 = %s,
        player_name_7 = %s,
        player_number_7 = %s,
        player_name_8 = %s,
        player_number_8 = %s,
        player_name_9 = %s,
        player_number_9 = %s,
        player_name_10 = %s,
        player_number_10 = %s,
        player_name_11 = %s,
        player_number_11 = %s
        WHERE id = %d",
        $data['description'],
        $data['layout_id'],
        $data['player_name_1'],
        $data['player_number_1'],
        $data['player_name_2'],
        $data['player_number_2'],
        $data['player_name_3'],
        $data['player_number_3'],
        $data['player_name_4'],
        $data['player_number_4'],
        $data['player_name_5'],
        $data['player_number_5'],
        $data['player_name_6'],
        $data['player_number_6'],
        $data['player_name_7'],
        $data['player_number_7'],
        $data['player_name_8'],
        $data['player_number_8'],
        $data['player_name_9'],
        $data['player_number_9'],
        $data['player_name_10'],
        $data['player_number_10'],
        $data['player_name_11'],
        $data['player_number_11'],
        $data['id'] );

	$query_result = $wpdb->query( $safe_sql );

	if($query_result !== false){
		$dismissible_notice_a[] = [
			'message' => __('The formation has been successfully updated.', 'soccer-formation-ve'),
			'class' => 'updated'
		];
	}

}else{

    //add ------------------------------------------------------------------
    if( !is_null($data['form_submitted']) and !isset($invalid_data) ){

	    //insert into the database
        $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
        $safe_sql = $wpdb->prepare("INSERT INTO $table_name SET 
            description = %s,
            layout_id = %d,
            player_name_1 = %s,
            player_number_1 = %s,
            player_name_2 = %s,
            player_number_2 = %s,
            player_name_3 = %s,
            player_number_3 = %s,
            player_name_4 = %s,
            player_number_4 = %s,
            player_name_5 = %s,
            player_number_5 = %s,
            player_name_6 = %s,
            player_number_6 = %s,
            player_name_7 = %s,
            player_number_7 = %s,
            player_name_8 = %s,
            player_number_8 = %s,
            player_name_9 = %s,
            player_number_9 = %s,
            player_name_10 = %s,
            player_number_10 = %s,
            player_name_11 = %s,
            player_number_11 = %s",
            $data['description'],
            $data['layout_id'],
            $data['player_name_1'],
            $data['player_number_1'],
            $data['player_name_2'],
            $data['player_number_2'],
            $data['player_name_3'],
            $data['player_number_3'],
            $data['player_name_4'],
            $data['player_number_4'],
            $data['player_name_5'],
            $data['player_number_5'],
            $data['player_name_6'],
            $data['player_number_6'],
            $data['player_name_7'],
            $data['player_number_7'],
            $data['player_name_8'],
            $data['player_number_8'],
            $data['player_name_9'],
            $data['player_number_9'],
            $data['player_name_10'],
            $data['player_number_10'],
            $data['player_name_11'],
            $data['player_number_11']
            );

	    $query_result = $wpdb->query( $safe_sql );

	    if($query_result !== false){
		    $dismissible_notice_a[] = [
			    'message' => __('The formation has been successfully added.', 'soccer-formation-ve'),
			    'class' => 'updated'
		    ];
	    }

    }

}

//delete an item
if( !is_null($data['delete_id']) ){

    $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
    $safe_sql = $wpdb->prepare("DELETE FROM $table_name WHERE id = %d ", $data['delete_id']);
	$query_result = $wpdb->query( $safe_sql );

	if($query_result !== false){
		$dismissible_notice_a[] = [
			'message' => __('The formation has been successfully deleted.', 'soccer-formation-ve'),
			'class' => 'updated'
		];
	}

}

//clone a table
if (!is_null($data['clone_id'])) {

    $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
    $wpdb->query("CREATE TEMPORARY TABLE tmptable_1 SELECT * FROM $table_name WHERE id = " . $data['clone_id']);
    $wpdb->query("UPDATE tmptable_1 SET id = NULL");
    $wpdb->query("INSERT INTO $table_name SELECT * FROM tmptable_1");
    $wpdb->query("DROP TEMPORARY TABLE IF EXISTS tmptable_1");

}

 //get the formation data
if(!is_null($data['edit_id'])){

    $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
    $safe_sql = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $data['edit_id']);
    $formation_obj = $wpdb->get_row($safe_sql);

}


?>

<!-- output -->

<div class="wrap">

    <div id="daext-header-wrapper" class="daext-clearfix">

        <h2><?php esc_html_e('Soccer Formation VE - Formations', 'soccer-formation-ve'); ?></h2>

        <form action="admin.php" method="get" id="daext-search-form">

            <input type="hidden" name="page" value="daextsfve-formations">

            <p><?php esc_html_e('Perform your Search', 'soccer-formation-ve'); ?></p>

	        <?php
	        if ( ! is_null( $data['s'] ) and mb_strlen( trim( $data['s'] ) ) > 0 ) {
		        $search_string = $data['s'];
	        } else {
		        $search_string = '';
	        }

			?>

            <input type="text" name="s"
                   value="<?php echo esc_attr(stripslashes($search_string)); ?>" autocomplete="off" maxlength="255">
            <input type="submit" value="">

        </form>

    </div>

    <div id="daext-menu-wrapper">

	    <?php $this->dismissible_notice($dismissible_notice_a); ?>

        <!-- table -->

        <?php

        //create the query part used to filter the results when a search is performed
        if (!is_null($data['s']) and mb_strlen(trim($data['s'])) > 0) {

            //create the query part used to filter the results when a search is performed
            $filter = $wpdb->prepare('WHERE (description LIKE %s)',
                '%' . $data['s'] . '%');

        }else{
            $filter = '';
        }

        //retrieve the total number of formations
        global $wpdb;
        $table_name=$wpdb->prefix . $this->shared->get('slug') . "_formations";
        $total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name $filter");

        //Initialize the pagination class
        require_once( $this->shared->get('dir') . '/admin/inc/class-daextsfve-pagination.php' );
        $pag = new Daextsfve_Pagination();
        $pag->set_total_items( $total_items );//Set the total number of items
        $pag->set_record_per_page( 10 ); //Set records per page
        $pag->set_target_page( "admin.php?page=" . $this->shared->get('slug') . "-formations" );//Set target page
        $pag->set_current_page();//set the current page number from $_GET

        ?>

        <!-- Query the database -->
        <?php
        $query_limit = $pag->query_limit();
        $results = $wpdb->get_results("SELECT * FROM $table_name $filter ORDER BY id DESC $query_limit ", ARRAY_A); ?>

        <?php if( count($results) > 0 ) : ?>

            <div class="daext-items-container">

                <!-- list of tables -->
                <table class="daext-items">
                    <thead>
                        <tr>
                            <th>
                                <div><?php esc_html_e( 'ID', 'soccer-formation-ve'); ?></div>
                                <div class="help-icon" title="<?php esc_attr_e( 'The ID of the formation.', 'soccer-formation-ve'); ?>"></div>
                            </th>
                            <th>
                                <div><?php esc_html_e( 'Shortcode', 'soccer-formation-ve'); ?></div>
                                <div class="help-icon"
                                     title="<?php esc_attr_e( 'The shortcode of the formation.', 'soccer-formation-ve'); ?>"></div>
                            </th>
                            <th>
                                <div><?php esc_html_e( 'Description', 'soccer-formation-ve'); ?></div>
                                <div class="help-icon"
                                     title="<?php esc_attr_e( 'The description of the formation.', 'soccer-formation-ve'); ?>"></div>
                            </th>
                            <th>
                                <div><?php esc_html_e( 'Layout', 'soccer-formation-ve'); ?></div>
                                <div class="help-icon"
                                     title="<?php esc_attr_e( 'The layout of the formation.', 'soccer-formation-ve'); ?>"></div>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($results as $result) : ?>
                        <tr>
                            <td><?php echo intval($result['id'], 10); ?></td>
                            <td>[soccer-formation-ve id="<?php echo intval($result['id'], 10); ?>"]</td>
                            <td><?php echo esc_attr(stripslashes($result['description'])); ?></td>
                            <td><?php echo esc_attr(stripslashes( $this->ut_get_layout_name($result['layout_id']) )); ?></td>
                            <td class="icons-container">
                                <form method="POST"
                                      action="admin.php?page=<?php echo esc_attr($this->shared->get('slug')); ?>-formations">
                                    <input type="hidden" name="clone_id" value="<?php echo intval($result['id'], 10); ?>">
                                    <input class="menu-icon clone help-icon" type="submit" value="">
                                </form>
                                <a class="menu-icon edit" href="admin.php?page=<?php echo esc_attr($this->shared->get('slug')); ?>-formations&edit_id=<?php echo intval($result['id'], 10); ?>"></a>
                                <form id="form-delete-<?php echo intval($result['id'], 10); ?>" method="POST" action="admin.php?page=<?php echo $this->shared->get('slug'); ?>-formations">
                                    <input type="hidden" value="<?php echo intval($result['id'], 10); ?>" name="delete_id" >
                                    <input class="menu-icon delete" type="submit" value="">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <!-- Display the pagination -->
            <?php if($pag->total_items > 0) : ?>
                <div class="daext-tablenav daext-clearfix">
                    <div class="daext-tablenav-pages">
                        <span class="daext-displaying-num"><?php echo $pag->total_items; ?> <?php esc_html_e('items', 'soccer-formation-ve'); ?></span>
                        <?php $pag->show(); ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>

	        <?php

	        if (mb_strlen(trim($filter)) > 0) {
		        echo '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__('There are no results that match your filter.', 'soccer-formation-ve') . '</p></div>';
	        }

	        ?>

        <?php endif; ?>

         <form method="POST" action="admin.php?page=<?php echo esc_attr($this->shared->get('slug')); ?>-formations" >

             <input type="hidden" value="1" name="form_submitted">

             <div class="daext-form-container">

	         <?php if(!is_null($data['edit_id'])) : ?>

                 <!-- Edit a formation -->

                 <div class="daext-form-title"><?php esc_html_e('Edit Formation', 'soccer-formation-ve'); ?> <?php echo intval($formation_obj->id, 10); ?></div>

                 <table class="daext-form daext-form-table">

                     <input type="hidden" name="update_id" value="<?php echo intval($formation_obj->id, 10); ?>" />

                     <!-- Description -->
                     <tr valign="top">
                         <th><label for="description"><?php esc_html_e('Description', 'soccer-formation-ve'); ?></label></th>
                         <td>
                             <input value="<?php echo esc_attr(stripslashes($formation_obj->description)); ?>" type="text"
                                    id="description" maxlength="100" size="30" name="description"/>
                             <div class="help-icon"
                                  title="<?php esc_attr_e('The description of the formation.', 'soccer-formation-ve'); ?>"></div>
                         </td>
                     </tr>

                     <!-- Layout ID -->
                     <tr>
                         <th scope="row"><label for="tags"><?php esc_html_e('Layout', 'soccer-formation-ve'); ?></label></th>
                         <td>
                             <?php

                             $html = '<select id="layout-id" name="layout_id" class="daext-display-none">';

                             global $wpdb;
                             $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
                             $sql        = "SELECT id, description FROM $table_name ORDER BY id DESC";
                             $layout_a = $wpdb->get_results($sql, ARRAY_A);

                             foreach ($layout_a as $key => $layout) {
                                 $html .= '<option value="' . intval($layout['id'], 10) . '" ' . selected($formation_obj->layout_id,
                                         $layout['id'],
                                         false) . '>' . esc_html(stripslashes($layout['description'])) . '</option>';
                             }

                             $html .= '</select>';
                             $html .= '<div class="help-icon" title="' . esc_attr__('The layout of the formation.', 'soccer-formation-ve') . '"></div>';

                             echo $html;

                             ?>
                         </td>
                     </tr>

                     <?php

                     for($i=1;$i<=11;$i++){

                         ?>

                         <!-- Player Number X -->
                         <tr valign="top">
                             <th><label for="player-number-<?php echo intval($i, 10); ?>"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php echo intval($i, 10); ?> <?php esc_html_e('Number', 'soccer-formation-ve'); ?></label></th>
                             <td>
                                 <input type="text" id="player-number-<?php echo intval($i, 10); ?>" name="player_number_<?php echo intval($i, 10); ?>" maxlength="2" size="2" value="<?php echo esc_attr(stripslashes($formation_obj->{'player_number_' . $i})); ?>" />
                                 <div class="help-icon" title="<?php esc_attr_e('The number of the player.', 'soccer-formation-ve'); ?>"></div>
                             </td>
                         </tr>

                         <!-- Player Name X -->
                         <tr valign="top">
                             <th scope="row"><label for="player-name-<?php echo intval($i, 10); ?>"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php echo intval($i, 10); ?> <?php esc_html_e('Name', 'soccer-formation-ve'); ?></label></th>
                             <td>
                                 <input type="text" id="player-name-<?php echo intval($i, 10); ?>" name="player_name_<?php echo intval($i, 10); ?>" maxlength="255" size="20" value="<?php echo esc_attr(stripslashes($formation_obj->{'player_name_' . $i})); ?>" />
                                 <div class="help-icon" title="<?php esc_attr_e('The name of the player.', 'soccer-formation-ve'); ?>"></div>
                             </td>
                         </tr>

                        <?php

                     }

                     ?>

                 </table>

                 <!-- submit button -->
                 <div class="daext-form-action">
                     <input class="button" type="submit" value="<?php esc_attr_e('Update Formation', 'soccer-formation-ve'); ?>" >
                     <input id="cancel" class="button" type="submit" value="<?php esc_attr_e('Cancel', 'soccer-formation-ve'); ?>">
                 </div>

             <?php else : ?>

                 <!-- Create new formation -->

                 <div class="daext-form-title"><?php esc_html_e('Create New Formation', 'soccer-formation-ve'); ?></div>

                 <table class="daext-form daext-form-table">

                     <!-- Description -->
                     <tr valign="top">
                         <th><label for="description"><?php esc_html_e('Description', 'soccer-formation-ve'); ?></label></th>
                         <td>
                             <input type="text"
                                    id="description" maxlength="100" size="30" name="description"/>
                             <div class="help-icon"
                                  title="<?php esc_attr_e('The description of the formation.', 'soccer-formation-ve'); ?>"></div>
                         </td>
                     </tr>

                     <!-- Layout ID -->
                     <tr>
                         <th scope="row"><label for="tags"><?php esc_html_e('Layout', 'soccer-formation-ve'); ?></label></th>
                         <td>
                             <?php

                             $html = '<select id="layout-id" name="layout_id" class="daext-display-none">';

                             global $wpdb;
                             $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
                             $sql        = "SELECT id, description FROM $table_name ORDER BY id DESC";
                             $layout_a = $wpdb->get_results($sql, ARRAY_A);

                             foreach ($layout_a as $key => $layout) {
                                 $html .= '<option value="' . intval($layout['id'], 10) . '">' . esc_html(stripslashes($layout['description'])) . '</option>';
                             }

                             $html .= '</select>';
                             $html .= '<div class="help-icon" title="' . esc_attr__('The layout of the formation.', 'soccer-formation-ve') . '"></div>';

                             echo $html;

                             ?>
                         </td>
                     </tr>

                     <?php

                     for($i=1;$i<=11;$i++){

                         ?>

                         <!-- Player Number X -->
                         <tr valign="top">
                             <th><label for="player-number-<?php echo intval($i, 10); ?>"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php echo intval($i, 10); ?> <?php esc_html_e('Number', 'soccer-formation-ve'); ?></label></th>
                             <td>
                                 <input type="text" id="player-number-<?php echo intval($i, 10); ?>" name="player_number_<?php echo intval($i, 10); ?>" maxlength="2" size="2" />
                                 <div class="help-icon" title="<?php esc_attr_e('The number of the player.', 'soccer-formation-ve'); ?>"></div>
                             </td>
                         </tr>

                         <!-- Player Name X -->
                         <tr valign="top">
                             <th scope="row"><label for="player-name-<?php echo intval($i, 10); ?>"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php echo intval($i, 10); ?> <?php esc_html_e('Name', 'soccer-formation-ve'); ?></label></th>
                             <td>
                                 <input type="text" id="player-name-<?php echo intval($i, 10); ?>" name="player_name_<?php echo intval($i, 10); ?>" maxlength="255" size="20" name="player_name_1" />
                                 <div class="help-icon" title="<?php esc_attr_e('The name of the player.', 'soccer-formation-ve'); ?>"></div>
                             </td>
                         </tr>

                         <?php

                        }

                     ?>

                </table>

                 <!-- submit button -->
                 <div class="daext-form-action">
                     <input class="button" type="submit" value="<?php esc_attr_e('Add Formation', 'soccer-formation-ve'); ?>" >
                 </div>

            <?php endif; ?>

             </div>

        </form>

    </div>

</div>

<!-- Dialog Confirm -->
<div id="dialog-confirm" title="<?php esc_attr_e('Delete the formation?', 'soccer-formation-ve'); ?>" class="display-none">
    <p><?php esc_attr_e('This formation will be permanently deleted and cannot be recovered. Are you sure?', 'soccer-formation-ve'); ?></p>
</div>