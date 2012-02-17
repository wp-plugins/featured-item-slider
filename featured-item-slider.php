<?php
/**
 * @package featured-item-slider
 */
/*
Plugin Name: featured item slider
Plugin URI: http://freelancegateway.com/featured-item-slider/
Description: Show five feature item (post or page) with a auto slider and Thumb and big piture any where you want.
Version: 1.0
Author: Md. Ariful Hauqe Khan
Author URI: https://www.odesk.com/users/~~2a74c2501f566118
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* options page */

$options_page = get_option('siteurl') . '/wp-admin/admin.php?page=featured-item-slider/options.php';
function featured_options_page()
{
    add_options_page('Featured Item Slider Options', 'Featured Item Slider', 10, 'featured-item-slider/options.php');
}


function add_content_scripts()
{
    if (!is_admin()) {
        wp_register_script('jquery.cycle', get_bloginfo('url') . '/wp-content/plugins/featured-item-slider/scripts/jquery.cycle.all.2.72.js', array('jquery'), '1.3');
        wp_enqueue_script('jquery.cycle');
        wp_register_script('jquery.slideshow', get_bloginfo('url') . '/wp-content/plugins/featured-item-slider/scripts/slideshow.js', array('jquery'), '1.3');
        wp_enqueue_script('jquery.slideshow');
    }
}


function cut_content_feat($text, $chars, $points = "...")
{
    $length = strlen($text);
    if ($length <= $chars) {
        return $text;
    } else {
        return substr($text, 0, $chars) . " " . $points;
    }
}


function content_init()
{
    add_meta_box("item_slider", "Featured Item Slider", "content_meta", "post", "normal", "high");
    add_meta_box("item_slider", "Featured Item Slider", "content_meta", "page", "normal", "high");
}

function content_meta()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $content_slider = $custom["content_slider"][0];
    ?>
<div class="inside">
    <table class="form-table">
        <tr>
            <th><label for="content_slider">Feature in Featured Item Slider?</label></th>
            <td><input type="checkbox" name="content_slider" value="1" <?php if ($content_slider == 1) {
                echo "checked='checked'";
            } ?></td>
        </tr>
    </table>
</div>
<?php
}

function save_content()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    global $post;
    if ($post->post_type == "post" || $post->post_type == "page") {
        update_post_meta($post->ID, "content_slider", $_POST["content_slider"]);
    }
}

function insert_content($atts, $content = null)
{
    include (ABSPATH . '/wp-content/plugins/featured-item-slider/content-slideshow.php');
}


if (empty($img_width)) {
    $img_width = 200;
}

$img_height = get_option('content_height');

if (empty($img_height)) {
    $img_height = 250;
}

if (function_exists('add_image_size')) {
    add_image_size('content_slider', $img_width, $img_height, true);

}

if (function_exists('add_image_size')) {
    add_image_size('post', 400, 200, true);
}

if (function_exists('add_image_size')) {
    add_image_size('tamp', 50, 50, true);
}

function get_generated_thumb($position)
{
    $thumb = get_the_post_thumbnail($post_id, $position);
    $thumb = explode("\"", $thumb);
    return $thumb[5];
}

//Check for Post Thumbnail Support

add_action('admin_menu', 'featured_options_page');
add_action('wp_enqueue_scripts', 'add_content_scripts');
add_action("admin_init", "content_init");
add_action('save_post', 'save_content');
add_shortcode("itemslider", "insert_content");
$img_width = get_option('content_img_width');
add_theme_support('post-thumbnails');

?>
