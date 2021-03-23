<?php
namespace sPHP;
// DebugDump($User->UserGroupIdentifierHighest());
$Master = array("ADMINISTRATOR", "MANAGER");
$MasterAccess = FALSE;
if(in_array($User->UserGroupIdentifierHighest(), $Master)){
	$MasterAccess = TRUE;
}else{
	$MasterAccess = FALSE;
}

$LeftPanelLinkHTML[] = HTML\UI\Accordion("LeftPanelNavigation", [
	$Session->IsGuest() ? null : new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Dashboard", null, $Application->URL("{$Caption}"), null, null, "" . strtolower("" . ($PadKey = "Dashboard") . "_" . ($Key = "Dashboard")) . "", "{$Caption}", null, "{$Key}"),
		// new HTML\UI\Accordion\Item($Caption = "Analytics &amp; summary", null, $Application->URL("Landing"), null, null, "" . strtolower("" . ($PadKey = "Landing") . "_" . ($Key = "Landing")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}"),
	// $Session->IsGuest() ? null : new HTML\UI\Accordion\Pad([
	// 	new HTML\UI\Accordion\Item($Caption="Source", null, $Application->URL("Management/Generic/Source"), null, null, "" . strtolower("" . ($PadKey = "") . "" . ($Key = "Source")) . "", "{$Caption}", null, "{$Key}")
	// ]),

	$MasterAccess ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Loan Scheme Setting", null, $Application->URL("loan/loanshceme"), null, null, "" . strtolower("" . ($PadKey = "LoanScheme") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Create Loan", null, $Application->URL("loan/loan"), null, null, "" . strtolower("" . ($PadKey = "Loan") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		// new HTML\UI\Accordion\Item($Caption = "Check Loan", null, $Application->URL("Loan/LoanTransaction"), null, null, "" . strtolower("" . ($PadKey = "LoanTransaction") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Loan History", null, $Application->URL("loan/loanhistory"), null, null, "" . strtolower("" . ($PadKey = "LoanHistory") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Lend") . " Section", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,

	$MasterAccess ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Deposit Scheme Setting", null, $Application->URL("Invest/InvestSchemeSettings"), null, null, "" . strtolower("" . ($PadKey = "InvestSchemeSettings") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Create Deposit", null, $Application->URL("Invest/Invest"), null, null, "" . strtolower("" . ($PadKey = "Invest") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Deposit History", null, $Application->URL("Invest/InvestHistory"), null, null, "" . strtolower("" . ($PadKey = "InvestHistory") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Deposit") . " Section", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,

	$MasterAccess  ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Bulk Updte Deposit", null, $Application->URL("Invest/BulkUpdateInvest"), null, null, "" . strtolower("" . ($PadKey = "BulkUpdateInvest") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Unpaid Lend", null, $Application->URL("Management/Report/UnpaidLend"), null, null, "" . strtolower("" . ($PadKey = "UnpaidLend") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Unpaid Deposit", null, $Application->URL("Management/Report/UnpaidInvest"), null, null, "" . strtolower("" . ($PadKey = "UnpaidInvest") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Quick Access") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,

	$MasterAccess  ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Lend Report", null, $Application->URL("Management/Report/LoanReport"), null, null, "" . strtolower("" . ($PadKey = "LoanReport") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Deposit Report", null, $Application->URL("Management/Report/InvestReport"), null, null, "" . strtolower("" . ($PadKey = "InvestReport") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Report") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,

	$MasterAccess ? new HTML\UI\Accordion\Pad([
		$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Accordion\Item($Caption = "User", null, $Application->URL("Management/Generic/{$Caption}"), null, null, "" . strtolower("" . ($PadKey = "Administration") . "_" . ($Key = "User")) . "", "{$Caption}", null, "{$Key}"): null,
		new HTML\UI\Accordion\Item($Caption = "User", null, $Application->URL("Management/Generic/Customer"), null, null, "" . strtolower("" . ($PadKey = "Administration") . "_" . ($Key = "Customer")) . "", "{$Caption}", null, "{$Key}"),
		$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Accordion\Item($Caption = "User group", null, $Application->URL("Management/Generic/UserGroup"), null, null, "" . strtolower("" . ($PadKey = "Administration") . "_" . ($Key = "UserGroup")) . "", "{$Caption}", null, "{$Key}"): null,
	], "" . ($Caption = "Administration") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,
	$Session->IsGuest() ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Log in", null, $Application->URL("User/SignIn"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "SignIn")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Log out", null, $Application->URL("User/SignOut"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "SignOut")) . "", "{$Caption}", null, "{$Key}"),
		$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Accordion\Item($Caption = "Switch user", null, $Application->URL("User/Impersonate"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "Impersonate")) . "", "{$Caption}", null, "{$Key}") : null,
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}"),
], "{$Environment->ImageURL()}layout/header/leftpanel/icon/", "LeftPanelNavigation", null);
?>