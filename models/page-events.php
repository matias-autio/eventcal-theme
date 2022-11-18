<?php
/**
 * Template Name: Page Events Template
 * Template Post Type: page
 */

class PageEvents extends MiddleModel {
    
    /**
     * Enable DustPress.js usage
     *
     * @var array
     */
    protected $api = [
        'Events',
        'UpcomingEvents'
    ];
    
    /**
     * Get all events.
     * This function also handles pagination.
     *
     * @return array|bool|WP_Query
     */

    public function Events() {

        $args = (array) $this->get_args();
        
        // Ajax requests set the page parameter.
        $page = isset( $args['page'] ) ? $args['page'] : 1;

        return $this->get_all_events( $page );
    }
    
    /**
     * Get upcoming events.
     * This function also handles pagination.
     *
     * @return array|bool|WP_Query
     */

    public function UpcomingEvents() {

        $args = (array) $this->get_args();
        
        // Ajax requests set the page parameter.
        $page = isset( $args['page'] ) ? $args['page'] : 1;

        return $this->get_upcoming_events( $page );
    }


}
?>