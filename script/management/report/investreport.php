<?php
namespace sPHP;
print "
	<h1>Invest Report</h1>

	" . HTML\UI\Form(
		$Application->URL($_POST["_Script"]),
		"

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "From", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('-7 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "From", $Configuration["InputTimeWidth"], "00:00", null, INPUT_TYPE_TIME),
				"{$Caption}From", null, true
			) . "

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "To", $Configuration["InputDateWidth"], date("Y-m-d"), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "To", $Configuration["InputTimeWidth"], "23:59", null, INPUT_TYPE_TIME),
				"{$Caption}To", null, true
			) . "
            " . HTML\UI\Field(
				HTML\UI\Select("InvestTransactionIs" . ($Caption = "Paid") . "", [new Option(), new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true
			) . "
			" . HTML\UI\Button("" . ($Caption = "") . "", BUTTON_TYPE_SUBMIT, "btnSubmit", null, ["OnClick"=>"LoadingPopup();", ], null, null, null, "{$Caption}", "{$Environment->IconURL()}search.png") . "
			" . HTML\UI\Button("" . ($Caption = "Download") . "", BUTTON_TYPE_SUBMIT, "btnDownload", null, null, null, "{$Caption}", null, "{$Caption}", "{$Environment->IconURL()}download.png") . "
			" . HTML\UI\Button("" . ($Caption = "") . "", null, null, null, "myFunction()", null, "Print", null, "Print", "{$Environment->IconURL()}print.png") . "
		",
		"", // Set to empty to suppress Submit button
		null, null, null, null, null, null,
		"" // Set to empty to suppress Reset button
	) . "
";
// DebugDump($_POST);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	 "(
		IT.InvestTransactionPayableDate >= '{$Database->Escape("{$_POST["InvestTransactionPayableDateFrom"]} {$_POST["InvestTransactionPayableDatetimeFrom"]}:00")}'
			AND			IT.InvestTransactionPayableDate <= '{$Database->Escape("{$_POST["InvestTransactionPayableDateTo"]} {$_POST["InvestTransactionPayableDatetimeTo"]}:00")}'
			AND			IT.InvestTransactionIsActive = 1
            AND         IT.InvestTransactionIsPaid = '{$_POST["InvestTransactionIsPaid"]}'
)",

]));

$Recordset = $Database->Query($SQL = "
		SELECT			IT.InvestTransactionPayableDate AS Payable,
                        IT.InvestTransactionPaidDate AS Paid,
                        IT.InvestTransactionIsPaid,
                        U.UserSignInName AS Client,
                        I.InvestDate,
                        CONCAT(I.InvestPrefix, '_', I.InvestID) AS InvestIdentity,
                        ISS.InvestSchemeSettingsPayPerInstallment AS PerInstallment

		FROM			ims_investtransaction AS IT
            LEFT JOIN	sphp_user AS U ON U.UserID = IT.UserIDInserted
            LEFT JOIN	ims_invest AS I ON I.InvestID = IT.InvestID
			LEFT JOIN	ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
		WHERE			{$WhereClause}
		ORDER BY		IT.InvestTransactionPayableDate ASC

");
// DebugDump("<pre>{$SQL}</pre>");
// DebugDump($Recordset[0]);
$PrintHTML = null;
// print $Template->Content("Dashboard Graph", null, null, 0);

if(isset($Recordset[0])){

	$RecordNumber = 0;
	$HTML[] = "
					<table class=\"ReportTable\">
						<thead>
							<th class=\"AlignRight\">Sl</th>
							<th>Invest No</th>
							<th>Investor</th>
							<th>Invest Creation</th>
							<th>Payable Date</th>
							<th>Paid Date</th>
							<th>Installment Amount</th>
						</thead>

						<tbody>
				";
	
	foreach($Recordset[0] as $Data){
		$RecordNumber++;

		$HTML[] = "
					<tr>
						<td class=\"AlignRight\">" . $RecordNumber . "</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Invest No</span>{$Data["InvestIdentity"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Investor</span>{$Data["Client"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Invest Creation</span>".date("M d, Y", strtotime($Data['InvestDate']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Payable Date</span>".date("M d, Y", strtotime($Data['Payable']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Paid Date</span>{$Data["Paid"]}</td>
						<td class=\"AlignCenter\"><span class=\"FieldCaption\">Installment Amount</span>{$Data["PerInstallment"]}</td>
					</tr>
				";

		// $CSVRow[] = [
		// 	($Field = "#") 					=> $RecordNumber, 
		// 	($Field = "Task") 				=> $Data["TaskName"], 
		// 	($Field = "Source") 			=> $Data["SourceName"], 
		// 	($Field = "Project") 			=> $Data["ProjectName"], 
		// 	($Field = "Priority") 			=> $Data["PriorityName"], 
		// 	($Field = "Status") 			=> $Data["StatusName"], 
		// 	($Field = "Acknowledgement") 	=> $Data["AcknowledgeName"], 
		// 	($Field = "Type") 				=> $Data["TypeName"], 
		// 	($Field = "Reference") 			=> $Data["TaskReference"],
		// 	($Field = "Reference") 			=> $Data["TaskReference"],
		// 	($Field = "Accessibility") 		=> $Data["TaskAccessibility"],
		// 	($Field = "Comment") 			=> $Data["TaskComment"],
		// 	($Field = "Assign Date") 		=> $Data["InvestTransactionPayableDate"], 
		// 	($Field = "Expected Date") 		=> $Data["TaskDateExpected"], 
		// 	($Field = "Delivery Date") 		=> $Data["TaskDateDelivery"],  
		// ];
	}
	$HTML[] = "
				</tbody>
				</table>
			";

	print "
			" . implode(null, $HTML) . "

		";
	// if(isset($_POST["btnDownload"])){
	// 	$Terminal->LetDownload($CSVRow, null, "Report " . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
	// }
	
}

?>

<script>
	function myFunction() {
		window.print();
	}
</script>