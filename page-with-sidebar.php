<?php

/**
 * Template Name: Page With Sidebar
 * Description: A Page Template with one sidebar, primary (sidebar left) by
 * default, if primary has no widgets falls back to secondary (sidebar right)
 *
 * page-1sb.php
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
$context['sidebar'] = true;
$context['sidebar_id'] = 'primary';
$context['sidebar_enabled'] = 'sb-primary';
$context['sidebar_widget'] = 'This is the sidebar widget area...';

$templates = array( 'page.twig' );

get_header();

// Retrieve base template
Timber::render( $templates, $context );

get_footer();