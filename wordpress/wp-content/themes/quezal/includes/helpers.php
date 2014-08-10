<?php
/**
 * Helper Functions
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 *
 */
 ?>
<?php
if ( ! function_exists( 'tcsn_post_nav' ) ) :
/**
 * Navigation : next/previous post
 *
 */
function tcsn_post_nav() {
	global $post;
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous )
		return;
	?>

<nav class="navigation post-navigation" role="navigation">
    <ul class="pager">
        <li class="previous">
            <?php previous_post_link( '%link', _x( '<span class="prev-arrow"><i class="icon-arrow-left12"></i></span>', 'Previous post link', 'tcsn_theme' ) ); ?>
        </li>
        <li class="next">
            <?php next_post_link( '%link', _x( '<span class="next-arrow"><i class="icon-arrow-right12"></i></span>', 'Next post link', 'tcsn_theme' ) ); ?>
        </li>
    </ul>
</nav>
<!-- .post-navigation -->
<?php
}
endif;


if ( ! function_exists( 'tcsn_paging_nav' ) ) :
/**
 * Navigation : next/previous set of posts
 *
 */
function tcsn_paging_nav() {
	global $wp_query;
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
<nav class="navigation post-navigation" role="navigation">
    <ul class="pager">
        <?php if ( get_next_posts_link() ) : ?>
        <li class="previous">
            <?php next_posts_link( __( '<span class="prev-arrow"><i class="icon-arrow-left12"></i></span>', 'tcsn_theme' ) ); ?>
        </li>
        <?php endif; ?>
        <?php if ( get_previous_posts_link() ) : ?>
        <li class="next">
            <?php previous_posts_link( __( '<span class="next-arrow"><i class="icon-arrow-right12"></i></span>', 'tcsn_theme ' ) ); ?>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<!-- .navigation -->
<?php
}
endif;

if ( ! function_exists( 'tcsn_add_thumb_column' ) ) :
/**
 * Thumbnails to Post/Page Management Screens
 *
 */
function tcsn_add_thumb_column( $cols ) {
	$cols['thumbnail'] = __('Thumbnail', 'tcsn_theme' );
	return $cols;
}

function tcsn_add_thumb_value( $column_name, $post_id ) {

		$thumb_width = (int) 60;
		$thumb_height = (int) 60;

		if ( 'thumbnail' == $column_name ) {
			// thumbnail 
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array( 
				'post_parent'    => $post_id,
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
			) );
			
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array( $thumb_width, $thumb_height ), true );
			}
			elseif ( $attachments ) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($thumb_width, $thumb_height ), true );
				}
			}
				if ( isset( $thumb ) && $thumb ) {
					echo $thumb;
				} else {
					echo __( 'No thumb', 'tcsn_theme' );
				}
		}
}
endif;

    // for posts
    add_filter( 'manage_posts_columns', 'tcsn_add_thumb_column' );
    add_action( 'manage_posts_custom_column', 'tcsn_add_thumb_value', 10, 2 );

    // for pages
    add_filter( 'manage_pages_columns', 'tcsn_add_thumb_column' );
    add_action( 'manage_pages_custom_column', 'tcsn_add_thumb_value', 10, 2 );

if ( ! function_exists( 'tcsn_pagination' ) ) :
/**
 * Pagination : For custom post type - Portfolio
 *
 */
function tcsn_pagination( $pages = '', $range = 2 ) {  

     $showitems = ( $range * 2 )+1;  

     global $paged;
     if( empty( $paged ) ) $paged = 1;

     if( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if( !$pages ) {
             $pages = 1;
         }
     }   

     if( 1 != $pages ) {
		 
         echo "<div class='pagination-folio-page'>";
		 
         if( $paged > 1 ) {
         	echo "<a class='prev-folio-page' href='".get_pagenum_link($paged - 1)."'><span class='prev-arrow'><i class='icon-arrow-left9'></i></span></a>";
         }

         for ( $i=1; $i <= $pages; $i++ ) {
			 
             if ( 1 != $pages &&( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
                 echo ( $paged == $i )? "<span class='current-folio-page'>".$i."</span>":"<a href='".get_pagenum_link( $i )."' class='inactive-folio-page' >".$i."</a>";
             }
         }
		 
         if ( $paged < $pages ) {
		 echo "<a class='next-folio-page' href='".get_pagenum_link( $paged + 1 )."'><span class='next-arrow'><i class='icon-arrow-right9'></i></span></a>"; 
	     }
		 
         echo "</div>\n";
     }
}
endif;

/**
 * Filter posts by format
 *
 */
function tcsn_admin_posts_filter( &$query ) {
    global $pagenow;
    if ( is_admin() && $pagenow == 'edit.php' && isset($_GET['p_format']) && $_GET['p_format'] != '-1' ) {
		$query->query_vars['tax_query'] = array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'ID',
				'terms'    => array(
					$_GET['p_format']
				)
			) 
		);
    }
}

function tcsn_restrict_manage_posts() {
    wp_dropdown_categories( array(
		'taxonomy'         => 'post_format',
		'hide_empty'       => 0,
		'name'             => 'p_format',
		'show_option_none' => 'View Post Formats',
	) );
}
add_filter( 'parse_query', 'tcsn_admin_posts_filter' );
add_action( 'restrict_manage_posts', 'tcsn_restrict_manage_posts' );

/**
 * Check if a post is a custom post type.
 *
 */
function is_custom_post_type( $post = NULL )
{
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;

    return in_array( $current_post_type, $custom_types );
}

/**
 * Modify archive widget 
 *
 */
function archive_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post-count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('get_archives_link', 'archive_postcount_filter');

/**
 * Modify category widget 
 *
 */
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post-count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','categories_postcount_filter');

/**
 * Arrows for menu dropdown
 */
class TCSN_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
		
		if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent != 0) { 
            $element->title =  $element->title . '<span class="sf-sub-indicator"><i class="icon-arrow-right13 menu-arrow"></i></span>'; 
        }

        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}


/**
 * Flush rewrite rules for custom post types on theme activation
 */
add_action( 'after_switch_theme', 'tcsn_rewrite_rules_flush' );
function tcsn_rewrite_rules_flush() {
     flush_rewrite_rules();
}
