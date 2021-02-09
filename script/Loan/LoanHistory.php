<?php
namespace sPHP;

$Entity = "Loan";

// SetVariable("Keyword", $_POST['Keyword']);
$WhereClause = implode(" AND ", array_filter([
	"TRUE",
	SetVariable("Keyword") ? "(
			U.UserSignInName LIKE '%{$_POST["Keyword"]}%'
			OR L.LoanID LIKE '%{$_POST["Keyword"]}%'
	)" : null,
]));
// DebugDump($_POST);

$RecoredSet = $Database->Query("
							DROP TEMPORARY TABLE IF EXISTS next_payday;
							CREATE TEMPORARY TABLE next_payday(
							SELECT			LT.LoanID, MIN(LT.LoanTransactionPayableDate) AS NEXTPAYDAY
							FROM			ims_loantransaction AS LT
							WHERE			LT.LoanTransactionIsPaid = 0
							GROUP BY		LT.LoanID
							);

							DROP TEMPORARY TABLE IF EXISTS last_payday;
							CREATE TEMPORARY TABLE last_payday(
							SELECT			COUNT(*) AS LASTPAYCOUNT,
											LT.LoanID,
											MAX(LT.LoanTransactionPaidDate) AS LASTPAYDAY
							FROM			ims_loantransaction AS LT
							WHERE			LT.LoanTransactionIsPaid = 1
							GROUP BY		LT.LoanID
							);
							
							SELECT 			COUNT(0) AS TerminalCount, L.LoanID
							FROM			ims_loan AS L
								LEFT JOIN	next_payday AS T ON T.LoanID = L.LoanID
								LEFT JOIN	last_payday AS LP ON LP.LoanID = L.LoanID
								LEFT JOIN	ims_loanscheme AS LS ON L.LoanSchemeID = LS.LoanSchemeID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID;

							SELECT 			L.LoanID, 
											CONCAT(L.LoanPrefix, '_', L.LoanID) AS LoanIdentity,
											L.LoanSchemeID,
											L.LoanDate,
											T.NEXTPAYDAY,
											LP.LASTPAYDAY,  
											LP.LASTPAYCOUNT,
											U.UserSignInName AS Customer,
											LS.LoanSchemePayPerInstallment AS PerInstallment,
											LS.LoanSchemeTotalInstallment,
											(LS.LoanSchemeTotalInstallment - LP.LASTPAYCOUNT) AS REMAININSTALLMENT
							FROM 			ims_loan AS L
								LEFT JOIN	next_payday AS T ON T.LoanID = L.LoanID
								LEFT JOIN	last_payday AS LP ON LP.LoanID = L.LoanID
								LEFT JOIN	ims_loanscheme AS LS ON L.LoanSchemeID = LS.LoanSchemeID
								LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
							WHERE			{$WhereClause}
							LIMIT			" . ((SetVariable("Page", 1) - 1) * SetVariable("RecordCountPerPage", 20)) . ", {$_POST["RecordCountPerPage"]}		
							;
								
								
							DROP TEMPORARY TABLE last_payday;
							DROP TEMPORARY TABLE next_payday;

");

// DebugDump($RecoredSet[1][0]);
$CreateCustomDataGrid = new HTML\UI\Datagrid(
	isset($RecoredSet[1]) ? $RecoredSet[1]: null,
	$Application->URL($_POST['_Script'], "Keyword=" . SetVariable("Keyword") . "". "&LoanID=" . SetVariable("Keyword2") . ""),
	$RecoredSet[0][0]["TerminalCount"],
	[
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LoanIdentity", "Loan Number", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "Customer", "Client", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LoanDate", "Loan Creation", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "NEXTPAYDAY", "Next Payment", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LASTPAYDAY", "Last Payment", FIELD_TYPE_SHORTDATE, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "PerInstallment", "Installment Amount", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LoanSchemeTotalInstallment", "Total Installment", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "LASTPAYCOUNT", "Intstallment Given", null, null),
		new HTML\UI\Datagrid\Column("" . ($Caption = "") . "REMAININSTALLMENT", "Intstallment Remain", null, null),
	],
	"History",
	$_POST["RecordCountPerPage"],
	"{$Entity}ID",
	[
		new HTML\UI\Datagrid\Action("{$Environment->IconURL()}view.png", null, $Application->URL("Loan/LoanView", "btnSubmit"), "_blank", null, null, "View", null, null),
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
		" . HTML\UI\Input("Keyword", null, null, null, null, null, "Search") . "
		<input type=\"hidden\" name=\"Page\" value=\"1\">
	"
	,
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
