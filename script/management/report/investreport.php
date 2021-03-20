<?php
namespace sPHP;
print "
	<h1>Invest Report</h1>

	" . HTML\UI\Form(
		$Application->URL($_POST["_Script"]),
		"

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "From", $Configuration["InputDateWidth"], date("Y-m-01"), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "From", $Configuration["InputTimeWidth"], "00:00", null, INPUT_TYPE_TIME),
				"{$Caption}From", null, true
			) . "

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "To", $Configuration["InputDateWidth"], date("Y-m-t"), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "To", $Configuration["InputTimeWidth"], "23:59", null, INPUT_TYPE_TIME),
				"{$Caption}To", null, true
			) . "
            " . HTML\UI\Field(
				HTML\UI\Select("InvestTransactionIs" . ($Caption = "Paid") . "", [new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true
			) . "
			" . HTML\UI\Button("" . ($Caption = "") . "", BUTTON_TYPE_SUBMIT, "btnSubmit", null, ["OnClick"=>"LoadingPopup();", ], null, null, null, "{$Caption}", "{$Environment->IconURL()}search.png") . "
			" . HTML\UI\Button("" . ($Caption = "") . "", BUTTON_TYPE_SUBMIT, "btnDownload", null, null, null, "{$Caption}", null, "{$Caption}", "{$Environment->IconURL()}download.png") . "
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
                        IF(IT.InvestTransactionIsPaid = 1, IT.InvestTransactionPaidDate, '') AS Paid,
                        IT.InvestTransactionIsPaid,
                        U.UserSignInName AS Client,
						U.UserPhoneMobile,
                        I.InvestDate,
                        CONCAT(I.InvestPrefix, '_', I.InvestID) AS InvestIdentity,
                        ISS.InvestSchemeSettingsPayPerInstallment AS PerInstallment

		FROM			ims_investtransaction AS IT
            LEFT JOIN	ims_invest AS I ON I.InvestID = IT.InvestID
			LEFT JOIN	sphp_user AS U ON U.UserID = I.UserID
			LEFT JOIN	ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
		WHERE			{$WhereClause}
		ORDER BY		IT.InvestTransactionPayableDate ASC
");
// DebugDump("<pre>{$SQL}</pre>");
// DebugDump($Recordset[0]);
$PrintHTML = null;
// print $Template->Content("Dashboard Graph", null, null, 0);

if(isset($Recordset[0])){

	$TotalAmount = $Database->Query($SQL = "
			SELECT			SUM(ISS.InvestSchemeSettingsPayPerInstallment) AS TOTALAMOUNT
			FROM			ims_investtransaction AS IT
				LEFT JOIN	ims_invest AS I ON I.InvestID = IT.InvestID
				LEFT JOIN	ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
			WHERE			{$WhereClause};
	");
	
	$RecordNumber = 0;
	$HTML[] = "
					<table class=\"ReportTable\">
						<thead>
							<th class=\"AlignRight\">Sl</th>
							<th>Identity</th>
							<th>Investor</th>
							<th>Mobile</th>
							<th>Create</th>
							<th>Payable</th>
							<th>Paid</th>
							<th>Amount</th>
						</thead>

						<tbody>
				";
	
	foreach($Recordset[0] as $Data){
		$RecordNumber++;

		$HTML[] = "
					<tr>
						<td class=\"AlignRight\">" . $RecordNumber . "</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Identity</span>{$Data["InvestIdentity"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Investor</span>{$Data["Client"]}</td>
						<td class=\"AlignCenter\"><span class=\"FieldCaption\">Mobile</span>{$Data["UserPhoneMobile"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Create</span>".date("M d, Y", strtotime($Data['InvestDate']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Payable</span>".date("M d, Y", strtotime($Data['Payable']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Paid</span>{$Data["Paid"]}</td>
						<td class=\"AlignCenter\"><span class=\"FieldCaption\">Amount</span>{$Data["PerInstallment"]}</td>
					</tr>
				";

		$CSVRow[] = [
			($Field = "#") 						=> $RecordNumber, 
			($Field = "Identity") 				=> $Data["InvestIdentity"], 
			($Field = "Investor") 				=> $Data["Client"], 
			($Field = "Invest Date") 			=> $Data["InvestDate"], 
			($Field = "Payable Date") 			=> $Data["Payable"], 
			($Field = "Paid Date") 				=> $Data["Paid"], 
			($Field = "Per Installment") 		=> $Data["PerInstallment"], 
		];
	}
	$HTML[] = "
				</tbody>
				<tfoot>
					<tr>
						<td class=\"Alignleft\" colspan=\"7\">Total</td>
						<td class=\"AlignCenter\">{$TotalAmount[0][0]['TOTALAMOUNT']}</td>
					</tr>
				</tfoot>
				</table>
			";

	print "
			" . implode(null, $HTML) . "

		";
	if(isset($_POST["btnDownload"])){
		$Terminal->LetDownload($CSVRow, null, "Invest Report " . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
	}
	
}

?>

<script>
	function myFunction() {
		window.print();
	}
</script>