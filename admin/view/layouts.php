<?php

//menu layouts view

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
for($i=1;$i<=11;$i++){
	$data['player_x_' . $i] = isset($_POST['player_x_' . $i]) ? intval($_POST['player_x_' . $i], 10) : null;
	$data['player_y_' . $i] = isset($_POST['player_y_' . $i]) ? intval($_POST['player_y_' . $i], 10) : null;
	$data['player_show_' . $i] = isset($_POST['player_show_' . $i]) ? intval($_POST['player_show_' . $i], 10) : null;
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
	$table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
	$safe_sql = $wpdb->prepare("UPDATE $table_name SET 
        description = %s,
        player_x_1 = %d,
        player_y_1 = %d,
        player_x_2 = %d,
        player_y_2 = %d,
        player_x_3 = %d,
        player_y_3 = %d,
        player_x_4 = %d,
        player_y_4 = %d,
        player_x_5 = %d,
        player_y_5 = %d,
        player_x_6 = %d,
        player_y_6 = %d,
        player_x_7 = %d,
        player_y_7 = %d,
        player_x_8 = %d,
        player_y_8 = %d,
        player_x_9 = %d,
        player_y_9 = %d,
        player_x_10 = %d,
        player_y_10 = %d,
        player_x_11 = %d,
        player_y_11 = %d,
        player_show_1 = %d,
        player_show_2 = %d,
        player_show_3 = %d,
        player_show_4 = %d,
        player_show_5 = %d,
        player_show_6 = %d,
        player_show_7 = %d,
        player_show_8 = %d,
        player_show_9 = %d,
        player_show_10 = %d,
        player_show_11 = %d
        WHERE id = %d",
		$data['description'],
		$data['player_x_1'],
		$data['player_y_1'],
		$data['player_x_2'],
		$data['player_y_2'],
		$data['player_x_3'],
		$data['player_y_3'],
		$data['player_x_4'],
		$data['player_y_4'],
		$data['player_x_5'],
		$data['player_y_5'],
		$data['player_x_6'],
		$data['player_y_6'],
		$data['player_x_7'],
		$data['player_y_7'],
		$data['player_x_8'],
		$data['player_y_8'],
		$data['player_x_9'],
		$data['player_y_9'],
		$data['player_x_10'],
		$data['player_y_10'],
		$data['player_x_11'],
		$data['player_y_11'],
		$data['player_show_1'],
		$data['player_show_2'],
		$data['player_show_3'],
		$data['player_show_4'],
		$data['player_show_5'],
		$data['player_show_6'],
		$data['player_show_7'],
		$data['player_show_8'],
		$data['player_show_9'],
		$data['player_show_10'],
		$data['player_show_11'],
		$data['id'] );

	$query_result = $wpdb->query( $safe_sql );

	if($query_result !== false){
		$dismissible_notice_a[] = [
			'message' => __('The layout has been successfully updated.', 'soccer-formation-ve'),
			'class' => 'updated'
		];
	}

}else{

	//add ------------------------------------------------------------------
	if( !is_null($data['form_submitted']) and !isset($invalid_data) ){

		//insert into the database
		$table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
		$safe_sql = $wpdb->prepare("INSERT INTO $table_name SET 
            description = %s,
            player_x_1 = %d,
            player_y_1 = %d,
            player_x_2 = %d,
            player_y_2 = %d,
            player_x_3 = %d,
            player_y_3 = %d,
            player_x_4 = %d,
            player_y_4 = %d,
            player_x_5 = %d,
            player_y_5 = %d,
            player_x_6 = %d,
            player_y_6 = %d,
            player_x_7 = %d,
            player_y_7 = %d,
            player_x_8 = %d,
            player_y_8 = %d,
            player_x_9 = %d,
            player_y_9 = %d,
            player_x_10 = %d,
            player_y_10 = %d,
            player_x_11 = %d,
            player_y_11 = %d,
            player_show_1 = %d,
            player_show_2 = %d,
            player_show_3 = %d,
            player_show_4 = %d,
            player_show_5 = %d,
            player_show_6 = %d,
            player_show_7 = %d,
            player_show_8 = %d,
            player_show_9 = %d,
            player_show_10 = %d,
            player_show_11 = %d",
			$data['description'],
			$data['player_x_1'],
			$data['player_y_1'],
			$data['player_x_2'],
			$data['player_y_2'],
			$data['player_x_3'],
			$data['player_y_3'],
			$data['player_x_4'],
			$data['player_y_4'],
			$data['player_x_5'],
			$data['player_y_5'],
			$data['player_x_6'],
			$data['player_y_6'],
			$data['player_x_7'],
			$data['player_y_7'],
			$data['player_x_8'],
			$data['player_y_8'],
			$data['player_x_9'],
			$data['player_y_9'],
			$data['player_x_10'],
			$data['player_y_10'],
			$data['player_x_11'],
			$data['player_y_11'],
			$data['player_show_1'],
			$data['player_show_2'],
			$data['player_show_3'],
			$data['player_show_4'],
			$data['player_show_5'],
			$data['player_show_6'],
			$data['player_show_7'],
			$data['player_show_8'],
			$data['player_show_9'],
			$data['player_show_10'],
			$data['player_show_11'],
			);

		$query_result = $wpdb->query( $safe_sql );

		if($query_result !== false){
			$dismissible_notice_a[] = [
				'message' => __('The layout has been successfully added.', 'soccer-formation-ve'),
				'class' => 'updated'
			];
		}

	}

}

