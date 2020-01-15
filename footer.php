<?php

/**
 * footer.php
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    JQTheme
 * @subpackage Core
 * @author     Jordan Quinn <jordanquinn11@hotmail.co.uk>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

$context['site_copyright'] = 'JQTheme 2019';

Timber::render('footer.twig', $context);