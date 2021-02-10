<?php
namespace sPHP;

$LeftPanelLinkHTML[] = HTML\UI\Accordion("LeftPanelNavigation", [
	$Session->IsGuest() ? null : new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Dashboard", null, $Application->URL("{$Caption}"), null, null, "" . strtolower("" . ($PadKey = "Dashboard") . "_" . ($Key = "Dashboard")) . "", "{$Caption}", null, "{$Key}"),
		// new HTML\UI\Accordion\Item($Caption = "Analytics &amp; summary", null, $Application->URL("Landing"), null, null, "" . strtolower("" . ($PadKey = "Landing") . "_" . ($Key = "Landing")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}"),
	// $Session->IsGuest() ? null : new HTML\UI\Accordion\Pad([
	// 	new HTML\UI\Accordion\Item($Caption="Source", null, $Application->URL("Management/Generic/Source"), null, null, "" . strtolower("" . ($PadKey = "") . "" . ($Key = "Source")) . "", "{$Caption}", null, "{$Key}")
	// ]),

	$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" || "PROVIDER" ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Loan Scheme Setting", null, $Application->URL("Loan/LoanScheme"), null, null, "" . strtolower("" . ($PadKey = "LoanScheme") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Create Loan", null, $Application->URL("Loan/Loan"), null, null, "" . strtolower("" . ($PadKey = "Loan") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		// new HTML\UI\Accordion\Item($Caption = "Check Loan", null, $Application->URL("Loan/LoanTransaction"), null, null, "" . strtolower("" . ($PadKey = "LoanTransaction") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Loan History", null, $Application->URL("Loan/LoanHistory"), null, null, "" . strtolower("" . ($PadKey = "LoanHistory") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Lend") . " Section", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,

	$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" || "PROVIDER" ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Current Month Due", null, $Application->URL("Management/Report/UpcomingPayment"), null, null, "" . strtolower("" . ($PadKey = "UpcomingPayment") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "Current Month Paid", null, $Application->URL("Management/Report/CurrentMonthPaid"), null, null, "" . strtolower("" . ($PadKey = "CurrentMonthPaid") . "" . ($Key = "")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Report") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,
	
	$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "User", null, $Application->URL("Management/Generic/{$Caption}"), null, null, "" . strtolower("" . ($PadKey = "Administration") . "_" . ($Key = "User")) . "", "{$Caption}", null, "{$Key}"),
		new HTML\UI\Accordion\Item($Caption = "User group", null, $Application->URL("Management/Generic/UserGroup"), null, null, "" . strtolower("" . ($PadKey = "Administration") . "_" . ($Key = "UserGroup")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "Administration") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : null,
	$Session->IsGuest() ? new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Log in", null, $Application->URL("User/SignIn"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "SignIn")) . "", "{$Caption}", null, "{$Key}"),
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}") : new HTML\UI\Accordion\Pad([
		new HTML\UI\Accordion\Item($Caption = "Log out", null, $Application->URL("User/SignOut"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "SignOut")) . "", "{$Caption}", null, "{$Key}"),
		$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Accordion\Item($Caption = "Switch user", null, $Application->URL("User/Impersonate"), null, null, "" . strtolower("" . ($PadKey = "User") . "_" . ($Key = "Impersonate")) . "", "{$Caption}", null, "{$Key}") : null,
	], "" . ($Caption = "") . "", "{$Caption}", "{$Caption}", null, "{$PadKey}"),
], "{$Environment->ImageURL()}layout/header/leftpanel/icon/", "LeftPanelNavigation", null);
?>