<?php
/**
 * Template Name: Page Events Template
 * Template Post Type: page
 */

class PageEvents extends \DustPress\Model {
    /**
     * Get all events.
     *
     * @return array|null|WP_Post
     */

    public function Events() {
        return \DustPress\Query::get_acf_posts( [
            'post_type' => 'event',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        ] );
    }

    /**
     * Get upcoming events.
     * 
     * @return array|null|WP_Post
     */
    
    public function UpcomingEvents() {
        return \DustPress\Query::get_acf_posts( [
            'post_type' => 'event',
            'posts_per_page' => -1,
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
        ] );
    }
}
?>