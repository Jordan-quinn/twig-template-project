<?php

/**
 * config.php
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    JQTheme
 * @subpackage Core
 * @author     Jordan Quinn <jordanquinn11@hotmail.co.uk>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

// Global defines
define('FOOTCOL_COUNT', 3);
define('TH_TPL_URI',               get_template_directory_uri() . '/'   );
define('TH_TPL_DIR',               get_template_directory()     . '/'   );
define('TH_CSS_URI',               TH_TPL_URI                   . 'css/');
define('TH_CSS_DIR',               TH_TPL_DIR                   . 'css/');
define('TH_IMG_URI',               TH_TPL_URI                   . 'img/');
define('TH_IMG_DIR',               TH_TPL_DIR                   . 'img/');
define('TH_JS_URI',                TH_TPL_URI                   . 'js/' );
define('TH_JS_DIR',                TH_TPL_DIR                   . 'js/' );

// Events library
require_once 'library/events/core.php';