<?php


namespace sPHP;



#region Entity management common configuration
$EM = new EntityManagement($Table[$Entity = "User"]);
//DebugDump($Table[$Entity]->Structure());

$InvestorUser = $Database->Query("
								SELECT 			U.*,
												@UserName := CONCAT(
													U.UserNameFirst,
													IF(U.UserNameMiddle > '', CONCAT(' ', U.UserNameMiddle), ''),
													IF(U.UserNameLast > '', CONCAT(' ', U.UserNameLast), '')
												) AS UserName,
								
												CONCAT(@UserName, ' [', U.UserEmail, ']') AS UserLookupCaption
								FROM 			sphp_userusergroup AS UUG
									LEFT JOIN 	sphp_user AS U ON U.UserID = UUG.UserID
								WHERE 			UUG.UserGroupID = 13"
							)[0];

$EM->ImportField([
	new Database\Field("{$Entity}" . ($Field = "SignInName") . "", "{$Field}"),
	new Database\Field("{$Entity}" . ($Field = "Email") . "", "{$Field}"),
	new Database\Field("{$Entity}" . ($Field = "NameFirst") . "", "{$Field}"),
	new Database\Field("" . ($Field = "Gender") . "ID", "{$Field}", null, $Table["{$Field}"], "{$Field}Name"),
	new Database\Field("{$Entity}" . ($Field = "PhoneMobile") . "", "{$Field}"),
	new Database\Field("{$Entity}Is" . ($Field = "Active") . "", "{$Field}"),
]);

$EM->InputValidation([
	new HTTP\InputValidation("{$Entity}SignInName", true),
	new HTTP\InputValidation("{$Entity}NameFirst", true),
	new HTTP\InputValidation("{$Entity}PhoneMobile", true),
	new HTTP\InputValidation("{$Entity}IsActive", null, VALIDATION_TYPE_INTEGER),
]);

$EM->ValidateInput(function($Entity, $Database, $Table, $PrimaryKey, $ID){
	$Result = true;

	if($Table->Get( // Check for duplicate values for UNIQUE columns
		"
			(
					" . ($Column = "{$Entity}SignInName") . " = '{$Database->Escape($_POST["{$Column}"])}'
				OR	" . ($Column = "{$Entity}PhoneMobile") . " = '{$Database->Escape($_POST["{$Column}"])}'
			
			)
			AND	{$PrimaryKey} <> {$ID}
		"
	, null, null, null, null, null, null))$Result = "Username or mobile phone already exists!";

	return $Result;
});

$EM->ThumbnailColumn("x{$Entity}Picture");

$EM->BeforeInput(function($Entity, $Record){
	$_POST[$Field = "{$Entity}PasswordHash"] = strlen($_POST["{$Entity}Password"]) ? md5($_POST["{$Entity}Password"]) : (is_null($Record) ? null : $Record["{$Field}"]);

	return true;
});

$EM->IntermediateEntity("{$Entity}Group");
$EM->DefaultFromSearchColumn("xGenderID, xLanguageID");

$EM->ListColumn([
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Name") . "", "{$Caption}"),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Sign") . "InName", "{$Caption} in"),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Email") . "", "{$Caption}", FIELD_TYPE_EMAIL),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Phone") . "", "{$Caption}", FIELD_TYPE_PHONE),
	//new HTML\UI\Datagrid\Column("{$Entity}Address" . ($Caption = "Country") . "FlagURL", "{$Caption}", FIELD_TYPE_ICON),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Group") . "Name", "{$Caption}"),
	new HTML\UI\Datagrid\Column("{$Entity}Is" . ($Caption = "Active") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON),
]);

$EM->Action([
	new HTML\UI\Datagrid\Action("{$Environment->IconURL()}edit.png", null, $Application->URL($_POST["_Script"], "btnInput")),
	// new HTML\UI\Datagrid\Action("{$Environment->IconURL()}delete.png", null, $Application->URL($_POST["_Script"], "btnDelete"), null, "return confirm('Are you sure to remove the information?');"),
]);

$EM->BatchActionHTML([
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}search.png\" alt=\"Search\" class=\"Icon\">Search", BUTTON_TYPE_SUBMIT, "btnSearch", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}add.png\" alt=\"Add new\" class=\"Icon\">Add new", BUTTON_TYPE_SUBMIT, "btnInput", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}delete.png\" alt=\"Remove\" class=\"Icon\">Remove", BUTTON_TYPE_SUBMIT, "btnDelete", true, "return confirm('Are you sure to remove the information?');"),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}export.png\" alt=\"Export\" class=\"Icon\">Export", BUTTON_TYPE_SUBMIT, "btnExport", true),
]);

