<?php // $Id: index.php,v 1.2 2012/03/10 22:00:00 Igor Nikulin Exp $


require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = required_param('id', PARAM_INT);   // course

if (! $course = get_record('course', 'id', $id)) {
    error('Course ID is incorrect');
}

require_course_login($course);


$strvideoboards = get_string('modulenameplural', 'videoboard');
$strvideoboard  = get_string('modulename', 'videoboard');


/// Print the header

$PAGE->set_url('/mod/videoboard/index.php', array('id' => $cm->id));
    
$title = $course->shortname . ': ' . format_string($videoboard->name);
$PAGE->set_title($title);
$PAGE->set_heading($course->fullname);


if (! $displays = get_all_instances_in_course("videoboard", $course)) {
  notice("There are no displays", "../../course/view.php?id=$course->id");
  die;
}

echo $OUTPUT->header();

html_writer::empty_tag('br');

echo $OUTPUT->box_start('generalbox');

foreach ($displays as $display) {
  html_writer::link(new moodle_url('view.php', array('id'=>$display->coursemodule)), $display->name);
  html_writer::empty_tag('br');
}

echo $OUTPUT->box_end();

html_writer::empty_tag('br');

echo $OUTPUT->footer();