//delete an item
if( !is_null($data['delete_id']) ){

    $not_deletable = false;

	//delete this layout only if it's not used by any formation and it's not a default layout.
	if( $this->ut_layout_is_used($data['delete_id']) ){

		$dismissible_notice_a[] = [
			'message' => __("This layout is associated with one or more formations and can't be deleted.", 'soccer-formation-ve'),
			'class' => 'error'
		];
        $not_deletable = true;

    }

	if($this->ut_is_default_layout($data['delete_id'])){

		$dismissible_notice_a[] = [
			'message' => __("The default layout can't be deleted.", 'soccer-formation-ve'),
			'class' => 'error'
		];
        $not_deletable = true;

    }

	if($not_deletable === false){

        $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
        $safe_sql = $wpdb->prepare("DELETE FROM $table_name WHERE id = %d ", $data['delete_id']);
		$query_result = $wpdb->query( $safe_sql );

		if($query_result !== false){
			$dismissible_notice_a[] = [
				'message' => __('The layout has been successfully deleted.', 'soccer-formation-ve'),
				'class' => 'updated'
			];
		}

    }

}

//clone a table
if (!is_null($data['clone_id'])) {

	//clone a table
	$table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
	$wpdb->query("CREATE TEMPORARY TABLE tmptable_1 SELECT * FROM $table_name WHERE id = " . $data['clone_id']);
	$wpdb->query("UPDATE tmptable_1 SET id = NULL");
	$wpdb->query("INSERT INTO $table_name SELECT * FROM tmptable_1");
	$wpdb->query("DROP TEMPORARY TABLE IF EXISTS tmptable_1");

}

//get the layout data
if(!is_null($data['edit_id'])){

	$table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
	$safe_sql = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $data['edit_id']);
	$layout_obj = $wpdb->get_row($safe_sql);

}

//Generate the inline style of the field
$field_bg_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_field_bg_color')), 1);
$field_lines_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_field_lines_color')), 1);
$inline_field_style = "background: url('" . $this->shared->get('url') . "shared/assets/img/field.php?field_bg_color=" . $field_bg_color . "&field_lines_color=" . $field_lines_color . "') no-repeat !important";

//Generate the inline style of the players
$player_number_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_player_number_color')), 1);
$player_name_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_player_name_color')), 1);
$player_number_bg_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_player_number_bg_color')), 1);
$player_name_bg_color = substr(sanitize_hex_color(get_option($this->shared->get('slug') . '_player_name_bg_color')), 1);
$inline_player_style = "background: url('" . $this->shared->get('url') . 'shared/assets/img/player.php?player_number_bg_color=' . $player_number_bg_color . '&player_name_bg_color=' . $player_name_bg_color . "') no-repeat !important";
$inline_player_number_style = "color: #" . str_replace('#', '', sanitize_hex_color(get_option($this->shared->get('slug') . '_player_number_color'))) . " !important;";
$inline_player_number_style .= "font-family: " . esc_attr(get_option($this->shared->get('slug') . '_font_family')) . " !important;";
$inline_player_number_style .= "font-weight: " . intval(get_option($this->shared->get('slug') . '_font_weight'), 10) . " !important;";
$inline_player_number_style .= "font-size: " . intval(get_option($this->shared->get('slug') . '_font_size'), 10) . "px !important;";
$inline_player_name_style = "color: #" . str_replace('#', '', sanitize_hex_color(get_option($this->shared->get('slug') . '_player_name_color'))) . " !important;";
$inline_player_name_style .= "font-family: " . esc_attr(get_option($this->shared->get('slug') . '_font_family')) . " !important;";
$inline_player_name_style .= "font-weight: " . intval(get_option($this->shared->get('slug') . '_font_weight'), 10) . " !important;";
$inline_player_name_style .= "font-size: " . intval(get_option($this->shared->get('slug') . '_font_size'), 10) . "px !important;";

