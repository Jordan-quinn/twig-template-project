<?php

/**
 * page-events.php
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    JQTheme
 * @subpackage Core
 * @author     Jordan Quinn <jordanquinn11@hotmail.co.uk>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */
$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$templates = array( 'page-events.twig' );

get_header();

// Retrieve base template
Timber::render( $templates, $context );

get_footer();