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

if(isset($_GET['filter_field_used']) && isset($_GET['filter_used']) && isset($_GET['page_from']))
{
    $page_from = htmlentities($_GET['page_from']);
    $filter_used = htmlentities($_GET['filter_used']);
    $filter_field_used = htmlentities($_GET['filter_field_used']);
}

if(xsrf_guard())
{
    extract($_POST);
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header("location: listview_grades.php?filter_field=$filter_field_used&filter=$filter_used&page_from=$page_from");
    }

    if($_POST['submit'])
    {
        log_action('Pressed submit button', $_SERVER[PHP_SELF]);

        require_once 'validation_class.php';
        require_once 'subclasses/grades.php';
        $dbh_grades = new grades;
        $validator = new validation;

        extract($_POST);

        if($message=="")
        {
            log_action("Exported table data to CSV", $_SERVER['PHP_SELF']);
            $timestamp = date('Y-m-d');
            $csv_name = '/' . $_SESSION['user'] . '_grades_' . $timestamp . '.csv';
            $filename = TMP_DIRECTORY . $csv_name;
            $linkname = TMP_HYPERLINK_PATH . $csv_name;

            $csv_contents = $dbh_grades->export_to_csv();

            $csv_file=fopen($filename,"wb");
            fwrite($csv_file, $csv_contents);
            fclose($csv_file);
            chmod($filename, 0755);

            $message='CSV file successfully generated: <a href="' . $linkname . '">Download the CSV file.</a>';
            $message_type='system';
        }
    }
}
require_once 'subclasses/grades_html.php';
$html = new grades_html;
$html->draw_header('CSV Exporter: grades', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from);

echo '<div class="container_mid">';
$html->draw_fieldset_header('CSV Filter Settings');
$html->draw_fieldset_body_start();

$html->draw_text_field('Quarter', 'quarter', FALSE, 'text', TRUE);
$html->draw_text_field('Grade', 'grade', FALSE, 'text', TRUE);
$html->draw_text_field('Letter Equiv', 'letter_equiv', FALSE, 'text', TRUE);
$html->draw_text_field('SubjectStudentSection Subject Subject No', 'SubjectStudentSection_Subject_subject_no', FALSE, 'text', TRUE);
$html->draw_text_field('SubjectStudentSection StudentSection Student Student No', 'SubjectStudentSection_StudentSection_Student_student_no', FALSE, 'text', TRUE);
$html->draw_text_field('SubjectStudentSection StudentSection Section Section No', 'SubjectStudentSection_StudentSection_Section_section_no', FALSE, 'text', TRUE);


$html->draw_fieldset_body_end();
$html->draw_fieldset_footer_start();
$html->draw_submit_cancel();
$html->draw_fieldset_footer_end();
echo '</div>';

$html->draw_footer();