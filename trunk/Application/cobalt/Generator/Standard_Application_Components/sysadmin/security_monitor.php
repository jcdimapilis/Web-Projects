<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require 'path.php';
init_cobalt('Security Monitor');

if(!isset($_POST['form_key'])) log_action("Module Access", $_SERVER['PHP_SELF']);

if(xsrf_guard())
{
    if($_POST['cancel']) 
    {
        log_action('Pressed cancel button', $_SERVER['PHP_SELF']);
        header('location: ' . HOME_PAGE);
        exit();
    }

    if(isset($_POST['DateTimeOptions'])) $DateTimeOptions=$_POST['DateTimeOptions'];
    else 
    {
        $DateTimeOptions="ViewAll";
        $TimeStart="-NO RANGE-";
        $TimeEnd="-NO RANGE-";
    }

    if(isset($_POST['UserOptions'])) $UserOptions=$_POST['UserOptions'];
    else 
    {
        $UserOptions="ViewAll";
        $Username="-ALL USERS-";
    }

    if(isset($_POST['ModuleOptions'])) $ModuleOptions=$_POST['ModuleOptions'];
    else 
    {
        $ModuleOptions="ViewAll";
        $Module="-ALL MODULES-";
    }

    if($_POST['ViewMonitor'] || $_POST['ViewMonitorPF'])
    {
        extract($_POST);

        if($DateTimeOptions!="ViewAll")
        {
            if($TimeStart!="") $TimeStart = strtotime($TimeStart);
            else $TimeStart = -1;
            if($TimeEnd!="")$TimeEnd = strtotime($TimeEnd);
            else $TimeEnd = -1;

            if($TimeStart == -1) $message=$message . "Invalid start time <BR>";
            if($TimeEnd == -1) $message=$message . "Invalid end time <BR>";

            if(($TimeStart > -1) && ($TimeEnd > -1) )
            {
                if($TimeStart > $TimeEnd) $message = $message . "Invalid assigned time. Start time comes after the end time. <BR>";
            }
        }

        if($UserOptions!="ViewAll")
        {
            if($Username=="") $message = $message . "Please enter a username. <BR>";
        }

        if($ModuleOptions!="ViewAll")
        {
            if($Module=="") $message = $message . "Please enter a module. <BR>";
        }

        if($KeywordSearch!="Off")
        {
            if($Keyword=="") $message = $message . "Please enter a keyword or keywords to filter the log entries. <BR>";
        }

        if($IPAddressFilter!="Off")
        {
            if($IPAddress=="") $message = $message . "Please enter a full or partial IP address to filter the log entries. <BR>";
        }

        if($message=="") 
        {
            if($_POST['ViewMonitor'])
            {
                header("location: security_monitor2.php?DateTimeOptions=$DateTimeOptions&UserOptions=$UserOptions&ModuleOptions=$ModuleOptions&TimeStart=$TimeStart&TimeEnd=$TimeEnd&Username=$Username&Module=$Module&KeywordSearch=$KeywordSearch&Keyword=$Keyword&IPAddressOptions=$IPAddressOptions&IPAddress=$IPAddress");
            }
            else 
            {
                header("location: security_monitor3.php?DateTimeOptions=$DateTimeOptions&UserOptions=$UserOptions&ModuleOptions=$ModuleOptions&TimeStart=$TimeStart&TimeEnd=$TimeEnd&Username=$Username&Module=$Module&KeywordSearch=$KeywordSearch&Keyword=$Keyword&IPAddressOptions=$IPAddressOptions&IPAddress=$IPAddress");
            }
        }
        else
        {
            $TimeStart=$RealTimeStart;
            $TimeEnd=$RealTimeEnd;
        }
    }
}
$html_writer = new html;
$html_writer->draw_header('Security Monitor', $message, $message_type);
echo '<div class="superUltraHyperMegaOMFQBBQContainer">
    <fieldset class="top"> Review Actions Done on the System</fieldset>
    <fieldset class="middle">
    <table class="input_form" width="1100">';
?>
<input type=submit name=ViewMonitor value="VIEW SECURITY MONITOR" class=submit>
<input type=submit name=ViewMonitorPF value="PRINTABLE VIEW" class=submit>
<input type=submit name=cancel value="BACK" class=cancel>
<HR>

    <TABLE border=1  WIDTH=1100 class="listView" cellpadding="10">
    <TR class="listRowHead"><TD colspan="4">Monitor Settings</TD></TR>
    <TR class='listRowEven'><TD colspan=4>DATE & TIME RANGE Options: 
<?php
    if($DateTimeOptions!="ViewAll")
    {
        echo "<input type=radio name=DateTimeOptions value=ViewAll onClick='NoRange();'> Since beginning";
        echo "<input type=radio name=DateTimeOptions value=Specify onClick='WithRange();' checked> Specify date and time range";
    }
    else
    {
        echo "<input type=radio name=DateTimeOptions value=ViewAll onClick='NoRange();' checked> Since beginning";
        echo "<input type=radio name=DateTimeOptions value=Specify onClick='WithRange();'> Specify date and time range";
    }
