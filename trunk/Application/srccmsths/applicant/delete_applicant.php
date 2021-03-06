<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('Delete applicant');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['applicant_no']))
{
    extract($_GET);

    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);

    require_once 'subclasses/applicant.php';
    $dbh_applicant = new applicant;
    $dbh_applicant->set_where("applicant_no='$applicant_no'");
    if($result = $dbh_applicant->make_query())
    {
        $data = $result->fetch_assoc();
        extract($data);
        
        $data = explode('-',$date_of_birth);
        $date_of_birth_year = $data[0];
        $date_of_birth_month = $data[1];
        $date_of_birth_day = $data[2];
    }


}
elseif(xsrf_guard())
{
    extract($_POST);
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header("location: listview_applicant.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }

    elseif($_POST['delete'])
    {
        log_action('Pressed delete button', $_SERVER[PHP_SELF]);
        require_once 'subclasses/applicant.php';
        require_once 'validation_class.php';
        $dbh_applicant = new applicant;
        $validator = new validation;

        $dbh_applicant->del($_POST);


        header("location: listview_applicant.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }
}
require_once 'subclasses/applicant_html.php';
$html = new applicant_html;
$html->draw_header('Delete applicant', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);

echo "<input type=hidden name='applicant_no' value='$applicant_no'>";

$html->detail_view = TRUE;

$html->draw_controls('delete');

$html->draw_footer();