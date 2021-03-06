<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('View grades');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['quarter']) && isset($_GET['SubjectStudentSection_Subject_subject_no']) && isset($_GET['SubjectStudentSection_StudentSection_Student_student_no']) && isset($_GET['SubjectStudentSection_StudentSection_Section_section_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/grades.php';
    $dbh_grades = new grades;
    $dbh_grades->set_where("quarter='$quarter' AND SubjectStudentSection_Subject_subject_no='$SubjectStudentSection_Subject_subject_no' AND SubjectStudentSection_StudentSection_Student_student_no='$SubjectStudentSection_StudentSection_Student_student_no' AND SubjectStudentSection_StudentSection_Section_section_no='$SubjectStudentSection_StudentSection_Section_section_no'");
    if($result = $dbh_grades->make_query())
    {
        $data = $result->fetch_assoc();
        extract($data);

    }


}
elseif(xsrf_guard())
{
    extract($_POST);
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header("location: listview_grades.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }
}
require_once 'subclasses/grades_html.php';
$html = new grades_html;
$html->draw_header('Detail View: grades', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);
$html->detail_view = TRUE;

$html->draw_controls('view');

$html->draw_footer();