<?php
/* Category custom field */
add_action( 'category_add_form_fields', 'cactus_extra_category_fields', 10 );
add_action ( 'edit_category_form_fields', 'cactus_extra_category_fields');
function cactus_extra_category_fields( $tag ) {    //check for existing featured ID
	$t_id 							= is_object($tag) && $tag->term_id?$tag->term_id:'';
    $cat_header_background_height 	= get_option( "cat_header_background_height$t_id") ? get_option( "cat_header_background_height$t_id") : '';
    $page_background 				= get_option( "category_background_$t_id") ? get_option( "category_background_$t_id") : '';
    $cat_background_color 			= get_option( "cat_background_color_$t_id") ? get_option( "cat_background_color_$t_id"):'';
    $cat_background_repeat 			= get_option( "cat_background_repeat_$t_id") ? get_option( "cat_background_repeat_$t_id"):'';
    $cat_background_attachment 		= get_option( "cat_background_attachment_$t_id") ? get_option( "cat_background_attachment_$t_id"):'';
    $cat_background_position 		= get_option( "cat_background_position_$t_id") ? get_option( "cat_background_position_$t_id"):'';
    $cat_background_size 			= get_option( "cat_background_size_$t_id") ? get_option( "cat_background_size_$t_id"):'';
?>
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_header_background_height"><?php esc_html_e('Header Background height','cactusthemes'); ?></label>
		</th>
		<td>
            <input type="text" name="cat_header_background_height" value="<?php echo esc_attr($cat_header_background_height);?>" />
			<p class="description"><?php esc_html_e('put header background height for this category page. If empty, default background height in Theme Options will be used (Theme Options > General > Default Background Height)','cactusthemes'); ?></p>
		</td>
	</tr>

	<?php if(isset($page_background) && $page_background != ''):?>
	<tr class="form-field">
		<th></th>
	    <td>
	    	<div id="img-upload-wrap">
	            <div id="img-preview">
	                <img src="<?php echo esc_attr($page_background);?>" style="width:300px; height:auto;">
	            </div>
	        </div>
	    </td>
	</tr>
	<?php endif;?>
	<tr>
		<th><label for="page_background"><?php esc_html_e('Page Background','cactusthemes') ?></label></th>
		<td>
        	<label for="page_background">
                <input id="page_background" type="text" size="40" name="page_background" value="<?php echo esc_attr($page_background);?>" />
                <input id="upload_image_button" class="button" type="button" value="Upload/Add image" />
                <?php echo parse_str($_SERVER['QUERY_STRING'])?>
                <?php if(isset($action) && $action == 'edit'):?>
                	<input id="remove_image_button" class="button" type="button" value="Remove image" /></br>
            	<?php endif;?>
            </label>
            <p class="description"><?php esc_html_e('Choose background for this category','cactusthemes')?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_background_color"><?php esc_html_e('Category Background Color','cactusthemes'); ?></label>
		</th>
		<td>
            <input type="text" class="colorpicker" value="<?php echo $cat_background_color == '' ? 'ededed' : $cat_background_color;?>" name="cat_background_color"/>
			<p class="description"><?php esc_html_e('Choose category background color','cactusthemes'); ?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_background_repeat"><?php esc_html_e('Category Background Repeat','cactusthemes'); ?></label>
		</th>
		<td>
			<select name="cat_background_repeat">
				<option value="" <?php echo  $cat_background_repeat == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-repeat','cactusthemes'); ?></option>
				<option value="no-repeat" <?php echo  $cat_background_repeat == 'no-repeat' ? 'selected="selected"' : '';?>><?php esc_html_e('No Repeat','cactusthemes'); ?></option>
				<option value="repeat" <?php echo  $cat_background_repeat == 'repeat' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat All','cactusthemes'); ?></option>
				<option value="repeat-x" <?php echo  $cat_background_repeat == 'repeat-x' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat Horizontally','cactusthemes'); ?></option>
				<option value="repeat-y" <?php echo  $cat_background_repeat == 'repeat-y' ? 'selected="selected"' : '';?>><?php esc_html_e('Repeat Vertically','cactusthemes'); ?></option>
				<option value="inherit" <?php echo  $cat_background_repeat == 'inherit' ? 'selected="selected"' : '';?>><?php esc_html_e('Inherit','cactusthemes'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Choose category background repeat','cactusthemes'); ?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_background_attachment"><?php esc_html_e('Category Background Attachment','cactusthemes'); ?></label>
		</th>
		<td>
			<select name="cat_background_attachment">
				<option value="" <?php echo  $cat_background_attachment == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-attachment','cactusthemes'); ?></option>
				<option value="fixed" <?php echo  $cat_background_attachment == 'fixed' ? 'selected="selected"' : '';?>><?php esc_html_e('Fixed','cactusthemes'); ?></option>
				<option value="scroll" <?php echo  $cat_background_attachment == 'scroll' ? 'selected="selected"' : '';?>><?php esc_html_e('Scroll','cactusthemes'); ?></option>
				<option value="inherit" <?php echo  $cat_background_attachment == 'inherit' ? 'selected="selected"' : '';?>><?php esc_html_e('Inherit','cactusthemes'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Choose category background attchment','cactusthemes'); ?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_background_position"><?php esc_html_e('Category Background Position','cactusthemes'); ?></label>
		</th>
		<td>
			<select name="cat_background_position">
				<option value="" <?php echo  $cat_background_position == '' ? 'selected="selected"' : '';?>><?php esc_html_e('background-position','cactusthemes'); ?></option>
				<option value="left top" <?php echo  $cat_background_position == 'left top' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Top','cactusthemes'); ?></option>
				<option value="left center" <?php echo  $cat_background_position == 'left center' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Center','cactusthemes'); ?></option>
				<option value="left bottom" <?php echo  $cat_background_position == 'left bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Left Bottom','cactusthemes'); ?></option>
				<option value="center top" <?php echo  $cat_background_position == 'center top' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Top','cactusthemes'); ?></option>
				<option value="center center" <?php echo  $cat_background_position == 'center center' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Center','cactusthemes'); ?></option>
				<option value="center bottom" <?php echo  $cat_background_position == 'center bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Center Bottom','cactusthemes'); ?></option>
				<option value="right top" <?php echo  $cat_background_position == 'right top' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Top','cactusthemes'); ?></option>
				<option value="right center" <?php echo  $cat_background_position == 'right center' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Center','cactusthemes'); ?></option>
				<option value="right bottom" <?php echo  $cat_background_position == 'right bottom' ? 'selected="selected"' : '';?>><?php esc_html_e('Right Bottom','cactusthemes'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Choose category background position','cactusthemes'); ?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_background_size"><?php esc_html_e('Category Background Size','cactusthemes'); ?></label>
		</th>
		<td>
            <input type="text" name="cat_background_size" value="<?php echo esc_attr($cat_background_size);?>" />
			<p class="description"><?php esc_html_e('Choose category background size','cactusthemes'); ?></p>
		</td>
	</tr>

<?php
}
//save extra category extra fields hook
add_action ( 'edited_category', 'cactus_save_extra_category_fileds');
add_action( 'created_category', 'cactus_save_extra_category_fileds', 10, 2 );
function cactus_save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_header_background_height'])) {
        $cat_header_background_height = $_POST['cat_header_background_height'];
        update_option( "cat_header_background_height$term_id", $cat_header_background_height );
    }

    if ( isset( $_POST['page_background'])) {
        $page_background = $_POST['page_background'];
        update_option( "category_background_$term_id", $page_background );
    }

    if ( isset( $_POST[sanitize_key('cat_background_color')] ) ) {
        $cat_background_color = $_POST['cat_background_color'];
        update_option( "cat_background_color_$term_id", $cat_background_color );
    }

    if ( isset( $_POST['cat_background_repeat'] ) ) {
        $cat_background_repeat = $_POST['cat_background_repeat'];
        update_option( "cat_background_repeat_$term_id", $cat_background_repeat );
    }

    if ( isset( $_POST['cat_background_attachment'] ) ) {
        $cat_background_attachment = $_POST['cat_background_attachment'];
        update_option( "cat_background_attachment_$term_id", $cat_background_attachment );
    }

    if ( isset( $_POST['cat_background_position'] ) ) {
        $cat_background_position = $_POST['cat_background_position'];
        update_option( "cat_background_position_$term_id", $cat_background_position );
    }

    if ( isset( $_POST['cat_background_size'] ) ) {
        $cat_background_size = $_POST['cat_background_size'];
        update_option( "cat_background_size_$term_id", $cat_background_size );
    }

}