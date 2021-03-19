<?php
namespace sPHP;

$Entity = "Invest";

print "
	<h1>Search Unpaid Invest</h1>

	" . HTML\UI\Form(
		$Application->URL($_POST["_Script"]),
		"

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "From", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('-15 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "From", $Configuration["InputTimeWidth"], "00:00", null, INPUT_TYPE_TIME),
				"{$Caption}From", null, true
			) . "

			" . HTML\UI\Field(
				HTML\UI\Input("InvestTransactionPayableDate" . ($Caption = "") . "To", $Configuration["InputDateWidth"], date("Y-m-d" , strtotime('+15 days')), null, INPUT_TYPE_DATE) .
				HTML\UI\Input("InvestTransactionPayableDatetime" . ($Caption = "") . "To", $Configuration["InputTimeWidth"], "23:59", null, INPUT_TYPE_TIME),
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
		LT.InvestTransactionPayableDate >= '{$Database->Escape("{$_POST["InvestTransactionPayableDateFrom"]} {$_POST["InvestTransactionPayableDatetimeFrom"]}:00")}'
			AND			LT.InvestTransactionPayableDate <= '{$Database->Escape("{$_POST["InvestTransactionPayableDateTo"]} {$_POST["InvestTransactionPayableDatetimeTo"]}:00")}'
			AND			LT.InvestTransactionIsActive = 1
            AND         LT.InvestTransactionIsPaid = 0
)",
	SetVariable("Keyword") ? "(
			U.UserSignInName LIKE '%{$_POST["Keyword"]}%'
			OR U.UserPhoneMobile LIKE '%{$_POST["Keyword"]}%'
			OR LT.InvestID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));
// DebugDump($_POST);

$RecoredSet = $Database->Query("
							SELECT 			COUNT(0) AS PaidCount
							FROM 			ims_investtransaction AS LT
								LEFT JOIN	ims_invest AS L ON L.InvestID = LT.InvestID
								LEFT JOIN	ims_investschemesettings AS LS ON LS.InvestSchemeSettingsID = L.InvestSchemeSettingsID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
							WHERE			{$WhereClause};

							SELECT 			LT.InvestID,
											LT.InvestTransactionPayableDate AS PayDate,
											U.UserSignInName,
											U.UserPhoneMobile,
											L.InvestDate,
											CONCAT(L.InvestPrefix, '_', L.InvestID) AS InvestIdentity,
											LS.InvestSchemeSettingsPayPerInstallment AS PerInstallment
							FROM 			ims_investtransaction AS LT
								LEFT JOIN	ims_invest AS L ON L.InvestID = LT.InvestID
								LEFT JOIN	ims_investschemesettings AS LS ON LS.InvestSchemeSettingsID = L.InvestSchemeSettingsID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
							WHERE			{$WhereClause}
							LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 20)) . ", {$_POST["RecordCountPerPage"]}		
							;

");

if(isset($_POST["btnExport"])){
	foreach($RecoredSet[1] as $RecordIndex => $Record)$CSVRow[] = [
		($Field = "#") 					=> $RecordIndex + 1, 
		($Field = "Task") 				=> $Record["InvestID"], 
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
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "InvestIdentity", "Invest Number", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "UserSignInName", "Investor", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "UserPhoneMobile", "Mobile", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "InvestDate", "Invest Creation", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PayDate", "Payable Date", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PerInstallment", "Installment Amount", null, null),
	],
	"Unpaid List",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}view.png", null, $Application->URL("Invest/InvestView", "btnSubmit"), "_blank", null, null, "View", null, null),
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
