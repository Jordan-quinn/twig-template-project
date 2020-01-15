<?php

/**
 * PHP Version 5.2
 *
 * @category   Theme
 * @package    OLWPT
 * @subpackage Core
 * @author     Jordan Quinn <jordan@orangeleaf.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link       http://support.orangeleaf.com
 */
require_once 'custom-fields.php';

/*
 * Add action ol_events_init for registration of post type
 */
add_action('init', 'events_init');

/*
 * Set up new Events post type
 */
function events_init()
{
     $labels = array(
        "name" => "Events",
        "singular_name" => "Event",
        "menu_name" => "Events",
        "all_items" => "All Events",
        "add_new" => "Add Event",
        "add_new_item" => "Add New Event",
        "edit" => "Edit",
        "edit_item" => "Edit Event",
        "new_item" => "New Event",
        "view" => "View",
        "view_item" => "View Event",
        "search_items" => "Search Events",
        "not_found" => "No Events Found",
        "not_found_in_trash" => "No Events Found in Trash",
        "parent" => "Parent Event",
    );
    $args = array(
        "labels" => $labels,
        "description" => "Shropshire Events",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "events", "with_front" => true ),
        "query_var" => true,
        "menu_icon" => "dashicons-tickets-alt",
        "supports" => array( "title", "editor", "thumbnail" ),
    );
    register_post_type( "events", $args );
}

/*
 * Generate search filtering form
 *
 * @return form
 */
function events_filtering()
{
    $form = '<form id="event_form" class="form-wrap" action="/events-2/" method="GET">';

    // array of fields for dropdown selectors (seperate from Dates filtering, as they require date picker js)
    $keys = array(
        'location' => 'field_5c792d239c4e0',
        'type' => 'field_5c7e8fa50ee6d',
    );

    $dates = array(
        'date from' => 'field_5c7929c679eba',
        'date to' => 'field_5c7929de79ebb'
    );

    foreach($keys as $k=>$v) {
        $filters.= '<div class="filter_'.$k.'"><label for="event'.$k.'">'.ucfirst($k).'</label><select id="event'.$k.'" name="'.$k.'">';

        $field_key = $v;
        $field = get_field_object($field_key);

        $filters.= '<option value="select">-- Select --</option>';
        foreach($field['choices'] as $k=>$v)
        {
            $filters.= '<option value="'.$k.'">' . $v . '</option>';
        }
        $filters.= '</select></div>';
    }

    foreach($dates as $k=>$v) {
        $filters.= '
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
              $( ".datepicker" ).datepicker({dateFormat: "yymmdd"});
            } );
            </script>';
        $filters.= '<div class="filter_'.$k.'"><label for="event'.$k.'">'.ucfirst($k).'</label>';
        $filters.= '<input type="text" class="datepicker" autocomplete="off" name="'.str_replace(' ', '_', $k).'"></div>';
    }

    $form.= $filters;
    $form.= '<button class="button" type="submit" id="event_btn">Search</button>';
    $form.= '<button class="button" type="reset" id="event_btn">Reset</button>';
    $form.= '</form>';

    return $form;
}

add_shortcode('events', 'events');

