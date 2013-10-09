<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('Edit teacher has subject');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['Teacher_teacher_no']) && isset($_GET['Teacher_Department_dept_no']) && isset($_GET['Subject_subject_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/teacher_has_subject.php';
    $dbh_teacher_has_subject = new teacher_has_subject;
    $dbh_teacher_has_subject->set_where("Teacher_teacher_no='$Teacher_teacher_no' AND Teacher_Department_dept_no='$Teacher_Department_dept_no' AND Subject_subject_no='$Subject_subject_no'");
    if($result = $dbh_teacher_has_subject->make_query())
    {
        $data = $result->fetch_assoc();
        extract($data);
        $orig_Teacher_teacher_no = $Teacher_teacher_no;
        $orig_Teacher_Department_dept_no = $Teacher_Department_dept_no;
        $orig_Subject_subject_no = $Subject_subject_no;

    }


}
elseif(xsrf_guard())
{
    extract($_POST);
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header("location: listview_teacher_has_subject.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }

    if($_POST['submit'])
    {
        log_action('Pressed submit button', $_SERVER[PHP_SELF]);


        require_once 'validation_class.php';
        require_once 'subclasses/teacher_has_subject.php';
        $dbh_teacher_has_subject = new teacher_has_subject;
        $validator = new validation;

        $message .= $dbh_teacher_has_subject->sanitize($_POST);
        extract($_POST);

        if($dbh_teacher_has_subject->check_uniqueness_for_editing($_POST)) ;
        else $message = "Record already exists with the same primary identifiers!";

        if($message=="")
        {
            $dbh_teacher_has_subject->edit($_POST);


            header("location: listview_teacher_has_subject.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
        }
    }
}
require_once 'subclasses/teacher_has_subject_html.php';
$html = new teacher_has_subject_html;
$html->draw_header('Edit teacher has subject', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);

echo "<input type=hidden name='orig_Teacher_teacher_no' value='$orig_Teacher_teacher_no'>";
echo "<input type=hidden name='orig_Teacher_Department_dept_no' value='$orig_Teacher_Department_dept_no'>";
echo "<input type=hidden name='orig_Subject_subject_no' value='$orig_Subject_subject_no'>";

$html->draw_controls('edit');

$html->draw_footer();