<?php
/*
Template name: Single Event
*/

class SingleEvent extends \DustPress\Model {
     /**
     * Get single event.
     *
     * @return array|null|WP_Post
     */

     
    public function Event() {
        return \DustPress\Query::get_acf_post( get_the_ID());
    }
}
?>