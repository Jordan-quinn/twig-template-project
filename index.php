<?php

/*
 * index.php
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
$context['posts'] = new Timber\PostQuery();
$templates = array( 'base.twig' );

get_header();

// Retrieve base template
Timber::render( $templates, $context );

get_footer();

?>