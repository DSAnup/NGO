<?php
namespace sPHP;
$Entity = "LoanTransaction";
#region Entity management common configuration

#region List
SetVariable("Keyword2", $_POST['LoanID']);
// DebugDump($_POST);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	"LT.LoanID = " . $_POST['Keyword2'] . "",
	
	SetVariable("Keyword") ? "(
			LT.{$Entity}ID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));

$RecoredSet = $Database->Query("
								SELECT 			COUNT(0) AS TerminalCount, LT.LoanID
								FROM			ims_loantransaction AS LT
								WHERE			{$WhereClause};

								SELECT 			LT.LoanTransactionPayableDate,
												LT.LoanTransactionIsPaid,
												LT.LoanTransactionPaidDate,
												IF(LT.LoanTransactionIsPaid = 1, LT.LoanTransactionPaidDate, '') AS PaidDate,
												LT.LoanTransactionID
								FROM			ims_loantransaction AS LT
									LEFT JOIN 	ims_loan AS L ON L.LoanID = LT.LoanID
								WHERE				{$WhereClause}
								ORDER BY 			LT.LoanTransactionID ASC
								LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 100)) . ", {$_POST["RecordCountPerPage"]};		

								SELECT 			CONCAT(L.LoanPrefix, '_', L.LoanID) AS LoanIdentity,
												U.UserSignInName AS Customer,
												L.LoanDate,
												LS.LoanSchemePayPerInstallment AS PerInstallment
								FROM			ims_loan AS L
									LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
									LEFT JOIN	ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
								WHERE			L.LoanID = {$_POST['LoanID']};
");
$EM = new EntityManagement($Table[$Entity = "LoanTransaction"]);
$EM->ValidateInput(function($Entity, $Database, $Table, $PrimaryKey, $ID){
	$Result = true;

	return $Result;
});

$EM->ThumbnailColumn("x{$Entity}Picture");

$EM->BeforeInput(function($Entity, $Record){

	return true;
});
// DebugDump($RecoredSet[1]);
if(isset($_POST["btnInput"])){
	$NewRecordMode = isset($_POST["{$Entity}ID"]) && intval($_POST["{$Entity}ID"]) ? false : true;

	if(isset($_POST["btnSubmit"])){
		#region Custom code
		$_POST["{$Entity}PaidDate"] = "{$_POST["{$Entity}PaidDateDate"]} {$_POST["{$Entity}PaidDateTime"]}:00";
		#endregion Custom code
		if($EM->Input()){

			$Terminal->Redirect("{$_POST["_Referer"]}&SucceededAction=Input"); // Redirect to previous location
			
			// echo "myFunction();";
		}

	}

	$EM->LoadExistingData();
	#region Custom code
	if(isset($_POST["{$Entity}PaidDate"]) && $_POST["{$Entity}PaidDate"]){
		$PaidDate = strtotime($_POST["{$Entity}PaidDate"]);
		$_POST["{$Entity}PaidDateDate"] = date("Y-m-d", $PaidDate);
		$_POST["{$Entity}PaidDateTime"] = date("H:i", $PaidDate);
	}
	#endregion Custom code

	$EM->InputUIHTML([
		HTML\UI\Field(HTML\UI\Input("{$Entity}PaidDate" . ($Caption = "") . "Date", $EM->InputDateWidth(), date("Y-m-d"), null, INPUT_TYPE_DATE) . HTML\UI\Input("{$Entity}PaidDate" . ($Caption = "") . "Time", $Configuration["InputTimeWidth"], date("H:i"), null, INPUT_TYPE_TIME), "PaidDate", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\RadioGroup("{$Entity}Is" . ($Caption = "Paid") . "", [new HTML\UI\Radio(1, "Yes"), new HTML\UI\Radio(0, "No")]), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
	]);

	print $EM->InputHTML();
}
$CreateCustomDataGrid = new HTML\UI\Datagrid(
	isset($RecoredSet[1]) ? $RecoredSet[1]: null,
	$Application->URL($_POST['_Script'], "Keyword=" . SetVariable("Keyword") . "". "&LoanID=" . SetVariable("Keyword2") . ""),
	$RecoredSet[0][0]["TerminalCount"],
	[
		new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "PayableDate") . "", "Next Pay Day", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "PaidDate") . "", "Paid Date", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "IsPaid") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON, null),
	],
	"View",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}edit.png", null, $Application->URL($_POST['_Script'], "btnInput" . "&Keyword=" . SetVariable("Keyword") . "". "&LoanID=" . SetVariable("Keyword2") . ""),null, null, null, "Edit", null, null),
	],
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
			"OnChange" => "window.location.href = '{$Application->URL($_POST["_Script"])}&RecordCountPerPage=' + this.value + '&LoanID={$_POST["Keyword2"]}&Keyword={$_POST["Keyword"]}'",
		]) . " rows visible
	"
	,
	"
		<h4 class=\"AlignCenter\">Loan No : " . $RecoredSet[2][0]["LoanIdentity"] . "</h4>	
		<h5 class=\"AlignCenter\">Name : " . $RecoredSet[2][0]["Customer"] . "</h5>
		<h5 class=\"AlignCenter\">Date : " . $RecoredSet[2][0]["LoanDate"] . "</h5>
		<h5 class=\"AlignCenter\">Per Installment : " . $RecoredSet[2][0]["PerInstallment"] . "</h5>
		<h5 class=\"AlignRight\">" . HTML\UI\Button("" . ($Caption = "") . "", null, null, null, "myFunction()", null, null, null, "Print", "{$Environment->IconURL()}print.png") . "</h5>
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

 <script>
	function myFunction() {
		window.print();
	}
</script>