/*
* Generate posts and grab files and permalinks
*/
function events($atts)
{
    $events = get_posts([
        'post_type' => 'events',
        'post_status' => 'publish',
        'numberposts' => 10,
        'order'    => 'ASC',
    ]);
    $a = shortcode_atts( array(
        'cat' => false,
        'list' => false,
        'odd' => false
    ), $atts );

    $cat = false;
    $list = false;
    $odd = '';
    if(isset($atts['cat'])) {
        $cat = 'odd';
    }

    if(isset($atts['list'])) {
        $list = true;
        $event_list_class = 'list';
    }

    if(isset($atts['odd'])) {
        $odd = 'odd';
    }

    echo '<section class="content '.$event_list_class.' '.$odd.'"><div class="wrap">';
    if(!$list) {
        echo '<h3>What\'s on</h3>';
    } else {
        echo events_filtering();
    }

    // No events displayed
    $no_events = '';

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
    $type = '';
    $location = '';
    $date_from = '';
    $date_to = '';
    if($_GET['location'] && $_GET['location'] !== 'select') {
        $location = array(
            'key'   => 'select_a_category',
            'value' => $_GET['location'],
            'compare'    => '=',
        );
    }

    if($_GET['type'] && $_GET['type'] !== 'select') {
        $type = array(
            'key'   => 'type',
            'value' => $_GET['type'],
            'compare'    => '=',
        );
    }

    if($_GET['date_from']) {
        $date_from = array(
            'key'   => 'from',
            'value' => $_GET['date_from'],
            'compare'    => '=',
        );
    }

    if($_GET['date_to']) {
        $date_to = array(
            'key'   => 'to',
            'value' => $_GET['date_to'],
            'compare'    => '=',
        );
    }

    $args = array (
        'nopaging'               => false,
        'paged'                  => $paged,
        'posts_per_page'         => '5',
        'post_type'              => 'events',
        'meta_query'     => array(
            'relation' => 'AND',
            $location,
            $type,
            $date_from,
            $date_to
        ),
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $fields = get_fields(get_the_ID());

            //sort date display
            $date_from = $fields['from'];
            $date_to = $fields['to'];

            $time_stamp = 'All Day Event';
            if(!$fields['all_day'] && $fields['time_from']) {
                $time_stamp = $fields['time_from'].' - '.$fields['time_to'];
            }

            $tsf = date("D j M, Y", strtotime($date_from));
            $tst = date("D j M, Y", strtotime($date_to));

            if($tst) {
                if($tsf === $tst || !$tst) {
                    $stamp = $tsf;
                } else {
                    $stamp = $tsf.' - '.$tst;
                }
            } else {
                $stamp = $tsf;
            }

            $class = 'no-thumb';
            $feat = '';
            $feat_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            if(get_the_post_thumbnail()) {
               $class = 'with-thumb';
               $feat = '<div class="feat-thumb"><img src="'.$feat_img.'" alt="'.get_the_title().' event thumbnail'.'"></div>';
            }

            $list = '';
            $list.= '<div class="grid-24 event_item '.$event_list_class.' '.$fields['select_a_category'].'"><div class="feat-content '.$class.'">';
            $list.= '<span class="date">'.$stamp.'</span>';
            $list.= '<h2 class="event_title">'.get_the_title().'</h2>';
            $list.= '<span class="location">'.$fields['location'][0].'</span>';
            $list.= '<span class="date time">'.$time_stamp.'</span>';
            $list.= '<span class="type">'.$fields['type'].'</span>';
            $list.= '<p>'.mb_strimwidth(get_the_content(),0,255,'...').'</p></div>';
            $list.= $feat;
            $list.= '<a class="button" href="'.get_the_permalink().'">View Details</a>';
            $list.= '</div>';

            if (isset($atts['list'])) {
                echo $list;
            } elseif ($cat && $fields['select_a_category'] === $atts['cat']) {
                echo $list;
            }
        }

        previous_posts_link( 'Previous' );

        if (isset($atts['list'])) {
            next_posts_link( 'View More Events', $query->max_num_pages );
        } else {
            echo '<a href="/events/" class="button events-pagi next">View More Events</a>';
        }

    } else {
        // no posts found
        echo '<script>notification(\'There are no events found from your search.\', \'alert\', \'#notifications\', {closeWith:false});</script>';
    }

    // Restore original Post Data
    wp_reset_postdata();

    echo '</div></section>';
}

/*
 * Generate custom class attributes for events previous button
 */
function posts_link_attributes_prev() {
    return 'class="button events-pagi prev"';
}
add_filter('previous_posts_link_attributes', 'posts_link_attributes_prev');

/*
 * Generate custom class attributes for events next button
 */
function posts_link_attributes_next() {
    return 'class="button events-pagi next"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');