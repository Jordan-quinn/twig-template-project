<?php

/**
 * header.php
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    JQTheme
 * @subpackage Core
 * @author     Jordan Quinn <jordanquinn11@hotmail.co.uk>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

$conf = array();
$conf['site_title'] = 'JQ Demo Theme';
$conf['site_strapline'] = 'Version 1.0.0';
$conf['site_js_path'] = TH_JS_URI.'theme.min.js';
$conf['site_css_path'] = TH_CSS_URI.'core.css';

// Render Header
Timber::render('header.twig', $conf);
        