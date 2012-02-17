<?php
$direct_path = get_bloginfo('wpurl') . "/wp-content/plugins/featured-item-slider";
$height = get_option('content_height');
$bg = get_option('content_bg');
$width = get_option('content_width');
$img_width = get_option('content_img_width');
$content_nav_height = get_option('content_nav_height');
$content_nav_color = get_option('content_nav_color');
$content_nav_bg = get_option('content_nav_bg');
$nav_color = get_option('content_nav_active_color');
$content_nav_width = $width - $img_width - 70;
$nev_width = $width - $img_width;
$menu_width = $width - $img_width;
$img_offset = $width - $img_width - 50;
$content_height = $height/5;
?>

<style>

    #content-slideshow {
        width: <?php if (!empty($width)) {echo $width;} else {echo "570";}?>px;
        padding: 0px !important;
        background-color: #<?php if (!empty($bg)) {echo $bg;} else {echo "FFF";}?>;
        height: <?php if (!empty($height)) {echo $height;} else {echo "250";}?>px;
        overflow: hidden;
        border: 5px solid #CCC;
        position: relative;
    }

    #content-slideshow ul {
        background: transparent !important;
        margin: 0 !important;
        border: none !important;
        padding: 0 !important;
        list-style-type: none !important;
        position: relative;
    }

    #content-slideshow .content_slideshow ul {
        float: left;
        overflow: hidden;
        width: <?php if (!empty($img_width)) {echo $img_width;} else {echo "250";}?>px;
        margin: 0px !important;
        padding: 0px !important;
        height: <?php if (!empty($height)) {echo $height;} else {echo "250";}?>px;
        position: relative;
    }

    #content-slideshow .content_slideshow ul li {
        display: none;
        width: <?php if (!empty($img_width)) {echo $img_width;} else {echo "250";}?>px !important;
        height: <?php if (!empty($height)) {echo $height;} else {echo "250";}?>px !important;
        display: block;
        overflow: hidden;
        position: relative;
        top: 0px !important;
        left: 0px !important;
        float: left;
        margin: 0px !important;
        padding: 0px !important;
        z-index: 1;
    }

    #content-slideshow .content_slideshow ul li img {
        margin: 0px !important;
        padding: 0px !important;
        border: none !important;
        float: left;
        width: <?php if (!empty($img_width)) {echo $img_width;} else {echo "250";}?>px;
        position: absolute;
        top: 0px;
        height: <?php if (!empty($height)) {echo $height;} else {echo "250";}?>px;
    }

    #content-slideshow  ul.slideshow-nav {
        height: <?php if (!empty($height)) {echo $height;} else {echo "250";}?>px;
        width: <?php if (!empty($nev_width)) {echo $nev_width;} else {echo "250";}?>px;
        margin: 0;
        padding: 0;
        float: right;
        overflow: hidden;
    }

    #content-slideshow .slideshow-nav li {
        display: block;
        margin: 0;
        padding: 0;
        list-style-type: none;
        display: block;
    }

    .slideme {
        font-size: 6px;
        float: right;
    }

    .slideme a {
        font-size: 8px;
        text-decoration: none;
        color: #CCC;
    }

    #content-slideshow .slideshow-nav li {
        display: block;
        margin: 0px !important;
        float: left;
        padding: 0px !important;
    }

    #content-slideshow .slideshow-nav li a {
        width: <?php if (!empty($content_nav_width)) {echo $content_nav_width;} else {echo "250";}?>px !important;
        display: block;
        margin: 0;
        padding: 9px;
        list-style-type: none;
        display: block;
        height: <?php if (!empty($content_height)) {echo $content_height - 20;} else {echo 30;}?>px;
        color: #<?php if (!empty($content_nav_color)) {echo $content_nav_color;} else {echo "333";}?> !important;
        overflow: hidden;
        background-color: #<?php if (!empty($content_nav_bg)) {echo $content_nav_bg;} else {echo "EEE";}?>;
        font-size: 17px;
        font-weight: bold;
        border-bottom: 1px solid #CCC;
        line-height: 1.35em;
    }

    #content-slideshow .slideshow-nav li p {
        float: left;
        font-size: 12px;
        font-weight: normal;
        padding-top: 1px;
    }

    #content-slideshow .slideshow-nav li.on a {
        background-color: #CCC;
        color: #fff;
        width: 200px;
    }

    #content-slideshow .slideshow-nav li.clearfix a {

        width: <?php if (!empty($content_height)) {echo $content_height;} else {echo 50;}?>px;
        text-align: left;
    }

    #content-slideshow .slideshow-nav li a:hover,
    #content-slideshow .slideshow-nav li a:active {
        color: #<?php if (!empty($nav_color)) {echo $nav_color;} else {echo "FFF";}?>;
    }

    .slider-img {
        position: relative;
        left: <?php if (!empty($img_offset)) {echo $img_offset;} else {echo 50;}?>px;;
        top: -<?php if (!empty($content_height)) {echo $content_height;} else {echo 50;}?>px;
    }

    li.clearfix {
        height: <?php if (!empty($content_height)) {echo $content_height;} else {echo 50;}?>px !important;
    }

