<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('Edit exam');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['exam_no']) && isset($_GET['Applicant_applicant_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/exam.php';
    $dbh_exam = new exam;
    $dbh_exam->set_where("exam_no='$exam_no' AND Applicant_applicant_no='$Applicant_applicant_no'");
    if($result = $dbh_exam->make_query())
    {
        $data = $result->fetch_assoc();
        extract($data);
        $orig_Applicant_applicant_no = $Applicant_applicant_no;
        
        $data = explode('-',$date);
        $year = $data[0];
        $month = $data[1];
        $day = $data[2];
    }


}
elseif(xsrf_guard())
{
    extract($_POST);
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header("location: listview_exam.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }

    if($_POST['submit'])
    {
        log_action('Pressed submit button', $_SERVER[PHP_SELF]);

        $date = $year . '-' . $month . '-' . $day;

        $_POST['date'] = $date;
        require_once 'validation_class.php';
        require_once 'subclasses/exam.php';
        $dbh_exam = new exam;
        $validator = new validation;

        $message .= $dbh_exam->sanitize($_POST);
        extract($_POST);

        if($dbh_exam->check_uniqueness_for_editing($_POST)) ;
        else $message = "Record already exists with the same primary identifiers!";

        if($message=="")
        {
            $dbh_exam->edit($_POST);


            header("location: listview_exam.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
        }
    }
}
require_once 'subclasses/exam_html.php';
$html = new exam_html;
$html->draw_header('Edit exam', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);
echo "<input type=hidden name='exam_no' value='$exam_no'>";
echo "<input type=hidden name='orig_Applicant_applicant_no' value='$orig_Applicant_applicant_no'>";

$html->draw_controls('edit');

$html->draw_footer();