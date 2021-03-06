<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('Delete interviewee');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['interview_no']) && isset($_GET['Exam_exam_no']) && isset($_GET['Exam_Applicant_applicant_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/interviewee.php';
    $dbh_interviewee = new interviewee;
    $dbh_interviewee->set_where("interview_no='$interview_no' AND Exam_exam_no='$Exam_exam_no' AND Exam_Applicant_applicant_no='$Exam_Applicant_applicant_no'");
    if($result = $dbh_interviewee->make_query())
    {
        $data = $result->fetch_assoc();
        extract($data);
        
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
        header("location: listview_interviewee.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }

    elseif($_POST['delete'])
    {
        log_action('Pressed delete button', $_SERVER[PHP_SELF]);
        require_once 'subclasses/interviewee.php';
        require_once 'validation_class.php';
        $dbh_interviewee = new interviewee;
        $validator = new validation;

        $dbh_interviewee->del($_POST);


        header("location: listview_interviewee.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }
}
require_once 'subclasses/interviewee_html.php';
$html = new interviewee_html;
$html->draw_header('Delete interviewee', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);

echo "<input type=hidden name='interview_no' value='$interview_no'>";
echo "<input type=hidden name='Exam_exam_no' value='$Exam_exam_no'>";
echo "<input type=hidden name='Exam_Applicant_applicant_no' value='$Exam_Applicant_applicant_no'>";

$html->detail_view = TRUE;

$html->draw_controls('delete');

$html->draw_footer();