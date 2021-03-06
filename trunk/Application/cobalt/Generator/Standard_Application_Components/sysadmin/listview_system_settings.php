<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require_once 'path.php';
init_cobalt('View system settings');
if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(isset($_GET['filter'])) 
{
    extract($_GET);
    if($current_page < 1) $current_page = $page_from;
}

if(xsrf_guard())
{
    extract($_POST);
    $filter = quote_smart($filter);    
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header('location: ' . HOME_PAGE);
    }    
}

if(trim($filter)!='') $enc_filter = urlencode($filter);
if(trim($filter_field)!='') $enc_filter_field = urlencode($filter_field);

require_once 'subclasses/system_settings_html.php';
$html = new system_settings_html;
$html->get_listview_fields();
$lst_fields = $html->lst_fields;
$arr_fields = $html->arr_fields;
$arr_field_labels = $html->arr_field_labels;
$lst_filter_fields = $html->lst_filter_fields;

require_once 'subclasses/system_settings.php';
$data_con = new system_settings;
$data_con->get_join_clause();
$data_con->set_table($data_con->join_clause);
$data_con->set_fields($lst_fields);
if($filter_field!='') $data_con->set_where("$filter_field LIKE '%$filter%'");

$data_con->make_query();
$total_records = $data_con->num_rows;

require_once 'paged_result_class.php';
$results_per_page = 50;
$pager = new paged_result($total_records, $results_per_page);
$pager->get_page_data($result_pager, $current_page);
$current_page = $pager->current_page;
$data_con->set_limit($pager->offset, $pager->records_per_page);

$html = new system_settings_html;
$html->draw_header('List View: system settings', $message, $message_type);
require_once 'subclasses/../../javascript/submitenter.php';
?>
<fieldset class="container">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="left" colspan="2">
    <?php
    $html->draw_button('SPECIAL','button1','cancel','BACK');
    if(check_link('Add system settings')) echo "&nbsp; &nbsp; <a href='add_system_settings.php?filter_field_used=$enc_filter_field&filter_used=$enc_filter&page_from=$current_page'>Add new system setting</a>";
    ?>
    <br><br>
    </td>
</tr>
<tr class="listRowEven">
    <td align="left">
    &nbsp; &nbsp; Filter: 
    <?php 
    $config_items = array();
    $config_values = array();
    foreach($arr_field_labels as $label) $config_items[] = ucwords($label);
    $data = explode(',', $lst_filter_fields);
    foreach($data as $field) $config_values[] = trim($field);
    $config = array('items'=>$config_items,
                    'values'=>$config_values);
                    
    $html->draw_select_field($config,'','filter_field',FALSE);        
    echo '&nbsp;';
    $filter = stripslashes($filter);
    $html->draw_text_field('','filter',FALSE,'',FALSE,'onKeyPress="submitenter(this,event)"');
    echo '&nbsp;';
    $html->draw_button('GO'); ?>
    
    </td>
    <td align=right>

    <?php echo $pager->draw_paged_result('onKeyPress="submitenter(this,event)"'); ?>

    </td>
</tr>
<?php echo $pager->draw_nav_links($enc_filter, $enc_filter_field);?>
<tr>
    <td colspan="2">
    <hr>    
    </td>
</tr>
</table>

<table border=1 width=100% class="listView">
<tr class="listRowHead">
    <td class="oper_col">Operations</td>
    <?php
    foreach($arr_field_labels as $label) 
    {
        echo '<td>' . $label . '</td>';
    }
    ?>
</tr>

<?php
    if($result = $data_con->make_query())
    {
        while($row = $result->fetch_assoc())
        {
            if($a%2 == 0) $class = 'listRowEven';
            else $class = 'listRowOdd';
            $a++;        
            extract($row);
            echo "<tr class=$class><td align='center'><a href='detailview_system_settings.php?filter_field_used=$enc_filter_field&filter_used=$enc_filter&page_from=$current_page&setting=$setting'><img src='../images/view.png' alt='View' title='View'></a>";
            if(check_link('Edit system settings')) echo "&nbsp;&nbsp;<a href='edit_system_settings.php?filter_field_used=$enc_filter_field&filter_used=$enc_filter&page_from=$current_page&setting=$setting'><img src='../images/edit.png' alt='Edit' title='Edit'></a>";
            if(check_link('Delete system settings')) echo "&nbsp;&nbsp;<a href='delete_system_settings.php?filter_field_used=$enc_filter_field&filter_used=$enc_filter&page_from=$current_page&setting=$setting'><img src='../images/delete.png' alt='Delete' title='Delete'></a>";
            echo '</td>';
            
            foreach($arr_fields as $field)
            {
                if(is_array($field))
                {
                    echo '<td class="listCell">';
                    foreach($field as $subtext)
                    {
                        echo htmlentities($$subtext, ENT_QUOTES) . ' ';
                    }
                    echo '</td>';
                }
                else
                {
                    echo '<td class="listCell">' . htmlentities($$field, ENT_QUOTES) . '</td>';
                }
            }
            echo "</tr>\n";
        }
        $result->close();
    }
    else error_handler('Encountered an error while retrieving records.', $data_con->error);
    $data_con->close_db();
?>
</table>
<table border="0" width="100%">
<?php echo $pager->draw_nav_links($enc_filter, $enc_filter_field);?>
<tr>
    <td colspan="2"><hr><br></td>
</tr>
</table>
<?php 
$html->draw_button('SPECIAL','button1','cancel','BACK');
if(check_link('Add system settings')) echo "&nbsp; &nbsp; &nbsp;<a href='add_system_settings.php?filter_field_used=$enc_filter_field&filter_used=$enc_filter&page_from=$current_page'>Add new system setting</a>";
echo '</fieldset>';
$html->draw_footer();
