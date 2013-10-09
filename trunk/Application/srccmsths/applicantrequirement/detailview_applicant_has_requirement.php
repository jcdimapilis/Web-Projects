<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('View applicant has requirement');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['Applicant_applicant_no']) && isset($_GET['Requirement_requirement_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/applicant_has_requirement.php';
    $dbh_applicant_has_requirement = new applicant_has_requirement;
    $dbh_applicant_has_requirement->set_where("Applicant_applicant_no='$Applicant_applicant_no' AND Requirement_requirement_no='$Requirement_requirement_no'");
    if($result = $dbh_applicant_has_requirement->make_query())
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
        header("location: listview_applicant_has_requirement.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }
}
require_once 'subclasses/applicant_has_requirement_html.php';
$html = new applicant_has_requirement_html;
$html->draw_header('Detail View: applicant has requirement', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);
$html->detail_view = TRUE;

$html->draw_controls('view');

$html->draw_footer();