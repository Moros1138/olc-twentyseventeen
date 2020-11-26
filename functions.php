<?php

add_action( 'wp_enqueue_scripts', 'olc_twentyseventeen_theme_enqueue_styles' );

function olc_twentyseventeen_theme_enqueue_styles() {

    $theme = wp_get_theme();
    
    wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css', 
        array(),
        $theme->parent()->get('Version')
    );
    
    wp_enqueue_style( 'olc-twentyseventeen-style', get_stylesheet_uri(),
        array( 'twentyseventeen-style' ),
        $theme->get('Version')
    );
}

function olc_twentyseventeen_rating_widget()
{
    // TODO: check if the Rate My Post plugin is present
    
    $post_id = ( $post_id ) ? $post_id : get_the_id();
    $options = get_option( 'rmp_options' );
    $avg_rating = Rate_My_Post_Common::get_average_rating( $post_id );
    $vote_count = Rate_My_Post_Common::get_vote_count( $post_id );
    $visual_rating = Rate_My_Post_Public::get_visual_rating( $post_id, 'js-rmp-results-icon', true );
    $ajax_load = false;

    ob_start();
    ?>
    <div class="rmp-results-widget js-rmp-results-widget js-rmp-results-widget--<?php echo $post_id; ?> <?php echo ( $avg_rating ) ? '' : 'rmp-results-widget--not-rated'; ?>" data-post-id="<?php echo $post_id; ?>">
        <div class="rmp-results-widget__visual-rating">
            <?php echo $visual_rating; ?>
        </div>
        <div class="rmp-results-widget__avg-rating">
            <span class="js-rmp-avg-rating">
                <?php echo ( ! $ajax_load ) ? $avg_rating : ''; ?>
            </span>
        </div>
        <div class="rmp-results-widget__vote-count">
            (<span class="js-rmp-vote-count"><?php echo ( ! $ajax_load ) ? $vote_count : ''; ?></span>)
        </div>
    </div>
    <?php
    
    return str_replace("\n", "", ob_get_clean());
}