?>
    </TD></TR>
    <TR class='listRowOdd'>
        <TD valign=top>START:</TD><TD><input type=text size=30 name=TimeStart value="<?php echo $TimeStart;?>"><BR>Sample: <span class=redHighlight>January 21 1986 6:25 am</span></TD>
        <TD valign=top>END:</TD><TD><input type=text size=30 name=TimeEnd value="<?php echo $TimeEnd;?>"><BR>Sample: <span class=redHighlight>January 21 1986 9:35 pm</span></TD>
    </TR>
    
    <TR class='listRowEven'><TD colspan=2>USER Options: 
<?php
    if($UserOptions!="ViewAll")
    {
        echo "<input type=radio name=UserOptions value=ViewAll onClick='AllUsers();'> All Users";
        echo "<input type=radio name=UserOptions value=Specify onClick='OneUser();' checked> Specify User";
    }
    else
    {
        echo "<input type=radio name=UserOptions value=ViewAll onClick='AllUsers();' checked> All Users";
        echo "<input type=radio name=UserOptions value=Specify onClick='OneUser();'> Specify User";
    }
?>
    <TD valign=top>Username:</TD>
    <TD>
        <input type=text size=15 name=Username value="<?php echo $Username;?>">
    </TD>
    </TR>
    
    <TR class='listRowOdd'><TD colspan=2>MODULE Options: 
<?php
    if($ModuleOptions!="ViewAll")
    {
        echo "<input type=radio name=ModuleOptions value=ViewAll onClick='AllModules();'> All Modules";
        echo "<input type=radio name=ModuleOptions value=Specify onClick='OneModule();' checked> Specify Module";
    }
    else
    {
        echo "<input type=radio name=ModuleOptions value=ViewAll onClick='AllModules();' checked> All Modules";
        echo "<input type=radio name=ModuleOptions value=Specify onClick='OneModule();'> Specify Modules";
    }
?>
    <TD valign=top>Module:</TD>
    <TD>
        <input type=text size=15 name=Module value="<?php echo $Module;?>">
    </TD>
    </TR>

    <TR class='listRowEven'><TD colspan=2>Keyword Search: 
<?php
    if($KeywordSearch!="Off")
    {
        echo "<input type=radio name=KeywordSearch value=Off onClick='KeywordSearchOff();'> Off";
        echo "<input type=radio name=KeywordSearch value=On onClick='KeywordSearchOn();' checked> On";
    }
    else
    {
        echo "<input type=radio name=KeywordSearch value=Off onClick='KeywordSearchOff();' checked> Off";
        echo "<input type=radio name=KeywordSearch value=On onClick='KeywordSearchOn();'> On";
    }
?>
    <TD valign=top>Keyword(s):</TD>
    <TD>
        <input type=text size=15 name=Keyword value="<?php echo $Keyword;?>">
    </TD>
    </TR>

    <TR class='listRowEven'><TD colspan=2>IP Address Filter: 
<?php
    if($IPAddressFilter!="Off")
    {
        echo "<input type=radio name=IPAddressOptions value=Off onClick='IPAddressFilterOff();'> Off";
        echo "<input type=radio name=IPAddressOptions value=On onClick='IPAddressFilterOn();' checked> On";
    }
    else
    {
        echo "<input type=radio name=IPAddressOptions value=Off onClick='IPAddressFilterOff();' checked> Off";
        echo "<input type=radio name=IPAddressOptions value=On onClick='IPAddressFilterOn();'> On";
    }
?>
    <TD valign=top>IP Filter:</TD>
    <TD>
        <input type=text size=15 name=IPAddress value="<?php echo $IPAddress;?>">
    </TD>
    </TR>
    </TABLE>
<HR>
<input type=submit name=ViewMonitor value="VIEW SECURITY MONITOR" class=submit>
<input type=submit name=ViewMonitorPF value="PRINTABLE VIEW" class=submit>
<input type=submit name=cancel value="BACK" class=cancel>
</TD></TR>
</TABLE>

<?php
echo '</table>';
echo '</div>';
$html_writer->draw_footer();
?>
<script language="Javascript">
function NoRange()
{
    window.document.MyForm.TimeStart.value='-NO RANGE-';
    window.document.MyForm.TimeEnd.value='-NO RANGE-'
}
function WithRange()
{
    if(window.document.MyForm.TimeStart.value=='-NO RANGE-') window.document.MyForm.TimeStart.value='';
    if(window.document.MyForm.TimeEnd.value=='-NO RANGE-') window.document.MyForm.TimeEnd.value=''
}
function AllUsers()
{
    window.document.MyForm.Username.value='-ALL USERS-';
}
function OneUser()
{
    if(window.document.MyForm.Username.value=='-ALL USERS-') window.document.MyForm.Username.value='';
}
function AllModules()
{
    window.document.MyForm.Module.value='-ALL MODULES-';
}
function OneModule()
{
    if(window.document.MyForm.Module.value=='-ALL MODULES-') window.document.MyForm.Module.value='';
}
function KeywordSearchOff()
{
    window.document.MyForm.Keyword.value='-NO KEYWORDS-';
}
function KeywordSearchOn()
{
    if(window.document.MyForm.Keyword.value=='-NO KEYWORDS-') window.document.MyForm.Keyword.value='';
}
function IPAddressFilterOff()
{
    window.document.MyForm.IPAddress.value='-NO IP ADDRESS-';
}
function IPAddressFilterOn()
{
    if(window.document.MyForm.IPAddress.value=='-NO IP ADDRESS-') window.document.MyForm.IPAddress.value='';
}

</script>
<?php