?>

<!-- output -->

<div class="wrap">

    <div id="daext-header-wrapper" class="daext-clearfix">

        <h2><?php esc_html_e('Soccer Formation VE - Layouts', 'soccer-formation-ve'); ?></h2>

        <form action="admin.php" method="get" id="daext-search-form">

            <input type="hidden" name="page" value="daextsfve-layouts">

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

		//retrieve the total number of layouts
		$table_name=$wpdb->prefix . $this->shared->get('slug') . "_layouts";
		$total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name $filter");

		//Initialize the pagination class
		require_once( $this->shared->get('dir') . '/admin/inc/class-daextsfve-pagination.php' );
		$pag = new Daextsfve_Pagination();
		$pag->set_total_items( $total_items );//Set the total number of items
		$pag->set_record_per_page( 10 ); //Set records per page
		$pag->set_target_page( "admin.php?page=" . $this->shared->get('slug') . "-layouts" );//Set target page
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
                            <div class="help-icon" title="<?php esc_attr_e( 'The ID of the layout.', 'soccer-formation-ve'); ?>"></div>
                        </th>
                        <th>
                            <div><?php esc_html_e( 'Description', 'soccer-formation-ve'); ?></div>
                            <div class="help-icon"
                                 title="<?php esc_attr_e( 'The description of the layout.', 'soccer-formation-ve'); ?>"></div>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

					<?php foreach ( $results as $result ) : ?>
                        <tr>
                            <td><?php echo intval( $result['id'], 10 ); ?></td>
                            <td><?php echo esc_attr( stripslashes( $result['description'] ) ); ?></td>
                            <td class="icons-container">
                                <form method="POST"
                                      action="admin.php?page=<?php echo esc_attr($this->shared->get( 'slug' )); ?>-layouts">
                                    <input type="hidden" name="clone_id" value="<?php echo intval( $result['id'], 10 ); ?>">
                                    <input class="menu-icon clone help-icon" type="submit" value="">
                                </form>
                                <a class="menu-icon edit"
                                   href="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-layouts&edit_id=<?php echo intval( $result['id'],
									   10 ); ?>"></a>
                                <form id="form-delete-<?php echo intval( $result['id'], 10 ); ?>" method="POST"
                                      action="admin.php?page=<?php echo esc_attr($this->shared->get( 'slug' )); ?>-layouts">
                                    <input type="hidden" value="<?php echo intval( $result['id'], 10 ); ?>" name="delete_id">
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
                        <span class="daext-displaying-num"><?php echo esc_html($pag->total_items); ?> <?php esc_html_e('items', 'soccer-formation-ve'); ?></span>
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

        <form method="POST" action="admin.php?page=<?php echo esc_attr($this->shared->get('slug')); ?>-layouts" >

            <input type="hidden" value="1" name="form_submitted">

            <div class="daext-form-container">

				<?php if(!is_null($data['edit_id'])) : ?>

                    <!-- Edit a layout -->

                    <div class="daext-form-title"><?php esc_html_e('Edit Layout', 'soccer-formation-ve'); ?> <?php echo intval($layout_obj->id, 10); ?></div>

                    <table class="daext-form daext-form-table">

                        <input type="hidden" name="update_id" value="<?php echo intval($layout_obj->id, 10); ?>" />

                        <!-- Description -->
                        <tr valign="top">
                            <th><label for="description"><?php esc_html_e('Description', 'soccer-formation-ve'); ?></label></th>
                            <td>
                                <input value="<?php echo esc_attr(stripslashes($layout_obj->description)); ?>" type="text"
                                       id="description" maxlength="255" size="30" name="description"/>
                                <div class="help-icon"
                                     title="<?php esc_attr_e('The description of the layout.', 'soccer-formation-ve'); ?>"></div>
                            </td>
                        </tr>

                        <?php

                        for($i=1;$i<=11;$i++){

                            echo '<input type="hidden" id="player-x-' . $i . '" name="player_x_' . $i . '" value="' . intval($layout_obj->{'player_x_' . $i}, 10) . '" />';
                            echo '<input type="hidden" id="player-y-' . $i . '" name="player_y_' . $i . '" value="' . intval($layout_obj->{'player_y_' . $i}, 10) . '" />';

                        }

                        ?>

                        <!-- Field -->
                        <tr valign="top" class="daextsfve-draggable-field-container">
                            <td>

                                <div id="daextsfve-draggable-field" style="<?php echo $inline_field_style; ?>" >

                                    <?php for($i=1;$i<=11;$i++) : ?>

                                        <div id="daextsfve-field-player-<?php echo $i; ?>" class="daextsfve-field-player <?php if(!$layout_obj->{'player_show_' . $i}){echo "daextsfve-hidden-player";} ?>" data-id="<?php echo $i; ?>" style="<?php echo $inline_player_style; ?>">
                                            <div class="daextsfve-player-number" style="<?php echo $inline_player_number_style; ?>">1</div>
                                            <div class="daextsfve-player-name" style="<?php echo $inline_player_name_style; ?>"></div>
                                        </div>

                                    <?php endfor; ?>

                                </div>

                            </td>
                        </tr>

                        <!-- Advanced Options ---------------------------------------------------------------------- -->
                        <tr class="group-trigger" data-trigger-target="advanced-options">
                            <th class="group-title"><?php esc_html_e('Advanced', 'soccer-formation-ve'); ?></th>
                            <td>
                                <div class="expand-icon"></div>
                            </td>
                        </tr>

                        <?php for($i=1;$i<=11;$i++) : ?>

                            <!-- Show Player X -->
                            <tr class="advanced-options">
                                <th scope="row"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php esc_html_e($i); ?></th>
                                <td>
                                    <select data-id="<?php esc_attr_e($i); ?>" id="player-show-<?php esc_attr_e($i); ?>" name="player_show_<?php esc_attr_e($i); ?>" class="checkbox-player-show daext-display-none">
                                        <option value="0" <?php selected($layout_obj->{'player_show_' . $i}, 0); ?>><?php esc_html_e('Hide', 'soccer-formation-ve'); ?></option>
                                        <option value="1" <?php selected($layout_obj->{'player_show_' . $i}, 1); ?>><?php esc_html_e('Show', 'soccer-formation-ve'); ?></option>
                                    </select>
                                    <div class="help-icon" title='<?php esc_attr_e('This option determines if the player should be displayed.', 'soccer-formation-ve'); ?>'></div>
                                </td>
                            </tr>

                        <?php endfor; ?>

                    </table>

                    <!-- submit button -->
                    <div class="daext-form-action">
                        <input class="button" type="submit" value="<?php esc_attr_e('Update Layout', 'soccer-formation-ve'); ?>" >
                        <input id="cancel" class="button" type="submit" value="<?php esc_attr_e('Cancel', 'soccer-formation-ve'); ?>">
                    </div>

			    <?php else : ?>

                    <!-- Create new layout -->

                    <div class="daext-form-title"><?php esc_html_e('Create New Layout', 'soccer-formation-ve'); ?></div>

                    <table class="daext-form daext-form-table">

                        <!-- Player X 1 -->
                        <input type="hidden" id="player-x-1" name="player_x_1" value="258" />

                        <!-- Player Y 1 -->
                        <input type="hidden" id="player-y-1" name="player_y_1" value="654" />

                        <!-- Player X 2 -->
                        <input type="hidden" id="player-x-2" name="player_x_2" value="93" />

                        <!-- Player Y 2 -->
                        <input type="hidden" id="player-y-2" name="player_y_2" value="433" />

                        <!-- Player X 3 -->
                        <input type="hidden" id="player-x-3" name="player_x_3" value="153" />

                        <!-- Player Y 3 -->
                        <input type="hidden" id="player-y-3" name="player_y_3" value="514" />

                        <!-- Player X 4 -->
                        <input type="hidden" id="player-x-4" name="player_x_4" value="369" />

                        <!-- Player Y 4 -->
                        <input type="hidden" id="player-y-4" name="player_y_4" value="514" />

                        <!-- Player X 5 -->
                        <input type="hidden" id="player-x-5" name="player_x_5" value="429" />

                        <!-- Player Y 5 -->
                        <input type="hidden" id="player-y-5" name="player_y_5" value="433" />

                        <!-- Player X 6 -->
                        <input type="hidden" id="player-x-6" name="player_x_6" value="93" />

                        <!-- Player Y 6 -->
                        <input type="hidden" id="player-y-6" name="player_y_6" value="213" />

                        <!-- Player X 7 -->
                        <input type="hidden" id="player-x-7" name="player_x_7" value="153" />

                        <!-- Player Y 7 -->
                        <input type="hidden" id="player-y-7" name="player_y_7" value="294" />

                        <!-- Player X 8 -->
                        <input type="hidden" id="player-x-8" name="player_x_8" value="369" />

                        <!-- Player Y 8 -->
                        <input type="hidden" id="player-y-8" name="player_y_8" value="294" />

                        <!-- Player X 9 -->
                        <input type="hidden" id="player-x-9" name="player_x_9" value="429" />

                        <!-- Player Y 9 -->
                        <input type="hidden" id="player-y-9" name="player_y_9" value="213" />

                        <!-- Player X 10 -->
                        <input type="hidden" id="player-x-10" name="player_x_10" value="153" />

                        <!-- Player Y 10 -->
                        <input type="hidden" id="player-y-10" name="player_y_10" value="73" />

                        <!-- Player X 11 -->
                        <input type="hidden" id="player-x-11" name="player_x_11" value="369" />

                        <!-- Player Y 11 -->
                        <input type="hidden" id="player-y-11" name="player_y_11" value="72" />

                        <!-- Description -->
                        <tr valign="top">
                            <th><label for="description"><?php esc_html_e('Description', 'soccer-formation-ve'); ?></label></th>
                            <td>
                                <input type="text"
                                       id="description" maxlength="255" size="30" name="description"/>
                                <div class="help-icon"
                                     title="<?php esc_attr_e('The description of the layout.', 'soccer-formation-ve'); ?>"></div>
                            </td>
                        </tr>

                        <!-- Field -->
                        <tr valign="top" class="daextsfve-draggable-field-container">
                            <td>

                                <div id="daextsfve-draggable-field" style="<?php echo $inline_field_style; ?>" >

                                    <?php for($i=1;$i<=11;$i++) : ?>

                                        <div id="daextsfve-field-player-<?php echo $i; ?>" class="daextsfve-field-player" data-id="<?php echo $i; ?>" style="<?php echo $inline_player_style; ?>">
                                            <div class="daextsfve-player-number" style="<?php echo $inline_player_number_style; ?>"><?php echo $i; ?></div>
                                            <div class="daextsfve-player-name" style="<?php echo $inline_player_name_style; ?>"></div>
                                        </div>

                                    <?php endfor; ?>

                                </div>

                            </td>
                        </tr>

                        <!-- Advanced Options ---------------------------------------------------------------------- -->
                        <tr class="group-trigger" data-trigger-target="advanced-options">
                            <th class="group-title"><?php esc_html_e('Advanced', 'soccer-formation-ve'); ?></th>
                            <td>
                                <div class="expand-icon"></div>
                            </td>
                        </tr>

                        <?php for($i=1;$i<=11;$i++) : ?>

                            <!-- Show Player X -->
                            <tr class="advanced-options">
                                <th scope="row"><?php esc_html_e('Player', 'soccer-formation-ve'); ?> <?php esc_html_e($i); ?></th>
                                <td>
                                    <select data-id="<?php esc_attr_e($i); ?>" id="player-show-<?php esc_attr_e($i); ?>" name="player_show_<?php esc_attr_e($i); ?>" class="checkbox-player-show daext-display-none">
                                        <option value="0"><?php esc_html_e('Hide', 'soccer-formation-ve'); ?></option>
                                        <option value="1" selected="selected"><?php esc_html_e('Show', 'soccer-formation-ve'); ?></option>
                                    </select>
                                    <div class="help-icon" title='<?php esc_attr_e('This option determines if the player should be displayed.', 'soccer-formation-ve'); ?>'></div>
                                </td>
                            </tr>

                        <?php endfor; ?>

                    </table>

                    <!-- submit button -->
                    <div class="daext-form-action">
                        <input class="button" type="submit" value="<?php esc_attr_e('Add Layout', 'soccer-formation-ve'); ?>" >
                    </div>

			    <?php endif; ?>

            </div>

        </form>

    </div>

</div>

<!-- Dialog Confirm -->
<div id="dialog-confirm" title="<?php esc_attr_e('Delete the layout?', 'soccer-formation-ve'); ?>" class="display-none">
    <p><?php esc_attr_e('This layout will be permanently deleted and cannot be recovered. Are you sure?', 'soccer-formation-ve'); ?></p>
</div>