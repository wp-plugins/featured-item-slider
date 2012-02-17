<?php
$location = $options_page; // Form Action URI
?>

<div class="wrap">
	<h2>Featured Item Slider</h2>
	<p>Change the height and width, all the other dimension will be changed automatically. Also you can change the
        colors.</p>
	
    <div style="margin-left:0px;">
    <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
		        <div class="inside">
		<table class="form-table">
			<tr>
				<th><label for="content_width">Slideshow Width (px)</label></th>
				<td><input type="text" name="content_width" value="<?php $width = get_option('content_width'); if(!empty($width)) {echo $width;} else {echo "570";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_height">Slideshow Height (px)</label></th>
				<td><input type="text" name="content_height" value="<?php $height = get_option('content_height'); if(!empty($height)) {echo $height;} else {echo "250";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_bg">BG Color (hexadecimal)</label></th>
				<td><input type="text" name="content_bg" value="<?php $bg = get_option('content_bg'); if(!empty($bg)) {echo $bg;} else {echo "FFF";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_img_width">Image Width (px)</label></th>
				<td><input type="text" name="content_img_width" value="<?php $img_width = get_option('content_img_width'); if(!empty($img_width)) {echo $img_width;} else {echo "300";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_img_height">Image Height (px)</label></th>
				<td><input type="text" name="content_img_height" value="<?php $height = get_option('content_height'); if(!empty($height)) {echo $height;} else {echo "250";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_nav_bg">Navigation Background Color (hexadecimal)</label></th>
				<td><input type="text" name="content_nav_bg" value="<?php $content_nav_bg = get_option('content_nav_bg'); if(!empty($content_nav_bg)) {echo $content_nav_bg;} else {echo "EEE";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_nav_color">Navigation Color (hexadecimal)</label></th>
				<td><input type="text" name="content_nav_color" value="<?php $content_nav_color = get_option('content_nav_color'); if(!empty($content_nav_color)) {echo $content_nav_color;} else {echo "333";}?>"></td>
			</tr>
			<tr>
				<th><label for="content_nav_active_color">Navigation Hover Color (hexadecimal)</label></th>
				<td><input type="text" name="content_nav_active_color" value="<?php $nav_color = get_option('content_nav_active_color'); if(!empty($nav_color)) {echo $nav_color;} else {echo "FFF";}?>"></td>
			</tr>
		</table>
	</div>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="content_width, content_height, content_bg, content_img_width, content_img_height, content_nav_width, content_nav_height, content_nav_bg, content_nav_color, content_nav_active_color" />
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Reconfig') ?>" /></p>
	</form>      
</div>