<?php
namespace sPHP;

#region Entity management common configuration
$EM = new EntityManagement($Table[$Entity = "Task"]);
//DebugDump($Table[$Entity]->Structure());
$EM->ImportField([
	new Database\Field("" . ($Field = "Source") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("" . ($Field = "Project") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("" . ($Field = "Type") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("" . ($Field = "Priority") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("{$Entity}" . ($Field = "Name") . "", "{$Field}"),
	new Database\Field("" . ($Field = "Status") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("{$Entity}" . ($Field = "Accessibility") . "", "{$Field}"),
	new Database\Field("" . ($Field = "Acknowledge") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("{$Entity}" . ($Field = "Comment") . "", "{$Field}"),
	new Database\Field("{$Entity}" . ($Field = "Date") . "", "{$Field}"),
	new Database\Field("{$Entity}Is" . ($Field = "Active") . "", "{$Field}"),
	//new Database\Field("" . ($Field = "Listener") . "ID", "{$Field}", null, $Table["{$Field}"], "{$Field}Name"),
]);

$EM->InputValidation([
	new HTTP\InputValidation("SourceID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("ProjectID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("TypeID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("PriorityID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("StatusID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("AcknowledgeID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("{$Entity}Name", true),
	new HTTP\InputValidation("{$Entity}Date", true, null),
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
$EM->DefaultFromSearchColumn("xTerminalID, xCustomerID, xCarrierID");

$EM->ListColumn([
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Name") . "", "{$Caption}", null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Source") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Project") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Type") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Priority") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Status") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("" . ($Caption = "Acknowledge") . "Name", "{$Caption}", null, null),
    new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Date") . "", "Assign Date", FIELD_TYPE_SHORTDATE, null),
    new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "ExpectedCompletionDate") . "", "Expected Date", FIELD_TYPE_SHORTDATE, null),
    new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "CompletionDate") . "", "Completion Date", FIELD_TYPE_SHORTDATE, null),
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
	// HTML\UI\Button("<img src=\"{$Environment->IconURL()}delete.png\" alt=\"Remove\" class=\"Icon\">Remove", BUTTON_TYPE_SUBMIT, "btnDelete", true, "return confirm('Are you sure to remove the information?');"),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}export.png\" alt=\"Export\" class=\"Icon\">Export", BUTTON_TYPE_SUBMIT, "btnExport", true),
	// HTML\UI\Button("<img src=\"{$Environment->IconURL()}import.png\" alt=\"Import\" class=\"Icon\">Import", BUTTON_TYPE_SUBMIT, "btnImport", true),
	//HTML\UI\Button("<img src=\"{$Environment->IconURL()}report.png\" alt=\"Installation report\" class=\"Icon\">Installation report", BUTTON_TYPE_SUBMIT, "btn{$Entity}ReportInstallation", true),
]);

$EM->OrderBy("{$Entity}Date DESC, {$Entity}Name");
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
$EM->RecordsPerPage(200); //$Configuration["DatagridRowsPerPage"]
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
		$_POST["{$Entity}Date"] = $_POST["{$Entity}DateDate"] ? "{$_POST["{$Entity}DateDate"]} {$_POST["{$Entity}DateTime"]}:00" : null;
		$_POST["{$Entity}ExpectedCompletionDate"] = $_POST["{$Entity}ExpectedCompletionDateDate"] ? "{$_POST["{$Entity}ExpectedCompletionDateDate"]} {$_POST["{$Entity}ExpectedCompletionDateTime"]}:00" : null;
		$_POST["{$Entity}CompletionDate"] = $_POST["{$Entity}CompletionDateDate"] ? "{$_POST["{$Entity}CompletionDateDate"]} {$_POST["{$Entity}CompletionDateTime"]}:00" : null;
		#endregion Custom code

		if($EM->Input()){
			$Terminal->Redirect("{$_POST["_Referer"]}&SucceededAction=Input"); // Redirect to previous location
		}
	}

	$EM->LoadExistingData();
	#region Custom code
	if(isset($_POST["{$Entity}Date"]) && $_POST["{$Entity}Date"]){
		$TaskDate = strtotime($_POST["{$Entity}Date"]);
		$_POST["{$Entity}DateDate"] = date("Y-m-d", $TaskDate);
		$_POST["{$Entity}DateTime"] = date("H:i", $TaskDate);
	}

	if(isset($_POST["{$Entity}ExpectedCompletionDate"]) && $_POST["{$Entity}ExpectedCompletionDate"]){
		$ExpectedCompletionDate = strtotime($_POST["{$Entity}ExpectedCompletionDate"]);
		$_POST["{$Entity}ExpectedCompletionDateDate"] = date("Y-m-d", $ExpectedCompletionDate);
		$_POST["{$Entity}ExpectedCompletionDateTime"] = date("H:i", $ExpectedCompletionDate);
	}

	if(isset($_POST["{$Entity}CompletionDate"]) && $_POST["{$Entity}CompletionDate"]){
		$CompletionDate = strtotime($_POST["{$Entity}CompletionDate"]);
		$_POST["{$Entity}CompletionDateDate"] = date("Y-m-d", $CompletionDate);
		$_POST["{$Entity}CompletionDateTime"] = date("H:i", $CompletionDate);
	}
	#endregion Custom code

	$EM->InputUIHTML([
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Source") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Project") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Type") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Priority") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Status") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Acknowledge") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption", null, null, 1), "Acknowledgement", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Name") . "", $EM->InputFullWidth(), null, true), "Taskname", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Reference") . "", $EM->InputFullWidth(), null, true), "Reference", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Textarea("{$Entity}" . ($Caption = "Accessibility") . "", $EM->InputFullWidth(), null, null), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Textarea("{$Entity}" . ($Caption = "Comment") . "", $EM->InputFullWidth(), null, null), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Date" . ($Caption = "") . "Date", $EM->InputDateWidth(), date("Y-m-d"), null, INPUT_TYPE_DATE) . HTML\UI\Input("{$Entity}Date" . ($Caption = "") . "Time", $Configuration["InputTimeWidth"], date("H:i"), null, INPUT_TYPE_TIME), "Assign Date", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}ExpectedCompletionDate" . ($Caption = "") . "Date", $EM->InputDateWidth(), null, null, INPUT_TYPE_DATE) . HTML\UI\Input("{$Entity}ExpectedCompletionDate" . ($Caption = "") . "Time", $Configuration["InputTimeWidth"], null, null, INPUT_TYPE_TIME), "Expected Date", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}CompletionDate" . ($Caption = "") . "Date", $EM->InputDateWidth(), null, null, INPUT_TYPE_DATE) . HTML\UI\Input("{$Entity}CompletionDate" . ($Caption = "") . "Time", $Configuration["InputTimeWidth"], null, null, INPUT_TYPE_TIME), "Completion Date", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\RadioGroup("{$Entity}Is" . ($Caption = "Active") . "", [new HTML\UI\Radio(1, "Yes"), new HTML\UI\Radio(0, "No")]), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
	]);

	print $EM->InputHTML();
}
if(isset($_POST["btnView"])){
    SetVariable("Search_{$Entity}Name", "");
    SetVariable("Search_{$Entity}Comment", "");

    $EM->LoadExistingData();

	print "
        <style>
            .MessageView{margin-bottom: 15px; box-shadow: 0 0 5px 0 Black; border-radius: 5px; padding: 15px;}
            .MessageView > .Field{float: none; margin-bottom: 15px; border-bottom: 1px Grey dotted; padding-bottom: 15px;}
            .MessageView > .Field > .Caption{float: left; width: 100px; font-weight: bold;}
            .MessageView > .Field > .Caption:after{content: ':';}
            .MessageView > .Field > .Value{float: left;}
            .MessageView > .Field:after{display: block; clear: both; content: '';}
        </style>

        <div class=\"MessageView\">
            <h2>View Task#{$_POST["{$Entity}ID"]}</h2>
			
			<div class=\"Field\">
                <div class=\"Caption\">Assign Date</div>
                <div class=\"Value\">" . date("d M, Y", strtotime($_POST["{$Entity}Date"])) . "</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Expected Date</div>
                <div class=\"Value\">" . date("d M, Y", strtotime($_POST["{$Entity}ExpectedCompletionDate"])) . "</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Completion Date</div>
                <div class=\"Value\">" . date("d M, Y", strtotime($_POST["{$Entity}CompletionDate"])) . "</div>
			</div>
			
			<div class=\"Field\">
                <div class=\"Caption\">Source</div>
                <div class=\"Value\">{$_POST["SourceName"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Project</div>
                <div class=\"Value\">{$_POST["ProjectName"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Type</div>
                <div class=\"Value\">{$_POST["TypeName"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Priority</div>
                <div class=\"Value\">{$_POST["PriorityName"]}</div>
			</div>
			
            <div class=\"Field\">
                <div class=\"Caption\">Task Name</div>
                <div class=\"Value\">{$_POST["{$Entity}Name"]}</div>
            </div>

			<div class=\"Field\">
                <div class=\"Caption\">Status</div>
                <div class=\"Value\">{$_POST["StatusName"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Reference</div>
                <div class=\"Value\">{$_POST["{$Entity}Reference"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Accessibility</div>
                <div class=\"Value\">{$_POST["{$Entity}Accessibility"]}</div>
			</div>

			<div class=\"Field\">
                <div class=\"Caption\">Acknowledge</div>
                <div class=\"Value\">{$_POST["AcknowledgeName"]}</div>
			</div>

            <div class=\"Field\">
                <div class=\"Caption\">Comment</div>
                <div class=\"Value\">{$_POST["{$Entity}Comment"]}</div>
            </div>
        </div>
    ";

}

