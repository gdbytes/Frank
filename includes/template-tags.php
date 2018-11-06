<?php
if ( ! function_exists( 'frank_time_link' ) ) :
    /**
     * Gets a nicely formatted string for the published date.
     */
    function frank_time_link() {
        $time_string = sprintf( '<time class="entry-date published" datetime="%1$s">%2$s</time>',
            get_the_date( DATE_W3C ),
            get_the_date()
        );

        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = sprintf( '<time class="entry-date updated" datetime="%1$s">%2$s</time>',
                get_the_modified_date( DATE_W3C ),
                get_the_modified_date()
            );
        }

        return $time_string;
    }
endif;

if ( ! function_exists( 'frank_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function frank_posted_on() {
        // Get the author name; wrap it in a link.
        $byline = sprintf(
            _x( 'by %s', 'post author', 'frank_theme' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
        );

        // Finally, let's write all of this to the page.
        echo '<span class="posted-on">' . frank_time_link() . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }
endif;

if ( ! function_exists( 'frank_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function frank_entry_footer() {
        /* translators: used between list items, there is a space after the comma */
        $separate_meta = __( ', ', 'frank_theme' );
        // Get Categories for posts.
        $categories_list = get_the_category_list( $separate_meta );
        // Get Tags for posts.
        $tags_list = get_the_tag_list( '', $separate_meta );
        // We don't want to output .entry-footer if it will be empty, so make sure its not.
        if ( ( ( frank_categorized_blog() && $categories_list ) || $tags_list ) ) {
            if ( 'post' === get_post_type() ) {
                if ( ( $categories_list && frank_categorized_blog() ) || $tags_list ) {
                    echo '<span class="cat-tags-links">';
                        // Make sure there's more than one category before displaying.
                        if ( $categories_list && frank_categorized_blog() ) {
                            echo '<span class="cat-links"><span class="screen-reader-text">' . __( 'Categories', 'frank_theme' ) . '</span>' . $categories_list . '</span>'; // WPCS: XSS OK.
                        }
                        if ( $tags_list ) {
                            echo '<span class="tags-links"><span class="screen-reader-text">' . __( 'Tags', 'frank_theme' ) . '</span>' . $tags_list . '</span>'; // WPCS: XSS OK.
                        }
                    echo '</span>';
                }
            }
        }
    }
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function frank_categorized_blog() {
    $category_count = get_transient( 'frank_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
        ) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );
		set_transient( 'frank_categories', $category_count );
    }

	return $category_count > 1;
}
