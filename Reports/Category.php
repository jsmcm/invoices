<?php
     session_start();
     
     require_once("../users/class.User.php");
     require_once("class.Reports.php");
     
     $NewReport = new Report();
     $User = new User();

     $StartDate = $_REQUEST["StartDate"];
     $EndDate = $_REQUEST["EndDate"];

     $NewReport->CategoryReport($StartDate, $EndDate, $MonthlyExpenseArray, $ArrayCount, $User->GetAccountID());


?>

<b>Monthly Expense Report <?php print substr($StartDate, 0, 4)."-".substr($StartDate, 4, 2)."-".substr($StartDate, 6, 2); ?> to <? print substr($EndDate, 0, 4)."-".substr($EndDate, 4, 2)."-".substr($EndDate, 6, 2); ?></b>
<p>
<table width="90%" cellpadding="0" cellspacing="0" border="0">
<tr>
     <td width="50%" style="border-style:solid; border-color:black; border-width:2px; border-right-width:0;">
          <b>Month</b>
     </td>
     <td style="border-style:solid; border-color:black; border-width:2px; border-left-width:0;">
          <b>Category</b>
     </td>
     <td style="border-style:solid; border-color:black; border-width:2px; border-left-width:0;">
          <b>Expenses</b>
     </td>     
</tr>
<?php
$Total = 0;

if($ArrayCount > 0)
{
     $YearBuffer = substr($MonthlyExpenseArray[0]["Month"], 0, 4);
}

for($x = 0; $x < $ArrayCount; $x++)
{
     if($YearBuffer != $MonthlyExpenseArray[$x]["Month"])
     {
          $YearBuffer = $MonthlyExpenseArray[$x]["Month"];

          print "<tr>";
               print "<td>";
                    print "&nbsp;";
               print "</td>";
               print "<td>";
                    print "&nbsp;";
               print "</td>";
               print "<td>";
                    print "&nbsp;";
               print "</td>";               
          print "</tr>";
     
     }

     print "<tr>";
          print "<td>";
               print substr($MonthlyExpenseArray[$x]["Month"], 0, 4)."-".substr($MonthlyExpenseArray[$x]["Month"], 4, 2);
          print "</td>";
          print "<td>";
               print $MonthlyExpenseArray[$x]["Category"];
          print "</td>";          
          print "<td>";
               print $MonthlyExpenseArray[$x]["Amount"];
          print "</td>";
     print "</tr>";

     $Total = $Total + $MonthlyExpenseArray[$x]["Amount"];

}

if($Total > 0)
{
     print "<tr>";
          print "<td colspan=\"2\" style=\"border-top-style:solid; border-top-color:black; border-top-width:1px;\">";
               print "<b>TOTAL</b>";
          print "</td>";
          print "<td style=\"border-top-style:solid; border-top-color:black; border-top-width:1px;\">";
               print "<b>".$Total."<b>";
          print "</td>";
     print "</tr>";
}
?>

</table>