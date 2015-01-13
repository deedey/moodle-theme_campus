<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Campus theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// TEMPORARY TEST CODE.
global $CFG, $OUTPUT;
if (!empty($CFG->campusheader)) {
    echo '<div style="background-color: '.get_config('theme_campus', 'coursecategorybgcolour'.$OUTPUT->get_current_category()).'; color: #fff;">TEST CODE: Campus course category header: '.$CFG->campusheader.'</div>';
}

// Real code begins.
$currentcategory = $OUTPUT->get_current_category();

// Image files.
$coursecategorylogo = $PAGE->theme->setting_file_url('coursecategorylogo'.$currentcategory, 'coursecategorylogo'.$currentcategory);
$coursecategorybackgroundimage = $PAGE->theme->setting_file_url('coursecategorybackgroundimage'.$currentcategory, 'coursecategorybackgroundimage'.$currentcategory);

// Layout.
$coursecategorylayout = 'coursecategorylayout'.$currentcategory;
$coursecategorylayout = (!empty($PAGE->theme->settings->$coursecategorylayout)) ? $PAGE->theme->settings->$coursecategorylayout : 'absolutelayout';
$ccflexlayout = ($coursecategorylayout == 'flexlayout');
if ($ccflexlayout) {
    $ccsettingkey = 'coursecategorylogoposition'.$currentcategory;
    $cclogoextrapos = (!empty($PAGE->theme->settings->$ccsettingkey)) ? $PAGE->theme->settings->$ccsettingkey : 1;
    if ($cclogoextrapos == 2) {
        $ccalignextra = ' right';
    } else {
        $ccalignextra = ' left';
    }
} else {
    $ccalignextra = '';
    $cclogoextrapos = 1;
}
echo '<div class="coursecategoryheader '.$coursecategorylayout.' category'.$currentcategory.'">';
if ($ccflexlayout) {
    echo '<div class="flexlayoutcontainer">';
}

global $CFG;
if ($cclogoextrapos == 1) {
    echo '<div class="logotitle'.$ccalignextra.'">';
    if ($coursecategorylogo) {
        echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'" class="logoheight img-responsive"></a>';
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
if ($coursecategorybackgroundimage) {
    if ($ccflexlayout) {
        echo '<div class="backgroundcontainer'.$ccalignextra.'">';
    }
    echo '<img src="'.$coursecategorybackgroundimage.'" class="backgroundimage img-responsive">';
    if ($ccflexlayout) {
        echo '</div>';
    }
}
if ($cclogoextrapos == 2) {
    echo '<div class="logotitle'.$ccalignextra.'">';
    if ($coursecategorylogo) {
        echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'" class="logoheight img-responsive"></a>';
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
$showpageheading = (!isset($PAGE->theme->settings->showpageheading)) ? true : $PAGE->theme->settings->showpageheading;
if (($showpageheading) && ($coursecategorylogo)) {
    echo '<div class="sitename"><a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a></div>';
}
if ($ccflexlayout) {
    echo '</div>';
}
echo '</div>';

require_once(dirname(__FILE__).'/navbar.php');

// Carousel pre-loading.
$numberofslides = get_config('theme_campus', 'numberofslidesforcategory'.$OUTPUT->get_current_category());
$settingprefix = 'coursecategory'.$OUTPUT->get_current_category().'_'; // Cross ref to theme_campus_pluginfile() image serving in lib.php.
