<?php
// This file is part of Moodle - http://moodle.org/
/**

 *
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package   block_testblock
 * @copyright 2015 MFreak.nl
 * @author    Luuk Verhoeven
 **/
require_once(dirname(__FILE__) . '/../../../config.php');
defined('MOODLE_INTERNAL') || die;

require_login();

$courseid = required_param('courseid', PARAM_INT);
$parentcourse = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);

$context = context_course::instance($courseid);
$PAGE->set_course($parentcourse);
$PAGE->set_url('/blocks/testblock/view/Training.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Audio Training');
$PAGE->navbar->add('Audio Training');
$PAGE->requires->css('/blocks/testblock/styles.css');

$renderer = $PAGE->get_renderer('block_testblock');

$renderer->add_javascript_module();
echo $OUTPUT->header();
echo $renderer->training();
echo $OUTPUT->footer();