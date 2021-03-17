<?php
namespace sPHP;
$Entity = "InvestTransaction";
#region Entity management common configuration

#region List
SetVariable("Keyword2", $_POST['InvestID']);
// DebugDump($_POST);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	"IT.InvestID = " . $_POST['Keyword2'] . "",
	
	SetVariable("Keyword") ? "(
			IT.{$Entity}ID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));

$RecoredSet = $Database->Query("
								SELECT 			COUNT(0) AS TerminalCount, IT.InvestID
								FROM			ims_investtransaction AS IT
								WHERE			{$WhereClause};

								SELECT 			IT.InvestTransactionPayableDate,
												IT.InvestTransactionIsPaid,
												IT.InvestTransactionPaidDate,
												IT.InvestTransactionID,
												CONCAT(I.InvestPrefix, '_', I.InvestID) AS InvestIdentity,
												U.UserSignInName AS Customer,
												ISS.InvestSchemeSettingsPayPerInstallment AS PerInstallment
								FROM			ims_investtransaction AS IT
									LEFT JOIN 	ims_invest AS I ON I.InvestID = IT.InvestID
									LEFT JOIN	sphp_user AS U ON U.UserID = I.UserID
									LEFT JOIN	ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
								WHERE				{$WhereClause}
								ORDER BY 			IT.InvestTransactionID ASC
								LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 20)) . ", {$_POST["RecordCountPerPage"]}		
");
$EM = new EntityManagement($Table[$Entity = "InvestTransaction"]);
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

		// DebugDump($_POST);
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
	$Application->URL($_POST['_Script'], "Keyword=" . SetVariable("Keyword") . "". "&InvestID=" . SetVariable("Keyword2") . ""),
	$RecoredSet[0][0]["TerminalCount"],
	[
		new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "PayableDate") . "", "Next Pay Day", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "PaidDate") . "", "Paid Date", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "IsPaid") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON, null),
	],
	"Checkout",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}edit.png", null, $Application->URL($_POST['_Script'], "btnInput" . "&Keyword=" . SetVariable("Keyword") . "". "&InvestID=" . SetVariable("Keyword2") . ""),null, null, null, "Edit", null, null),
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
			"OnChange" => "window.location.href = '{$Application->URL($_POST["_Script"])}&RecordCountPerPage=' + this.value + '&InvestID={$_POST["Keyword2"]}&Keyword={$_POST["Keyword"]}'",
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

 <script>
	function myFunction() {
		window.print();
	}
</script>