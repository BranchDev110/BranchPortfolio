<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package inbio
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */

if (!function_exists('rainbow_jetpack_setup')) {
function rainbow_jetpack_setup()
    {
        // Add theme support for Infinite Scroll.
        add_theme_support('infinite-scroll', array(
            'container' => 'main',
            'render' => 'rainbow_infinite_scroll_render',
            'footer' => 'page',
        ));

        // Add theme support for Responsive Videos.
        add_theme_support('jetpack-responsive-videos');

        // Add theme support for Content Options.
        add_theme_support('jetpack-content-options', array(
            'post-details' => array(
                'stylesheet' => 'inbio-style',
                'date' => '.posted-on',
                'categories' => '.cat-links',
                'tags' => '.tags-links',
                'author' => '.byline',
                'comment' => '.comments-link',
            ),
            'featured-images' => array(
                'archive' => true,
                'post' => true,
                'page' => true,
            ),
        ));
    }
}

add_action('after_setup_theme', 'rainbow_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
if (!function_exists('rainbow_infinite_scroll_render')) {
    function rainbow_infinite_scroll_render()
    {
        while (have_posts()) {
            the_post();
            if (is_search()) :
                get_template_part('template-parts/content', 'search');
            else :
                get_template_part('template-parts/content', get_post_type());
            endif;
        }
    }
}
