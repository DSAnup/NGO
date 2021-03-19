<?php
namespace sPHP;

$Entity = "Loan";

print "
	<h1>Search Unpaid Loan</h1>

	" . HTML\UI\Form(
		$Application->URL($_POST["_Script"]),
		"

			" . HTML\UI\Field(
				HTML\UI\Input("LoanTransactionPayableDate" . ($Caption = "") . "From", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('-15 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("LoanTransactionPayableDatetime" . ($Caption = "") . "From", $Configuration["InputTimeWidth"], "00:00", null, INPUT_TYPE_TIME),
				"{$Caption}From", null, true
			) . "

			" . HTML\UI\Field(
				HTML\UI\Input("LoanTransactionPayableDate" . ($Caption = "") . "To", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('+15 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("LoanTransactionPayableDatetime" . ($Caption = "") . "To", $Configuration["InputTimeWidth"], "23:59", null, INPUT_TYPE_TIME),
				"{$Caption}To", null, true
			) . "
			" . HTML\UI\Button("" . ($Caption = "") . "", BUTTON_TYPE_SUBMIT, "btnSubmit", null, ["OnClick"=>"LoadingPopup();", ], null, null, null, "{$Caption}", "{$Environment->IconURL()}search.png") . "
		",
		"", // Set to empty to suppress Submit button
		null, null, null, null, null, null,
		"" // Set to empty to suppress Reset button
	) . "
";

// SetVariable("Keyword", $_POST['Keyword']);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	"(
		LT.LoanTransactionPayableDate >= '{$Database->Escape("{$_POST["LoanTransactionPayableDateFrom"]} {$_POST["LoanTransactionPayableDatetimeFrom"]}:00")}'
			AND			LT.LoanTransactionPayableDate <= '{$Database->Escape("{$_POST["LoanTransactionPayableDateTo"]} {$_POST["LoanTransactionPayableDatetimeTo"]}:00")}'
			AND			LT.LoanTransactionIsActive = 1
            AND         LT.LoanTransactionIsPaid = 0
)",
	SetVariable("Keyword") ? "(
			U.UserSignInName LIKE '%{$_POST["Keyword"]}%'
			OR U.UserPhoneMobile LIKE '%{$_POST["Keyword"]}%'
			OR LT.LoanID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));
// DebugDump($_POST);

$RecoredSet = $Database->Query("
							SELECT 			COUNT(0) AS PaidCount
							FROM 			ims_loantransaction AS LT
								LEFT JOIN	ims_loan AS L ON L.LoanID = LT.LoanID
								LEFT JOIN	ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
							WHERE			{$WhereClause};

							SELECT 			LT.LoanID,
											LT.LoanTransactionPayableDate AS PayDate,
											U.UserSignInName,
											U.UserPhoneMobile,
											L.LoanDate,
											CONCAT(L.LoanPrefix, '_', L.LoanID) AS LoanIdentity,
											LS.LoanSchemePayPerInstallment AS PerInstallment
							FROM 			ims_loantransaction AS LT
								LEFT JOIN	ims_loan AS L ON L.LoanID = LT.LoanID
								LEFT JOIN	ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
							WHERE			{$WhereClause}
							LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 20)) . ", {$_POST["RecordCountPerPage"]}		
							;

");

if(isset($_POST["btnExport"])){
	foreach($RecoredSet[1] as $RecordIndex => $Record)$CSVRow[] = [
		($Field = "#") 					=> $RecordIndex + 1, 
		($Field = "Task") 				=> $Record["LoanID"], 
		($Field = "User") 				=> $Record["UserSignInName"], 
	];
	$Terminal->LetDownload($CSVRow, null, "ThisPayment" . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
}
// DebugDump($RecoredSet[1][0]);
$CreateCustomDataGrid = new HTML\UI\Datagrid(
	isset($RecoredSet[1]) ? $RecoredSet[1]: null,
	$Application->URL($_POST['_Script'], "Keyword=" . SetVariable("Keyword") . ""),
	$RecoredSet[0][0]["PaidCount"],
	[
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LoanIdentity", "Loan Number", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "UserSignInName", "Borrower", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "UserPhoneMobile", "Mobile", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LoanDate", "Loan Creation", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PayDate", "Payable Date", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PerInstallment", "Installment Amount", null, null),
	],
	"Unpaid List",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}view.png", null, $Application->URL("Loan/LoanView", "btnSubmit"), "_blank", null, null, "View", null, null),
	]
	,
	null,
	null,
	"
		<br>
		" . HTML\UI\Select("RecordCountPerPage", [
			new Option(10),
			new Option(20),
			new Option(50),
			new Option(100),
			new Option(200),
			new Option(500),
		], null, null, null, null, null, null, [
			"OnChange" => "window.location.href = '{$Application->URL($_POST["_Script"])}&RecordCountPerPage=' + this.value + '&Keyword={$_POST["Keyword"]}'",
		]) . " rows visible
	"
	,
	"
		" . HTML\UI\Input("Keyword", null, null, null, null, null, "Search") . "
		<input type=\"hidden\" name=\"Page\" value=\"1\">
	"
	,
	null,
	null,
	null,
	false,
	null,
	null,
	"Sl."

);
?>
<style>
    .Datagrid > .Content > .Grid > tbody > tr > td > .Suspended{height: 40px; color: Red; text-decoration: none;}
</style>
<?=$CreateCustomDataGrid->HTML()?>