</style>


<div id="content-slideshow">

    <div class="content_slideshow">

        <ul>

            <?php
            global $wpdb;

            $counting = 1;

            $querystr = "
				SELECT wposts.* 
				FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
				WHERE wposts.ID = wpostmeta.post_id 
				AND wpostmeta.meta_key = 'content_slider'
				AND wpostmeta.meta_value = '1' 
				AND wposts.post_status = 'publish' 
				AND (wposts.post_type = 'post' OR wposts.post_type = 'page')";

            $pageposts = $wpdb->get_results($querystr, OBJECT); ?>

            <?php if ($pageposts): ?>

            <?php global $post; ?>

            <?php foreach ($pageposts as $post): ?>

                <?php $do_not_duplicate[$post->ID] = $post->ID; ?>

                <?php setup_postdata($post);

                $custom = get_post_custom($post->ID);

                $thumb = get_generated_thumb("content_slider");

                ?>

                <li id="main-post-<?php echo $counting;?>" onclick="location.href='<?php the_permalink(); ?>';"
                    title="<?php _e("Permanent Link to"); ?> <?php the_title(); ?>">
                    <img src="<?php echo $thumb;?>" height="<?php if (!empty($height)) {echo $height;} else {echo
                    "250";}?>px" width="<?php if (!empty($img_width)) {echo $img_width;} else {echo "250";}?>px" />
                </li>

                <?php

                $counting = $counting + 1;

            endforeach; ?>

            <?php endif; ?>

        </ul>

    </div>

    <ul class="slideshow-nav">

        <?php
        global $wpdb;

        $counting = 1;

        $querystr = "
				SELECT wposts.* 
				FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
				WHERE wposts.ID = wpostmeta.post_id 
				AND wpostmeta.meta_key = 'content_slider' 
				AND wpostmeta.meta_value = '1' 
				AND wposts.post_status = 'publish' 
				AND (wposts.post_type = 'post' OR wposts.post_type = 'page')";

        $pageposts = $wpdb->get_results($querystr, OBJECT); ?>

        <?php if ($pageposts): ?>

        <?php global $post; ?>

        <?php foreach ($pageposts as $post): ?>

            <?php $do_not_duplicate[$post->ID] = $post->ID; ?>

            <?php setup_postdata($post);

            $custom = get_post_custom($post->ID);

            $thumb = get_generated_thumb("tamp");

            ?>
            <?php if ($counting == 1) { ?>
                <li class="on clearfix" id="post-<?php echo $counting; ?>">
                    <a href="#main-post-<?php echo $counting; ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?><br/>
                        <?php $excerpt = get_the_excerpt();?>
                        <p><?php echo cut_content_feat($excerpt, 25, "..."); ?> </p>
                    </a>
                    <img class="slider-img" src="<?php echo $thumb;?>" height="<?php if (!empty($content_height))
                    {echo $content_height;} else {echo 50;}?>px" width="50"/>
                </li>
                <?php } else { ?>
                <li id="post-<?php echo $counting; ?>" class="clearfix">
                    <a href="#main-post-<?php echo $counting; ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?><br/>
                        <?php $excerpt = get_the_excerpt();?>
                        <p><?php echo cut_content_feat($excerpt, 25, "..."); ?> </p>
                    </a>
                    <img class="slider-img" src="<?php echo $thumb;?>" height="<?php if (!empty($content_height))
                    {echo $content_height;} else {echo 50;}?>px" width="50"/>
                </li>
                <?php } ?>
            <?php

            $counting = $counting + 1;

        endforeach; ?>

        <?php endif; ?>

    </ul>

</div>
        


