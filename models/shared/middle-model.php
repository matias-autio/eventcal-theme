<?php
/**
 * A middle model is used to wrap redundant data binding.
 */

/**
 * Class MiddleModel
 */
class MiddleModel extends \DustPress\Model {

    /**
     * Binds submodules for all extending classes.
     */
    public function Submodules() {
        $this->bind_sub( 'Header' );
        $this->bind_sub( 'Footer' );
    }

    /**
     * A wrapper function for querying posts from all categories.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many posts to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_all_posts( $page = 0, $per_page = 0 ) {

        if ( 0 === $per_page ) {
            // Get the default posts count for queries
            $per_page = (int) get_option( 'posts_per_page' );
        }

        if ( $page > 0 ) {
            // Set the offset.
            $offset = ( $page - 1 ) * $per_page;
        } else {
            $offset = 0;
        }

        $args = [
            'post_type'                 => 'post',
            'posts_per_page'            => $per_page,
            'offset'                    => $offset,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_posts( $args );
    }

    /**
     * A wrapper function for querying posts from event post type.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many posts to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_all_events( $page = 0, $per_page = 0 ) {

        if ( 0 === $per_page ) {
            // Get the default posts count for queries
            $per_page = (int) get_option( 'posts_per_page' );
        }

        if ( $page > 0 ) {
            // Set the offset.
            $offset = ( $page - 1 ) * $per_page;
        } else {
            $offset = 0;
        }

        $args = [
            'post_type'                 => 'event',
            'orderby'                   => 'date',
            'order'                     => 'DESC',
            'posts_per_page'            => $per_page,
            'offset'                    => $offset,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_acf_posts( $args );
    }

    /**
     * A wrapper function for querying posts from event post type.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many posts to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_upcoming_events( $page = 0, $per_page = 0 ) {

        if ( 0 === $per_page ) {
            // Get the default posts count for queries
            $per_page = (int) get_option( 'posts_per_page' );
        }

        if ( $page > 0 ) {
            // Set the offset.
            $offset = ( $page - 1 ) * $per_page;
        } else {
            $offset = 0;
        }

        $args = [
            'post_type' => 'event',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => 'start_date',
                    'value' => date( 'Y-m-d' ),
                    'compare' => '>=',
                    'type' => 'DATE',
                ],
                [
                    'key' => 'end_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'DATE'
                ],
            ],
            'posts_per_page'            => $per_page,
            'offset'                    => $offset,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_acf_posts( $args );
    }
}