$EM->OrderBy("{$Entity}LastActiveTime");
$EM->Order("DESC");
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
$EM->TempPath($Environment->TempPath());
$EM->SearchInputPrefix($Configuration["SearchInputPrefix"]);
$EM->UploadPath($Environment->UploadPath());
$EM->ThumbnailMaximumDimension(48);
$EM->RecordsPerPage($Configuration["DatagridRowsPerPage"]);
$EM->BaseURL($Environment->URL()); // ???????????
#endregion Entity management common configuration

if(isset($_POST["btnExport"])){
	if(isset($_POST["btnSubmit"])){
		$EM->Export();
		$Terminal->Redirect($_POST["_Referer"]);
	}

	print $EM->ExportHTML();
}

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
	if(isset($_POST["btnSubmit"])){
		$_POST["{$Entity}SignUpIsActivated"] = 0;
		if($EM->Input())$Terminal->Redirect($_POST["_Referer"]); // Redirect to previous location
	}

	$EM->LoadExistingData();

	#region Default value
	SetVariable($Field = "GenderID", SetVariable("{$EM->SearchInputPrefix()}{$Field}"));
	SetVariable($Field = "LanguageID", SetVariable("{$EM->SearchInputPrefix()}{$Field}"));
	#endregion Default value

	$EM->InputUIHTML([
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Sign") . "InName", $EM->InputWidth(), null, true, null), "{$Caption} in name", null, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Email") . "", $EM->InputWidth(), null, true, INPUT_TYPE_EMAIL), "{$Caption}", null, true, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Password") . "", $EM->InputFullWidth()), "{$Caption}", true, null, $EM->FieldCaptionInlineWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Name" . ($Caption = "First") . "", $EM->InputWidth(), null, true), "Name: {$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Name" . ($Caption = "Last") . "", $EM->InputWidth(), null, true), "Name: {$Caption}", null, true, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Gender") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Phone" . ($Caption = "Mobile") . "", $EM->InputWidth(), null, null), "Phone: {$Caption}", null, true, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Picture") . "", $Configuration["InputFullWidth"], "{$Environment->UploadURL()}{$EM->LowercaseEntityName()}/" . (isset($_POST["{$Entity}{$Caption}"]) ? $_POST["{$Entity}{$Caption}"] : null) . "", null, INPUT_TYPE_FILE), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Address" . ($Caption = "Street") . "", $Configuration["InputFullWidth"]), "Address: {$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Address" . ($Caption = "City") . "", $EM->InputWidth()), "Address: {$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Address" . ($Caption = "State") . "", $EM->InputInlineWidth()), "{$Caption}", null, true, $EM->FieldCaptionInlineWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}Address" . ($Caption = "ZIP") . "", $EM->InputWidth()), "Address: {$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Select("{$Entity}Address" . ($Caption = "Country") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), new option(), "{$OptionEntity}LookupCaption"), "{$Caption}", null, true, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\CheckboxGroup("User" . ($Caption = "Group") . "ID", $Table[$OptionEntity = "User{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}ID IN (11, 12, 13)", "{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}Weight DESC"), null, "{$OptionEntity}LookupCaption", null, "{$OptionEntity}ID"), "{$Caption}", true, null, $EM->FieldCaptionWidth(), $Configuration["FieldContentFullWidth"]),
		HTML\UI\Field(HTML\UI\RadioGroup("{$Entity}Is" . ($Caption = "Active") . "", [new HTML\UI\Radio(1, "Yes"), new HTML\UI\Radio(0, "No")]), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
	]);

	print $EM->InputHTML();
}

#region List
$EM->SearchSQL([
	// Custom fixed search condition
	"1 = 1 AND {$Table["{$Entity}"]->Alias()}.{$Entity}ID <> " . intval($Session->User()->ID()) . "",

	// Search interface specific condition
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}SignInName") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%'" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Email") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%'" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Name") . "", SetVariable($Column)) ? "({$Table["{$Entity}"]->Alias()}.{$Column}First LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%' OR {$Table["{$Entity}"]->Alias()}.{$Column}Middle LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%' OR {$Table["{$Entity}"]->Alias()}.{$Column}Last LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%')" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Phone") . "", SetVariable($Column)) ? "({$Table["{$Entity}"]->Alias()}.{$Column}Mobile LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%' OR {$Table["{$Entity}"]->Alias()}.{$Column}Home LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%' OR {$Table["{$Entity}"]->Alias()}.{$Column}Work LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%' OR {$Table["{$Entity}"]->Alias()}.{$Column}Other LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%')" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}IsActive") . "", SetVariable($Column, "")) !== "" ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
]);

$EM->SearchUIHTML([
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Sign") . "InName", 200), "{$Caption} in", null, null),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Email") . "", 200), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Name") . "", 200), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Phone") . "", 200), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}{$Entity}Is" . ($Caption = "Active") . "", [new Option(), new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true),
]);

print $EM->ListHTML();
#region List
?>