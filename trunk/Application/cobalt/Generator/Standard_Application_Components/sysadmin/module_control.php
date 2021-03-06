<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require 'path.php';
init_cobalt('Module Control');

if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(xsrf_guard())
{
    if($_POST['cancel'])
    {
        log_action('Pressed cancel button', $_SERVER[PHP_SELF]);
        header('location: ' . HOME_PAGE);
        exit();
    }
    
    if(isset($_POST['passportGroup']))
    {
        $passportGroup = $_POST['passportGroup'];
        if($passportGroup !="All Groups")    $filter = "AND a.passport_group_id = '$passportGroup'";
        else $filter = "";
    }
    
    if($_POST['process'])
    {
        if(is_array($_POST['module']))
        {
            $arr_module = $_POST['module'];
        }
        else
        {
            $arr_module = array();
        }

        $mod_update_con = new data_abstraction;
        $mod_update_con->set_query_type('UPDATE');
        $mod_update_con->set_table('user_links');

        $data_con = new data_abstraction;
        $data_con->set_fields('link_id, status');
        $data_con->set_table('user_links a');
        $data_con->set_where("name!='Module Control' $filter");
        $data_con->set_order('a.descriptive_title');
        $result = $data_con->make_query();
        for($a=0; $a<$data_con->num_rows; $a++)
        {
            $data = $result->fetch_assoc();
            extract($data);
        
            $new_module_status = 'Off';
            if(in_array($link_id, $arr_module))
            {
                $new_module_status = 'On';
            }

            if($new_module_status == $status)
            {
                //No change in status, do nothing
            }
            else
            {
                $mod_update_con->set_update("status='$new_module_status'");
                $mod_update_con->set_where("link_id='$link_id'");
                $mod_update_con->make_query();
                if($mod_update_con->error != '') die($mod_update_con->error);
            }
        }
        $data_con->close_db();
        $mod_update_con->close_db();

        $message = 'Modules status have been updated.';
        $message_type = 'system';
    }
}
$html_writer = new html;
$html_writer->draw_header('Module Control', $message, $message_type);
//Display system message after module status update.

echo '<div class="container_mid_huge2">
    <fieldset class="top"> Enable or Disable System Modules</fieldset>
    <fieldset class="middle">
    <table class="input_form" width="900">';

echo '<tr><td>';
$html_writer->draw_button('SPECIAL','submit','process','SAVE CHANGES',FALSE,0);
$html_writer->draw_button('SPECIAL','cancel','cancel','BACK',FALSE,0);
$html_writer->draw_button('BUTTON','','enable','ENABLE ALL',FALSE,0,"onClick='checkAll()'");
$html_writer->draw_button('BUTTON','','disable','DISABLE ALL',FALSE,0,"onClick='uncheckAll()'");
echo '</td><td align=right>'
?>
    Module Category: <select name="passportGroup" onChange="this.form.submit();">
    <?php
    echo '<option selected>All Groups</option>';
    $data_con = new data_abstraction;
    $data_con->connect_db();
    $data_con->set_fields('passport_group_id, passport_group AS passport_group_name');
    $data_con->set_table('user_passport_groups');
    $data_con->set_order('passport_group');
    if($result = $data_con->make_query())
    {
        while($data = $result->fetch_assoc())
        {
            extract($data);
            $selected = '';
            if($passport_group_id == $passportGroup) $selected = 'selected';
            echo "<option value='$passport_group_id' $selected> $passport_group_name </option>";
        }
        $result->close();
    }
    else error_handler('Encountered an error while retrieving records. ', $data_con->error);
    $data_con->close_db();
    ?>    
    </select>
</td></tr>
<tr>
    <td colspan=2>
        <table border=1 width=900 class="listView">
        <tr class=listRowHead>
            <td>#</td><td>module</td><td>status</td>
            <td>#</td><td>module</td><td>status</td>
        </tr>
<?php
    $a=0;
    $data_con = new data_abstraction;
    $data_con->connect_db();
    $data_con->set_fields('a.link_id, a.descriptive_title as `title`, a.status, b.passport_group');
    $data_con->set_table('user_links a, user_passport_groups b');
    $data_con->set_where("a.passport_group_id = b.passport_group_id AND a.name!='Module Control' $filter");
    $data_con->set_order('a.descriptive_title');
    if($result = $data_con->make_query())
    {
        while($data = $result->fetch_assoc())
        {
            extract($data);
            if($a%4==0) $class='listRowEvenNoHighlight';
            else $class='listRowOddNoHighlight';
            
            echo "<tr class=$class><td>". ($a+1). "</td><td class=\"listCell\"><label style=\"display: block;\" for=\"checkfield[$link_id]\"> $title</label></td><td>";
            
            $checked='';
            if($status=="On")
            {
                $checked = 'checked';
            }
            echo "<input type=\"checkbox\" ID=\"checkfield[$link_id]\" name=\"module[]\" value=\"$link_id\" $checked></td>";

            $b=$a+1;
            if($b < $data_con->num_rows)
            {        
                $data=$result->fetch_assoc();
                extract($data);
                echo "<td >". ($b+1). "</td><td class=\"listCell\"><label style=\"display: block;\" for=\"checkfield[$link_id]\"> $title</label></td><td>";
                $checked='';
                if($status=="On")
                {
                    $checked = 'checked';
                }
                echo "<input type=\"checkbox\" ID=\"checkfield[$link_id]\" name=\"module[]\" value=\"$link_id\" $checked></td>";
            }
            else
            {
                echo "<td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr>" . "\r\n";
            }
            $a+=2;
        }
        $result->close();
    }
    else error_handler('Encountered an error while retrieving module list. ', $data_con->error);
    $data_con->close_db();
?>
        </table>
    </td>
</tr>
<?php
echo '<tr><td>';
$html_writer->draw_button('SPECIAL','submit','process','SAVE CHANGES',FALSE,0);
$html_writer->draw_button('SPECIAL','cancel','cancel','BACK',FALSE,0);
$html_writer->draw_button('BUTTON','','enable','ENABLE ALL',FALSE,0,"onClick='checkAll()'");
$html_writer->draw_button('BUTTON','','disable','DISABLE ALL',FALSE,0,"onClick='uncheckAll()'");
echo '</td></tr>';
echo '</table>';
echo '</div>';
$html_writer->draw_footer();
?>
<script language="JavaScript" type="text/JavaScript">
function checkAll()
{

    var arrCheckBoxes = document.getElementsByName('module[]');
    for (var i = 0; i < arrCheckBoxes.length; i++)
    {
        arrCheckBoxes[i].checked = true;
    }
}
function uncheckAll()
{
    var arrCheckBoxes = document.getElementsByName('module[]');
    for (var i = 0; i < arrCheckBoxes.length; i++)
    {
        arrCheckBoxes[i].checked = false;
    }
}
</script>

<?php
