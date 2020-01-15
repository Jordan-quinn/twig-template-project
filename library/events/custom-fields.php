<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_event-categories',
		'title' => 'Event Categories',
		'fields' => array (
			array (
				'key' => 'field_5c792d239c4e0',
				'label' => 'Categories',
				'name' => 'select_a_category',
				'type' => 'select',
				'instructions' => 'Select a venue for this event to display under',
				'choices' => array (
                                    'smag' => 'Shrewsbury Museum & Art Gallery',
                                    'acton_scott' => 'Acton Scott Historic Working Farm',
                                    'much_wenlock' => 'Much Wenlock Museum',
                                    'collections_centre' => 'Collections Centre',
				),
				'default_value' => 'Shrewsbury Museums & Art Gallery',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_event-dates',
		'title' => 'Event Dates',
		'fields' => array (
			array (
				'key' => 'field_5c7929c679eba',
				'label' => 'Date From',
				'name' => 'from',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yymmdd',
				'display_format' => 'mm/dd/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5c7929de79ebb',
				'label' => 'Date To',
				'name' => 'to',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yymmdd',
				'display_format' => 'mm/dd/yy',
				'first_day' => 1,
			),
                        array(
                            'key' => 'field_5c98a3bb9af20',
                            'label' => 'Event Start Time from',
                            'name' => 'time_from',
                            'type' => 'time_picker',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => array(
                                    array(
                                            array(
                                                    'field' => 'field_5c98a475d16bf',
                                                    'operator' => '==empty',
                                            ),
                                    ),
                            ),
                            'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                            ),
                            'display_format' => 'g:i a',
                            'return_format' => 'g:i a',
                        ),
                        array(
                                'key' => 'field_5c98a3e19af21',
                                'label' => 'to',
                                'name' => 'time_to',
                                'type' => 'time_picker',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => array(
                                        array(
                                                array(
                                                        'field' => 'field_5c98a475d16bf',
                                                        'operator' => '==empty',
                                                ),
                                        ),
                                ),
                                'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                ),
                                'display_format' => 'g:i a',
                                'return_format' => 'g:i a',
                        ),
                        array(
                                'key' => 'field_5c98a475d16bf',
                                'label' => 'All day',
                                'name' => 'all_day',
                                'type' => 'checkbox',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                ),
                                'choices' => array(
                                        'All day' => 'All day',
                                ),
                                'allow_custom' => 0,
                                'default_value' => '',
                                'layout' => 'horizontal',
                                'toggle' => 0,
                                'return_format' => 'value',
                                'save_custom' => 0,
                        ),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_events',
		'title' => 'Events',
		'fields' => array (
			array (
				'key' => 'field_5c7e8d2d31392',
				'label' => 'location',
				'name' => 'location',
				'type' => 'checkbox',
				'required' => 1,
				'choices' => array (
					'Acton Scott Historic Working Farm' => 'Acton Scott Historic Working Farm',
					'Much Wenlock Museum' => 'Much Wenlock Museum',
					'Shrewsbury Castle and Regimental Museum' => 'Shrewsbury Castle and Regimental Museum',
					'Shrewsbury Museum and Art Gallery' => 'Shrewsbury Museum and Art Gallery',
					'Shropshire Museums Collections Centre' => 'Shropshire Museums Collections Centre',
					'' => '',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_event-type',
		'title' => 'Event Type',
		'fields' => array (
			array (
				'key' => 'field_5c7e8fa50ee6d',
				'label' => 'Type',
				'name' => 'type',
				'type' => 'select',
				'instructions' => 'Select event type from dropdown',
				'required' => 1,
				'choices' => array (
                                    'Event' => 'Event',
                                    'Late Opening' => 'Late Opening',
                                    'Lecture' => 'Lecture',
                                    'Exhibition (permanent)' => 'Exhibition (permanent)',
                                    'Exhibition (temporary)' => 'Exhibition (temporary)',
                                    'Guided tour' => 'Guided tour',
                                    'Living history or re-enactment' => 'Living history or re-enactment',
                                    'Performance' => 'Performance',
                                    'Seasonal event' => 'Seasonal event',
                                    'Storytelling session' => 'Storytelling session',
                                    'Workshop or activity session' => 'Workshop or activity session'
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
