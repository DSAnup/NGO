<?php
namespace sPHP;

#region Entity management common configuration
$EM = new EntityManagement($Table[$Entity = "LoanTransaction"]);
//DebugDump($Table[$Entity]->Structure());

// DebugDump($User);
$EM->ImportField([
	new Database\Field("" . ($Field = "User") . "ID", "" . ($Column = "{$Field}SignInName") . "", null, $Table["{$Field}"], null),
	new Database\Field("" . ($Field = "Loan") . "ID", "" . ($Column = "{$Field}LoanIdentity") . "", null, $Table["{$Field}"], null),
	new Database\Field("{$Entity}" . ($Field = "PayableDate") . "", "{$Field}"),
	new Database\Field("{$Entity}Is" . ($Field = "Active") . "", "{$Field}"),
	//new Database\Field("" . ($Field = "Listener") . "ID", "{$Field}", null, $Table["{$Field}"], "{$Field}Name"),
]);

$EM->InputValidation([
    new HTTP\InputValidation("LoanID", null, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("{$Entity}PaidDate", true, null),
	new HTTP\InputValidation("{$Entity}IsActive", null, VALIDATION_TYPE_INTEGER),
]);

$EM->ValidateInput(function($Entity, $Database, $Table, $PrimaryKey, $ID){
	$Result = true;

	// if($Table->Get( // Check for duplicate values for UNIQUE columns
	// 	"
	// 		(
	// 				{$Table->Alias()}." . ($Column = "SourceID") . " = " . intval($_POST["{$Column}"]) . "
	// 			AND	" . ($Column = "{$Entity}Name") . " = '{$Database->Escape($_POST["{$Column}"])}'
	// 		)
	// 		AND	{$PrimaryKey} <> {$ID}
	// 	"
	// , null, null, null, null, null, null))$Result = "Same Source and name for the same " . strtolower($Table->FormalName()) . " exists!";

	return $Result;
});

$EM->ThumbnailColumn("x{$Entity}Picture");

$EM->BeforeInput(function($Entity, $Record){
	//$_POST[$Field = "{$Entity}PasswordHash"] = strlen($_POST["{$Entity}Password"]) ? md5($_POST["{$Entity}Password"]) : (is_null($Record) ? null : $Record["{$Field}"]);

	return true;
});

$EM->IntermediateEntity("xCategory, xEvent");
$EM->DefaultFromSearchColumn("xTerminalID, xUserID, xCarrierID");

$EM->ListColumn([
	new HTML\UI\Datagrid\Column("" . ($Caption = "User") . "SignInName", "Customer", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Loan") . "Identity", "Loan Number", null, null),
    new HTML\UI\Datagrid\Column("" . ($Caption = "LoanScheme") . "Name", "{$Caption} Name", null, null),
    new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "PayableDate") . "", "{$Caption}", FIELD_TYPE_SHORTDATE, null),
	new HTML\UI\Datagrid\Column("{$Entity}Is" . ($Caption = "Active") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON),
]);

$EM->Action([
	//new HTML\UI\Datagrid\Action("{$Environment->IconURL()}{$Entity}" . strtolower($ActionEntity = "CommercialInvoice") . ".png", null, $Application->URL("{$Entity}/{$ActionEntity}"), "_blank", null, null, "Commercial invoice"),
	new HTML\UI\Datagrid\Action("{$Environment->IconURL()}view.png", null, $Application->URL($_POST["_Script"], "btnView"), null, null, null, "View", null, null),
	new HTML\UI\Datagrid\Action("{$Environment->IconURL()}edit.png", null, $Application->URL($_POST["_Script"], "btnInput"), null, null, null, "Edit"),
	$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? new HTML\UI\Datagrid\Action("{$Environment->IconURL()}delete.png", null, $Application->URL($_POST["_Script"], "btnDelete"), null, "return confirm('Are you sure to remove the information?');", null, "Delete"):null,
]);

$EM->BatchActionHTML([
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}search.png\" alt=\"Search\" class=\"Icon\">Search", BUTTON_TYPE_SUBMIT, "btnSearch", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}add.png\" alt=\"Add new\" class=\"Icon\">Add new", BUTTON_TYPE_SUBMIT, "btnInput", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}delete.png\" alt=\"Remove\" class=\"Icon\">Remove", BUTTON_TYPE_SUBMIT, "btnDelete", true, "return confirm('Are you sure to remove the information?');"),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}export.png\" alt=\"Export\" class=\"Icon\">Export", BUTTON_TYPE_SUBMIT, "btnExport", true),
	// HTML\UI\Button("<img src=\"{$Environment->IconURL()}import.png\" alt=\"Import\" class=\"Icon\">Import", BUTTON_TYPE_SUBMIT, "btnImport", true),
	//HTML\UI\Button("<img src=\"{$Environment->IconURL()}report.png\" alt=\"Installation report\" class=\"Icon\">Installation report", BUTTON_TYPE_SUBMIT, "btn{$Entity}ReportInstallation", true),
]);

