<?php
namespace sPHP;
print "
	<h1>Loan Report</h1>

	" . HTML\UI\Form(
		$Application->URL($_POST["_Script"]),
		"

			" . HTML\UI\Field(
				HTML\UI\Input("LoanTransactionPayableDate" . ($Caption = "") . "From", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('-30 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("LoanTransactionPayableDatetime" . ($Caption = "") . "From", $Configuration["InputTimeWidth"], "00:00", null, INPUT_TYPE_TIME),
				"{$Caption}From", null, true
			) . "

			" . HTML\UI\Field(
				HTML\UI\Input("LoanTransactionPayableDate" . ($Caption = "") . "To", $Configuration["InputDateWidth"], date("Y-m-d"), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("LoanTransactionPayableDatetime" . ($Caption = "") . "To", $Configuration["InputTimeWidth"], "23:59", null, INPUT_TYPE_TIME),
				"{$Caption}To", null, true
			) . "
            " . HTML\UI\Field(
				HTML\UI\Select("LoanTransactionIs" . ($Caption = "Paid") . "", [new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true
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
		IT.LoanTransactionPayableDate >= '{$Database->Escape("{$_POST["LoanTransactionPayableDateFrom"]} {$_POST["LoanTransactionPayableDatetimeFrom"]}:00")}'
			AND			IT.LoanTransactionPayableDate <= '{$Database->Escape("{$_POST["LoanTransactionPayableDateTo"]} {$_POST["LoanTransactionPayableDatetimeTo"]}:00")}'
			AND			IT.LoanTransactionIsActive = 1
            AND         IT.LoanTransactionIsPaid = '{$_POST["LoanTransactionIsPaid"]}'
)",

]));

$Recordset = $Database->Query($SQL = "
		SELECT			IT.LoanTransactionPayableDate AS Payable,
                        IT.LoanTransactionPaidDate AS Paid,
                        IT.LoanTransactionIsPaid,
                        U.UserSignInName AS Client,
                        I.LoanDate,
                        CONCAT(I.LoanPrefix, '_', I.LoanID) AS LoanIdentity,
                        ISS.LoanSchemePayPerInstallment AS PerInstallment

		FROM			ims_Loantransaction AS IT
            LEFT JOIN	ims_Loan AS I ON I.LoanID = IT.LoanID
            LEFT JOIN	sphp_user AS U ON U.UserID = I.UserID
			LEFT JOIN	ims_Loanscheme AS ISS ON ISS.LoanSchemeID = I.LoanSchemeID
		WHERE			{$WhereClause}
		ORDER BY		IT.LoanTransactionPayableDate ASC
");
// DebugDump("<pre>{$SQL}</pre>");
// DebugDump($Recordset[1][0]['TOTALAMOUNT']);
$PrintHTML = null;
// print $Template->Content("Dashboard Graph", null, null, 0);

if(isset($Recordset[0])){

	$TotalAmount = $Database->Query($SQL = "
			SELECT			SUM(ISS.LoanSchemePayPerInstallment) AS TOTALAMOUNT
			FROM			ims_Loantransaction AS IT
				LEFT JOIN	ims_Loan AS I ON I.LoanID = IT.LoanID
				LEFT JOIN	ims_Loanscheme AS ISS ON ISS.LoanSchemeID = I.LoanSchemeID
			WHERE			{$WhereClause};
	");

	$RecordNumber = 0;
	$HTML[] = "
					<table class=\"ReportTable\">
						<thead>
							<th class=\"AlignRight\">Sl</th>
							<th>Loan No</th>
							<th>Borrower</th>
							<th>Loan Creation</th>
							<th>Payable Date</th>
							<th>Paid Date</th>
							<th>Amount</th>
						</thead>

						<tbody>
				";
	
	foreach($Recordset[0] as $Data){
		$RecordNumber++;

		$HTML[] = "
					<tr>
						<td class=\"AlignRight\">" . $RecordNumber . "</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Loan No</span>{$Data["LoanIdentity"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Borrower</span>{$Data["Client"]}</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Loan Creation</span>".date("M d, Y", strtotime($Data['LoanDate']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Payable Date</span>".date("M d, Y", strtotime($Data['Payable']))."</td>
                        <td class=\"AlignCenter\"><span class=\"FieldCaption\">Paid Date</span>{$Data["Paid"]}</td>
						<td class=\"AlignCenter\"><span class=\"FieldCaption\">Amount</span>{$Data["PerInstallment"]}</td>
					</tr>
				";

		$CSVRow[] = [
			($Field = "#") 						=> $RecordNumber, 
			($Field = "Identity") 				=> $Data["LoanIdentity"], 
			($Field = "Borrower") 				=> $Data["Client"], 
			($Field = "Loan Date") 			=> $Data["LoanDate"], 
			($Field = "Payable Date") 			=> $Data["Payable"], 
			($Field = "Paid Date") 				=> $Data["Paid"], 
			($Field = "Per Installment") 		=> $Data["PerInstallment"], 
		];
	}
	$HTML[] = "
				</tbody>
				<tfoot>
					<tr>
						<td class=\"Alignleft\" colspan=\"6\">Total</td>
						<td class=\"AlignCenter\">{$TotalAmount[0][0]['TOTALAMOUNT']}</td>
					</tr>
				</tfoot>
				</table>
			";

	print "
			" . implode(null, $HTML) . "

		";
	if(isset($_POST["btnDownload"])){
		$Terminal->LetDownload($CSVRow, null, "Loan Report " . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
	}
	
}

?>

<script>
	function myFunction() {
		window.print();
	}
</script>