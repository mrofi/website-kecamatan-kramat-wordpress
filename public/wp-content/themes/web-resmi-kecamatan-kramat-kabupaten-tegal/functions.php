<?php
/**
 * Functions - Child theme custom functions
 */


/*****************************************************************************************************************
Caution: do not remove this or you will lose all the customization capabilities created by Divi Children plugin */
require_once('divi-children-engine/divi_children_engine.php');
/****************************************************************************************************************/


/**
 * Patch to fix Divi issue: Duplicated Predefined Layouts.
 */
remove_action( 'admin_init', 'et_pb_update_predefined_layouts' );
function Divichild_pb_update_predefined_layouts() {
		if ( 'on' === get_theme_mod( 'et_pb_predefined_layouts_updated_2_0' ) ) {
			return;
		}
		if ( ! get_theme_mod( 'et_pb_predefined_layouts_added' ) OR ( 'on' === get_theme_mod( 'et_pb_predefined_layouts_added' ) )) {
			et_pb_delete_predefined_layouts();
		}
		et_pb_add_predefined_layouts();
		set_theme_mod( 'et_pb_predefined_layouts_updated_2_0', 'on' );
}
add_action( 'admin_init', 'Divichild_pb_update_predefined_layouts' );

function Divichild_script_fix()
{
    wp_dequeue_script( 'divi-custom-script' );
    wp_enqueue_script( 'divi-custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'Divichild_script_fix' );

// edit blog module

function override_parent() {
    remove_shortcode( 'et_pb_blog' );
    add_shortcode( 'et_pb_blog', 'et_pb_blog_custom' );

    // global $wp_filter;
    // echo '<pre>';
    // print_r($wp_filter);
    // echo '</pre>';
    // exit();

    // global $shortcode_tags;
    // echo '<pre>';
    // print_r($shortcode_tags);
    // echo '</pre>';
    // exit();
}
add_action('get_header','override_parent');

function et_pb_blog_custom( $atts ) {

    extract( shortcode_atts( array(
            'module_id' => '',
            'module_class' => '',
            'fullwidth' => 'on',
            'posts_number' => 10,
            'include_categories' => '',
            'meta_date' => 'M j, Y',
            'show_thumbnail' => 'on',
            'show_content' => 'off',
            'show_author' => 'on',
            'show_date' => 'on',
            'show_categories' => 'on',
            'show_pagination' => 'on',
            'offset_number' => 0,
            'background_layout' => 'light',
            'show_more' => 'off',
        ), $atts
    ) );

    global $paged;

        $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

        $container_is_closed = false;

        if ( '' !== $masonry_tile_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%%.et_pb_blog_grid .et_pb_post',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    esc_html( $masonry_tile_background_color )
                ),
            ) );
        }

        if ( 'on' !== $fullwidth ){
            if ( 'on' === $use_dropshadow ) {
                $module_class .= ' et_pb_blog_grid_dropshadow';
            }

            wp_enqueue_script( 'salvattore' );

            $background_layout = 'light';
        }

        $args = array( 'posts_per_page' => (int) $posts_number );

        $et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

        if ( is_front_page() ) {
            $paged = $et_paged;
        }

        if ( '' !== $include_categories )
            $args['cat'] = $include_categories;

        if ( ! is_search() ) {
            $args['paged'] = $et_paged;
        }

        if ( '' !== $offset_number && ! empty( $offset_number ) ) {
            /**
             * Offset + pagination don't play well. Manual offset calculation required
             * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
             */
            if ( $paged > 1 ) {
                $args['offset'] = ( ( $et_paged - 1 ) * intval( $posts_number ) ) + intval( $offset_number );
            } else {
                $args['offset'] = intval( $offset_number );
            }
        }

        if ( is_single() && ! isset( $args['post__not_in'] ) ) {
            $args['post__not_in'] = array( get_the_ID() );
        }

        ob_start();

        query_posts( $args );

        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();

                $post_format = et_pb_post_format();

                $thumb = '';

                $width = 'on' === $fullwidth ? 1080 : 400;
                $width = (int) apply_filters( 'et_pb_blog_image_width', $width );

                $height = 'on' === $fullwidth ? 675 : 250;
                $height = (int) apply_filters( 'et_pb_blog_image_height', $height );
                $classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
                $titletext = get_the_title();
                $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
                $thumb = $thumbnail["thumb"];

                $no_thumb_class = '' === $thumb || 'off' === $show_thumbnail ? ' et_pb_no_thumb' : '';

                if ( in_array( $post_format, array( 'video', 'gallery' ) ) ) {
                    $no_thumb_class = '';
                } ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' . $no_thumb_class ); ?>>

            <?php
                et_divi_post_format_content();

                if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
                    if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
                        printf(
                            '<div class="et_main_video_container">
                                %1$s
                            </div>',
                            $first_video
                        );
                    elseif ( 'gallery' === $post_format ) :
                        et_gallery_images();
                    elseif ( '' !== $thumb && 'on' === $show_thumbnail ) :
                        if ( 'on' !== $fullwidth ) echo '<div class="et_pb_image_container">'; ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
                            </a>
                    <?php
                        if ( 'on' !== $fullwidth ) echo '</div> <!-- .et_pb_image_container -->';
                    endif;
                } ?>

            <?php if ( 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ) ) ) { ?>
                <?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) { ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php } ?>

                <?php
                    if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories ) {
                        printf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s</p>',
                            (
                                'on' === $show_author
                                    ? sprintf( __( 'by %s', 'et_builder' ), et_pb_get_the_author_posts_link() )
                                    : ''
                            ),
                            (
                                ( 'on' === $show_author && 'on' === $show_date )
                                    ? ' | '
                                    : ''
                            ),
                            (
                                'on' === $show_date
                                    ? sprintf( __( '%s', 'et_builder' ), get_the_date( $meta_date ) )
                                    : ''
                            ),
                            (
                                (( 'on' === $show_author || 'on' === $show_date ) && 'on' === $show_categories)
                                    ? ' | '
                                    : ''
                            ),
                            (
                                'on' === $show_categories
                                    ? get_the_category_list(', ')
                                    : ''
                            )
                        );
                    }

                if (strpos($module_class, 'no-body') === false) {

                    echo '<div class="body-post">';

                    if ( ! has_shortcode( get_the_content(), 'et_pb_blog' ) ) {
                        if ( 'on' === $show_content ) {
                            global $more;
                            $more = null;

                            the_content( __( 'read more...', 'et_builder' ) );
                        } else {
                            if ( has_excerpt() ) {
                                the_excerpt();
                            } else {
                                truncate_post( 270 );
                            }
                            $more = 'on' == $show_more ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink() ), __( 'read more', 'et_builder' ) )  : '';
                            echo $more;
                        }
                    } else if ( has_excerpt() ) {
                        the_excerpt();
                    }

                    echo '</div>';

                }
                    ?>
            <?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>

            </article> <!-- .et_pb_post -->
    <?php
            } // endwhile

            if ( 'on' === $show_pagination && ! is_search() ) {
                echo '</div> <!-- .et_pb_posts -->';

                $container_is_closed = true;

                if ( function_exists( 'wp_pagenavi' ) )
                    wp_pagenavi();
                else
                    get_template_part( 'includes/navigation', 'index' );
            }

            wp_reset_query();
        } else {
            get_template_part( 'includes/no-results', 'index' );
        }

        $posts = ob_get_contents();

        ob_end_clean();

        $class = " et_pb_module et_pb_bg_layout_{$background_layout}";

        $output = sprintf(
            '<div%5$s class="%1$s%3$s%6$s"%7$s>
                %2$s
            %4$s',
            ( 'on' === $fullwidth ? 'et_pb_posts' : 'et_pb_blog_grid clearfix' ),
            $posts,
            esc_attr( $class ),
            ( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
            ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
            ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
            ( 'on' !== $fullwidth ? ' data-columns' : '' )
        );

        if ( 'on' !== $fullwidth )
            $output = sprintf( '<div class="et_pb_blog_grid_wrapper">%1$s</div>', $output );

        return $output;
}

// highlight active custom post page in nav
add_filter( 'nav_menu_css_class', 'namespace_menu_classes', 10, 2 );
function namespace_menu_classes( $classes , $item ){
    if ( get_post_type() == 'project' || get_post_type() == 'post') {
        // find the url you want and add the class you want
        if ( strstr(get_permalink(), $item->url) ) array_push($classes, 'current-menu-item');
    }
    return $classes;
}

// add shortcode to display menu
// [menu name="-your menu name-" class="-your class-"]
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');

?>