$EM->OrderBy("{$Entity}ID");
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

if(isset($_POST["btnImport"])){
	if(isset($_POST["btnSubmit"])){
		$EM->Import();
		$Terminal->Redirect($_POST["_Referer"]);
	}

	print $EM->ImportHTML();
}

if(isset($_POST["btnDelete"])){
	$EM->Delete();
	$Terminal->Redirect($_SERVER["HTTP_REFERER"]);
}

if(isset($_POST["btnInput"])){
	$NewRecordMode = isset($_POST["{$Entity}ID"]) && intval($_POST["{$Entity}ID"]) ? false : true;

	if(isset($_POST["btnSubmit"])){
		#region Custom code
		$_POST["{$Entity}PaidDate"] = "{$_POST["{$Entity}PaidDateDate"]} {$_POST["{$Entity}PaidDateTime"]}:00";
		#endregion Custom code
		// DebugDump($_POST);
		if($EM->Input()){

			$Terminal->Redirect("{$_POST["_Referer"]}&SucceededAction=Input"); // Redirect to previous location
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


#region List
$EM->SearchSQL([
	"1 = 1", // Custom fixed search condition

	$User->UserGroupIdentifierHighest() == "User" ? "D.UserIDInserted = {$User->ID()}" : null,
	$User->UserGroupIdentifierHighest() == "HEAD" ? 
		"D.UserIDInserted IN (
			SELECT			SUD2.UserID
			FROM			spm_userdepartment AS SUD
					LEFT JOIN	sphp_user AS U ON U.UserID = SUD.UserID
					LEFT JOIN	spm_userdepartment AS SUD2 ON SUD2.DepartmentID = SUD.DepartmentID
			WHERE			U.UserID = {$User->ID()}
		)" : null,
	$User->UserGroupIdentifierHighest() == "DEVELOPER" ? 
		"D.UserIDInserted IN (
			SELECT			SUG.UserID
			FROM			sphp_userusergroup AS SUG
				LEFT JOIN	sphp_user AS U ON U.UserID = SUG.UserID
			WHERE			U.UserID = {$User->ID()}
		)" : null,

	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "User") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}IsActive") . "", SetVariable($Column, "")) !== "" ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$EM->SearchInputPrefix()}" . ($Column = "{$Entity}DateAssignFrom") . "", SetVariable($Column, "")) ? "{$Table["{$Entity}"]->Alias()}.{$Entity}PayableDate >= '{$Database->Escape("{$_POST["{$EM->SearchInputPrefix()}{$Column}"]}")} {$Database->Escape("{$_POST["{$EM->SearchInputPrefix()}{$Column}Time"]}")}:00'" : null,
	SetVariable("{$EM->SearchInputPrefix()}" . ($Column = "{$Entity}DateAssignTo") . "", SetVariable($Column, "")) ? "{$Table["{$Entity}"]->Alias()}.{$Entity}PayableDate <= '{$Database->Escape($_POST["{$EM->SearchInputPrefix()}{$Column}"])} 23:59:59'" : null,

	// SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "UserIDInserted") . "", SetVariable($Column)) ? "D.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,

]);

$EM->SearchUIHTML([
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "User") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, null),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}{$Entity}Is" . ($Caption = "Active") . "", [new Option(), new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true),
	HTML\UI\Field(
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "From", null, null, null, INPUT_TYPE_DATE) .
		// Do not remove this time, it is needed to set the expected installation time. Also do not remove the default value
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "FromTime", null, "00:00", null, INPUT_TYPE_TIME) .
		HTML\UI\Input("{$EM->SearchInputPrefix()}{$Entity}Date" . ($Caption = "Assign") . "To", null, null, null, INPUT_TYPE_DATE),	
	"{$Caption}", null, true),
]);

if(isset($_POST["btnExport"])){
	$Recordset = $Table[$Entity]->Get(implode(" AND ", array_filter($EM->SearchSQL())), "{$EM->OrderBy()} {$EM->Order()}");
	$CSVRow = []; // Create the CSV row array just in case if there is no data available
	foreach($Recordset as $RecordIndex => $Record)$CSVRow[] = [
		($Field = "#") 					=> $RecordIndex + 1, 
		($Field = "Task") 				=> $Record["TaskName"], 
		($Field = "Daily Report") 		      => $Record["DailyTaskReport"], 
		($Field = "Comment") 			      => $Record["DailyTaskComments"], 
		($Field = "Remark") 			      => $Record["DailyTaskRemarks"], 
		($Field = "Date") 				=> $Record["DailyTaskDateAssign"], 
		($Field = "User") 				=> $Record["UserSignInName"], 
	];
	$Terminal->LetDownload($CSVRow, null, "Daily Task" . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
}

// print "{$EM->ListHTML()}";
if(SetVariable("SucceededAction") == "Input")print HTML\UI\Toast("{$Table["{$Entity}"]->FormalName()} input successful.");
#region List
?>
 