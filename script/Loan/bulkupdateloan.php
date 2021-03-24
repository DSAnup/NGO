<?php
namespace sPHP;

#region Entity management common configuration
$EM = new EntityManagement($Table[$Entity = "LoanTransaction"]);
//DebugDump($Table[$Entity]->Structure());
SetVariable("Search_LoanTransactionIsPaid", 0);
// DebugDump($_POST);
$LoanUser = $Database->Query("
								SELECT 			U.*,
												@UserName := CONCAT(
													U.UserNameFirst,
													IF(U.UserNameMiddle > '', CONCAT(' ', U.UserNameMiddle), ''),
													IF(U.UserNameLast > '', CONCAT(' ', U.UserNameLast), '')
												) AS UserName,
								
												CONCAT(@UserName, ' [', U.UserPhoneMobile, ']') AS UserLookupCaption
								FROM 			sphp_userusergroup AS UUG
									LEFT JOIN 	sphp_user AS U ON U.UserID = UUG.UserID
								WHERE 			UUG.UserGroupID = 12"
							)[0];

// DebugDump($User);

$EM->ListColumn([
	new HTML\UI\Datagrid\Column("" . ($Caption = "User") . "SignInName", "Customer", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Loan") . "Identity", "Identity", null, null),
    new HTML\UI\Datagrid\Column("" . ($Caption = "LoanScheme") . "PayPerInstallment", "Amount", null, null),
    new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "PayableDate") . "", "{$Caption}", FIELD_TYPE_SHORTDATE, null),
	new HTML\UI\Datagrid\Column("{$Entity}Is" . ($Caption = "Paid") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON),
]);


$EM->BatchActionHTML([
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}search.png\" alt=\"Search\" class=\"Icon\">Search", BUTTON_TYPE_SUBMIT, "btnSearch", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}export.png\" alt=\"Export\" class=\"Icon\">Bulk Paid", BUTTON_TYPE_SUBMIT, "btnUpdate", true),
]);

$EM->OrderBy("{$Entity}PayableDate");
$EM->Order("ASC");
$EM->URL($Application->URL($_POST["_Script"]));
$EM->IconURL($Environment->IconURL());
$EM->EncryptionKey($Application->EncryptionKey());
$EM->FieldCaptionWidth($Configuration["FieldCaptionWidth"]);
$EM->FieldCaptionInlineWidth($Configuration["FieldCaptionInlineWidth"]);
$EM->FieldContentFullWidth($Configuration["FieldContentFullWidth"]);
$EM->InputWidth($Configuration["InputWidth"]);
$EM->InputInlineWidth($Configuration["InputInlineWidth"]);
$EM->InputFullWidth($Configuration["InputFullWidth"]);
$EM->InputDateWidth($Configuration["InputDateWidth"]);
$EM->InputTimeWidth($Configuration["InputTimeWidth"]);
$EM->TempPath($Environment->TempPath());
$EM->SearchInputPrefix($Configuration["SearchInputPrefix"]);
$EM->UploadPath($Environment->UploadPath());
$EM->ThumbnailMaximumDimension(48);
$EM->RecordsPerPage(50); //$Configuration["DatagridRowsPerPage"]
$EM->BaseURL($Environment->URL()); // ???????????
#endregion Entity management common configuration


if(isset($_POST["btnUpdate"])){
	$LoanTransactionID = implode(", ", $_POST['LoanTransactionID']);
	$Database->Query("
					UPDATE			ims_loantransaction
					SET				LoanTransactionPaidDate = CURRENT_TIMESTAMP(), LoanTransactionIsPaid = 1
					WHERE			LoanTransactionID IN ({$LoanTransactionID})
	");
	$Terminal->Redirect($_SERVER["HTTP_REFERER"]);
}



#region List
$EM->SearchSQL([
	"1 = 1", // Custom fixed search condition

	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "UserID") . "", SetVariable($Column)) ? "{$Table["User"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}IsPaid") . "", SetVariable($Column, "")) !== "" ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$EM->SearchInputPrefix()}" . ($Column = "{$Entity}DateAssignFrom") . "", SetVariable($Column, "")) ? "{$Table["{$Entity}"]->Alias()}.{$Entity}PayableDate >= '{$Database->Escape("{$_POST["{$EM->SearchInputPrefix()}{$Column}"]}")} {$Database->Escape("{$_POST["{$EM->SearchInputPrefix()}{$Column}Time"]}")}:00'" : null,
	SetVariable("{$EM->SearchInputPrefix()}" . ($Column = "{$Entity}DateAssignTo") . "", SetVariable($Column, "")) ? "{$Table["{$Entity}"]->Alias()}.{$Entity}PayableDate <= '{$Database->Escape($_POST["{$EM->SearchInputPrefix()}{$Column}"])} 23:59:59'" : null,

	// SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "UserIDInserted") . "", SetVariable($Column)) ? "D.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,

]);

$EM->SearchUIHTML([
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "User") . "ID", $LoanUser , new Option(), "{$Caption}LookupCaption", null, null, null), "Lender", null, null),
	// HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}{$Entity}Is" . ($Caption = "Paid") . "", [new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true),
	HTML\UI\Field(
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "From", null, null, null, INPUT_TYPE_DATE) .
		// Do not remove this time, it is needed to set the expected installation time. Also do not remove the default value
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "FromTime", null, "00:00", null, INPUT_TYPE_TIME) .
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "To", null, null, null, INPUT_TYPE_DATE),	
	"{$Caption}", null, true),
]);


print "{$EM->ListHTML()}";
if(SetVariable("SucceededAction") == "Input")print HTML\UI\Toast("{$Table["{$Entity}"]->FormalName()} input successful.");
#region List
?>
 