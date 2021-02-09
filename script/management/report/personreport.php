<?php
namespace sPHP;

// var_dump($_POST["PersonID"]);
$Entityid = $_POST["PersonID"];
$Person = $Database->Query("SELECT * FROM sphp_person where sphp_person.PersonID ='".$Entityid."'");
$PersonAddress = $Database->Query("SELECT  p.PersonName, p.PersonNote, c.CountryName, pa.* from sphp_person as p  	
                                    left join sphp_personaddress as pa
                                    on p.PersonID = pa.PersonID
                                    left join sphp_country as c on pa.CountryID = c.CountryID
                                    where p.PersonID ='".$Entityid."'");
$PersonPhone= $Database->Query("SELECT COUNT(0) AS TerminalCount2,p.PersonName, p.PersonNote, pp.* from sphp_person as p  										
                                    left join sphp_personphone as pp
                                    on pp.PersonID = p.PersonID
                                    where p.PersonID ='".$Entityid."'");
DebugDump($PersonAddress[0]);
echo count($PersonAddress[0]);
print $PersonPhone[0][0]["TerminalCount2"] ? "
        <!-- YOU CAN PUT SOME CONTENT HERE -->
        " . HTML\UI\Datagrid(
            $PersonPhone[0], 
            null, 
            $PersonPhone[0][0]["TerminalCount2"], 
            [
                new HTML\UI\Datagrid\Column("" . ($Caption = "PersonPhoneNumber") . "", "{$Caption}", null, null),
            ],
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            "Generated on " . date("r") . "", 
            null, 
            null, 
            null, 
            null, 
            false, 
            null, 
            null, 
            null, 
            null, 
            null
        ) . "
        <!-- YOU CAN PUT SOME CONTENT HERE -->
    " : HTML\UI\MessageBox("Sorry, no information is available at this moment!", "Information");
echo "<button onclick='printData()'>Print me</button>";
echo "<table style='width:100%' class='List' id='printTable'>
  <tr>
    <th colspan='2'>Heading One Person Details</th>
  </tr>
  <tr>
    <td>Name</td>
    <td>{$Person[0][0]['PersonName']}</td>
  </tr>
  <tr>
    <td>Person Note</td>
    <td>{$Person[0][0]['PersonNote']}</td>
  </tr>
  <tr>
    <th colspan='2'>Heading Two Person Address</th>
  </tr>";
  $i = 0;
foreach ($PersonAddress[0] as $key) { $i++;
    echo "
    <tr>
        <th colspan='2'>Address {$i}</th>
    </tr>
    <tr>
    <td>Address</td>
        <td>{$key['PersonAddressName']}</td>
    </tr>
    <tr>
    <td>Street</td>
        <td>{$key['PersonAddressStreet']}</td>
    </tr>
    <tr>
    <td>City</td>
        <td>{$key['PersonAddressCity']}</td>
    </tr>
    <tr>
        <td>State</td>
        <td>{$key['PersonAddressState']}</td>
    </tr>
    <tr>
        <td>Country</td>
        <td>{$key['CountryName']}</td>
    </tr>
  ";
}
echo "<tr>
<th colspan='2'>Heading Three Person Phone Number</th>
</tr>";
$j = 0;
foreach ($PersonPhone[0] as $key) { $j++;
    echo "<tr>
    <td >Phone Number {$j}</td>
    <td>{$key['PersonPhoneNumber']}</td>
  </tr>";
}
echo "</table>";


?>

<script>
    function printData()
        {
            var divToPrint = document.getElementById('printTable');
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
                'border:1px solid #000;' +
                'padding:0.2em;' +
                '}' +
                '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        }

    // jQuery('button').on('click',function(){
    //     printData();
    // })
</script>