#region List
$EM->SearchSQL([
	"1 = 1", // Custom fixed search condition
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "SourceID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "ProjectID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "TypeID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "PriorityID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "StatusID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "AcknowledgeID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Name") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%'" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Reference") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%'" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}IsActive") . "", SetVariable($Column, "")) !== "" ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
]);

$EM->SearchUIHTML([
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Source") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, null),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Project") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Type") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Priority") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Status") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Acknowledge") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Name") . "", 200), "{$Caption}", true, null),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Reference") . "", null), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}{$Entity}Is" . ($Caption = "Active") . "", [new Option(), new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true),
]);

if(isset($_POST["btnExport"])){
	$Recordset = $Table[$Entity]->Get(implode(" AND ", array_filter($EM->SearchSQL())), "{$EM->OrderBy()} {$EM->Order()}");
	$CSVRow = []; // Create the CSV row array just in case if there is no data available
	foreach($Recordset as $RecordIndex => $Record)$CSVRow[] = [
		($Field = "#") 					=> $RecordIndex + 1, 
		($Field = "Task") 				=> $Record["TaskName"], 
		($Field = "Source") 			=> $Record["SourceName"], 
		($Field = "Project") 			=> $Record["ProjectName"], 
		($Field = "Priority") 			=> $Record["PriorityName"], 
		($Field = "Status") 			=> $Record["StatusName"], 
		($Field = "Acknowledgement") 	=> $Record["AcknowledgeName"], 
		($Field = "Type") 				=> $Record["TypeName"], 
		($Field = "Reference") 			=> $Record["TaskReference"],
		($Field = "Accessibility") 		=> $Record["TaskAccessibility"],
		($Field = "Comment") 			=> $Record["TaskComment"],
		($Field = "Assign Date") 		=> $Record["TaskDate"], 
		($Field = "Expected Date") 		=> $Record["TaskExpectedCompletionDate"], 
		($Field = "Completion Date") 	=> $Record["TaskCompletionDate"], 
	];
	$Terminal->LetDownload($CSVRow, null, "Report " . date("Y-m-d H-i-s") . " " . rand(0, 9999) . ".csv"); 
}

print "{$EM->ListHTML()}";
if(SetVariable("SucceededAction") == "Input")print HTML\UI\Toast("{$Table["{$Entity}"]->FormalName()} input successful.");
#region List
?>
 