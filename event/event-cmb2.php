<?php
/*
 *  UCFBands Theme Functionality
 *  CPT: Event
 *
 *  @author Jordan Pakrosnis
*/


/**
 * UCFBands CPT: Event CMB
 * Register Event CMB
 *
 * @author Jordan Pakrosnis
 */
function ucfbands_event_metabox() {
	$prefix = '_ucfbands_event_';

    // Initialize
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Event Details', 'cmb' ),
        'object_types'  => array( 'ucfbands_event' ),
        'context'       => 'normal',
        'priority'      => 'core',
    ) );

    // All-Day Event
    $cmb->add_field( array(
        'name' => 'All-Day Event',
        'desc' => 'Displays "Daily" instead of the start/end time or "TBA"',
        'id'   => $prefix . 'is_all_day_event',
        'type' => 'checkbox'
    ) );

    // Start Date & Time
    $cmb->add_field( array(
        'name' => 'Start Date/Time',
        'desc' => 'Both <b>Date and Time</b> are required for proper display of event.',
        'id'   => $prefix . 'start_date_time',
        'type' => 'text_datetime_timestamp',
    ) );

    // Finish Date & Time
    $cmb->add_field( array(
        'name' => 'Finish Date/Time',
        'desc' => 'Both <b>Date and Time</b> are required for proper display of event.',
        'id'   => $prefix . 'finish_date_time',
        'type' => 'text_datetime_timestamp',
    ) );

    // Time TBA
    $cmb->add_field( array(
        'name' => 'Time TBA',
        'desc' => 'Displays "TBA" instead of start time.',
        'id'   => $prefix . 'is_time_tba',
        'type' => 'checkbox'
    ) );

    // Show End Time
    $cmb->add_field( array(
        'name' => 'Show Finish Time',
        'desc' => 'If the event has a close estimated finish or definite finish time, check this.',
        'id'   => $prefix . 'show_finish_time',
        'type' => 'checkbox'
    ) );

	// Location
	$cmb->add_field( array(
	    'name'        => __( 'Location<br><small><i>Requires the <a href="https://github.com/WebDevStudios/CMB2-Post-Search-field" target="_BLANK">CMB2 Post Search Field Plugin</a></i>.</small>' ),
	    'id'          => $prefix . 'location',
	    'type'        => 'post_search_text', // This field type
	    // post type also as array
	    'post_type'   => 'ucfbands_location',
	    // Default is 'checkbox', used in the modal view to select the post type
	    'select_type' => 'radio',
	    // Will replace any selection with selection from modal. Default is 'add'
	    'select_behavior' => 'replace',
		'description' => '<b>LEAVE EMPTY FOR "TBA"</b>. Click search icon, then find the location. The location\'s ID will be entered.',
	) );

    // Admission Price
    $cmb->add_field( array(
        'name' => 'Admission/Ticket Price',
        'desc' => '<b>Set to "0.01" for Free Admission</b>. Leave empty or set to 0 to not show anything.',
        'id' => $prefix . 'ticket_price',
        'type' => 'text_money',
        // 'before_field' => '£', // Replaces default '$'
    ) );

    // Ticket Sales Link
    $cmb->add_field( array(
        'name' => 'Ticket Sales Link',
        'id' => $prefix . 'ticket_link',
        'type' => 'text',
    ) );

    // Icon Background Color
    $cmb->add_field( array(
        'name'             => 'Icon Background Color',
        'id'               => $prefix. 'icon_background_color',
        'type'             => 'radio',
        'default' => 'ucf-gray',
        'options' => array(
            'ucf-gray'	=> __( '<b>Concert Ensemble</b> (Dark Gray)', 'cmb' ),
            'gold'   	=> __( '<b>Athletic</b> (Gold)', 'cmb' ),
            'red'       => __( '<b>Audition</b> (Red)', 'cmb' ),
            'green'	    => __( '<b>General/Clinic/Other</b> (Green)', 'cmb' ),
        ),
    ) );

	// Attach Schedule
	$cmb->add_field( array(
	    'name'        => __( 'Attach Schedule<br><small><i>Requires the <a href="https://github.com/WebDevStudios/CMB2-Post-Search-field" target="_BLANK">CMB2 Post Search Field Plugin</a></i>.</small>' ),
	    'id'          => $prefix . 'attached_schedule',
	    'type'        => 'post_search_text', // This field type
	    // post type also as array
	    'post_type'   => 'ucfbands_schedule',
	    // Default is 'checkbox', used in the modal view to select the post type
	    'select_type' => 'radio',
	    // Will replace any selection with selection from modal. Default is 'add'
	    'select_behavior' => 'replace',
		'description' => '<b>Optional</b>. Click search icon, then find the schedule. The schedules\'s ID will be entered.',
	) );


    // Program Group
    $group_field_id = $cmb->add_field( array(
        'id'          => $prefix . 'program_group',
        'name'        => 'Program',
        'type'        => 'group',
        'description' => __( 'Build Program', 'cmb' ),
        'options'     => array(
            'group_title'   => __( 'Piece {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add Piece', 'cmb' ),
            'remove_button' => __( 'Remove Piece', 'cmb' ),
            'sortable'      => true // beta
        ),
    ) );

    // Program Group: Band Heading
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Band',
        'desc' => 'Ex: UCF Symphonic Band',
        'id'   => 'band',
        'type' => 'text',
    ) );

    // Program Group: Band Conductor
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Conductor',
        'desc' => 'Ex: John Williams',
        'id'   => 'conductor',
        'type' => 'text',
    ) );  

    // Program Group: Piece Title
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Title',
        'desc' => 'Ex: Kirkpatrick Fanfare',
        'id'   => 'title',
        'type' => 'text',
    ) );

    // Program Group: Piece Composer
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Composer(s)',
        'desc' => 'Ex: Boysen',
        'id'   => 'composer',
        'type' => 'text',
    ) );

    // Program Group: Sub-Listing
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Piece Note',
        'desc' => 'Optional. Ex: <i>Laszlo Marosi, Conductor</i>',
        'id'   => 'piece_note',
        'type' => 'text',
        'repeatable' => true,
    ) );


    // Program Guest Compooser
    $cmb->add_field( array(
        'name'    => 'Program Guest Composer(s)/Conductor(s)',
        'desc'    => 'Optional. Displays before program pieces.<br>Ex: <i>Carter Pann, Guest Composer</i>',
        'id'      => $prefix . 'program_guest_composer',
        'type'    => 'text'
    ) );
}

add_action( 'cmb2_init', 'ucfbands_event_metabox' );
