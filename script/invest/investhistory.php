<?php
namespace sPHP;

$Entity = "Invest";

// SetVariable("Keyword", $_POST['Keyword']);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	SetVariable("Keyword") ? "(
			U.UserSignInName LIKE '%{$_POST["Keyword"]}%'
			OR U.UserPhoneMobile LIKE '%{$_POST["Keyword"]}%'
			OR I.InvestID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));
// DebugDump($_POST);

$RecoredSet = $Database->Query("
							DROP TEMPORARY TABLE IF EXISTS next_payday_invest;
							CREATE TEMPORARY TABLE next_payday_invest(
							SELECT			IT.InvestID, MIN(IT.InvestTransactionPayableDate) AS NEXTPAYDAY
							FROM			ims_investtransaction AS IT
							WHERE			IT.InvestTransactionIsPaid = 0
							GROUP BY		IT.InvestID
							);

							DROP TEMPORARY TABLE IF EXISTS last_payday_invest;
							CREATE TEMPORARY TABLE last_payday_invest(
							SELECT			COUNT(*) AS LASTPAYCOUNT,
											IT.InvestID,
											MAX(IT.InvestTransactionPaidDate) AS LASTPAYDAY
							FROM			ims_investtransaction AS IT
							WHERE			IT.InvestTransactionIsPaid = 1
							GROUP BY		IT.InvestID
							);
							
							SELECT 			COUNT(0) AS TerminalCount, I.InvestID
							FROM			ims_invest AS I
								LEFT JOIN	next_payday_invest AS T ON T.InvestID = I.InvestID
								LEFT JOIN	last_payday_invest AS LP ON LP.InvestID = I.InvestID
								LEFT JOIN	ims_investschemesettings AS ISS ON I.InvestSchemeSettingsID = ISS.InvestSchemeSettingsID
								LEFT JOIN	sphp_user AS U ON U.UserID = I.UserID;

							SELECT 			I.InvestID, 
											CONCAT(I.InvestPrefix, '_', I.InvestID) AS InvestIdentity,
											I.InvestSchemeSettingsID,
											I.InvestDate,
											T.NEXTPAYDAY,
											LP.LASTPAYDAY,  
											LP.LASTPAYCOUNT,
											U.UserSignInName AS Customer,
											U.UserPhoneMobile,
											ISS.InvestSchemeSettingsPayPerInstallment AS PerInstallment,
											ISS.InvestSchemeSettingsTotalInstallment,
											(ISS.InvestSchemeSettingsTotalInstallment - LP.LASTPAYCOUNT) AS REMAININSTALLMENT
							FROM 			ims_Invest AS I
								LEFT JOIN	next_payday_invest AS T ON T.InvestID = I.InvestID
								LEFT JOIN	last_payday_invest AS LP ON LP.InvestID = I.InvestID
								LEFT JOIN	ims_Investschemesettings AS ISS ON I.InvestSchemeSettingsID = ISS.InvestSchemeSettingsID
								LEFT JOIN	sphp_user AS U ON U.UserID = I.UserID
							WHERE			{$WhereClause}
							LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 20)) . ", {$_POST["RecordCountPerPage"]}		
							;
								
								
							DROP TEMPORARY TABLE last_payday_invest;
							DROP TEMPORARY TABLE next_payday_invest;

");

// DebugDump($RecoredSet[1][0]);
$CreateCustomDataGrid = new HTML\UI\Datagrid(
	isset($RecoredSet[1]) ? $RecoredSet[1]: null,
	$Application->URL($_POST['_Script'], "Keyword=" . SetVariable("Keyword") . "". "&InvestID=" . SetVariable("Keyword2") . ""),
	$RecoredSet[0][0]["TerminalCount"],
	[
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "InvestIdentity", "Identity", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "Customer", "Investor", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "UserPhoneMobile", "Mobile", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "InvestDate", "Create", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LASTPAYDAY", "Last Payment", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "NEXTPAYDAY", "Next Payment", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PerInstallment", "Inst. Amount", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "InvestSchemeSettingsTotalInstallment", "Total Inst.", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LASTPAYCOUNT", "Inst. Given", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "REMAININSTALLMENT", "Inst. Remain", null, null),
	],
	"History",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}view.png", null, $Application->URL("Invest/InvestView", "btnSubmit"), "_blank", null, null, "View", null, null),
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
