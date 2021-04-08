<?php
	namespace sPHP; // Use framework namespace for shortcut to constants

    #region Reusable shortcut variable
    $Name = "NMS";
    $ShortName = "NMS";
    $Domain = $_SERVER["SERVER_NAME"];
	$LocalHost = "127.0.0.1, ::1, LocalHost, 192.168.1.1, 192.168.1.10, 192.168.137.1";

	$SupportEmail = strtolower("Care@BondStein.Com");
	$SupportCallCenterNumber = "+8809611898989";
	$URL = strtolower("HTTP://{$Domain}/");
	$DatabaseUser = "root";
	$DatabaseName = "wapssolution_ngo";
    #endregion Reusable shortcut variable

	$Configuration = [
		// Custom
		"FieldCaptionWidth"				=>	190,
		"FieldCaptionInlineWidth"		=>	190,
		"FieldContentWidth"				=>	null,
		"FieldContentInlineWidth"		=>	null,
		"FieldContentFullWidth"			=>	750,
		"InputWidth"					=>	265,
		"InputInlineWidth"				=>	265,
		"InputFullWidth"				=>	750,
		"InputDateWidth"				=>	168,
		"InputTimeWidth"				=>	116,
		"TextareaHeight"				=>	75,
		"DatagridRowsPerPage"			=>	50,
		"Icon"							=> "favicon",
		"ThemeColor"					=>	"#F69E03", 
		"UserDeviceNotification"		=>	false, 
		"CopyrightYearFrom"				=>	2020,

		// System
		"AdministratorEmail"			=>	"Administrator@System.Dom",
		"AdministratorPasswordHash"		=>	"5f4dcc3b5aa765d61d8327deb882cf99", // Default for 'password'; Use  https://www.md5hashgenerator.com/
		"AdministratorName"				=>	"System Administrator",

		"CompanyName"					=>	"{$Name}",
		"CompanyAddress"				=>	"Dhaka, Bangladesh.",
		"CompanyPhone"					=>	"+8801552601833",
		"CompanyEmail"					=>	"Info@{$Domain}",
		"CompanyURL"					=>	"{$Environment->URL()}",

		"Name"							=>	"{$Name}",
		"ShortName"						=>	"{$ShortName}",
		"Title"							=>	"",
		"TitlePrefix"					=>	"{$ShortName}",
		"TitleSuffix"					=>	"",
		"TitleSeperator"				=>	": ",

		"Description"					=>	"{$Name} sample application",
		"Keyword"						=>	"{$Name}, {$ShortName}, Sample, Application",

		"DateFormat"					=>	"D, M j, Y",
		"ShortDateFormat"				=>	"M j, Y",
		"LongDateFormat"				=>	"l, F j, Y",
		"TimeFormat"					=>	"H:i:s",

		"DatabaseType"					=>	DATABASE_TYPE_MYSQL,
		"DatabaseHost"					=>	"127.0.0.1",
		"DatabaseUser"					=>	"{$DatabaseUser }",
		"DatabasePassword"				=>	"",
		"DatabaseName"					=>	"{$DatabaseName}",
		"DatabaseODBCDriver"			=>	"SQL Server Native Client 11.0",
		"DatabaseTablePrefix"			=>	"sphp_",
		"DatabaseTimezone"				=>	"+06:00", // Using named timezone is unstable in some cases
		"DatabaseStrictMode"			=>	true,
		"DatabaseLogTraffic"			=>	true,
		"DatabaseUserAuthentication"	=>	false,

		"DatabaseTable"					=>	[ // Defaine database tables for automatic preset operations
												"" . ($Entity = "Loan") . "" => new Database\Table("{$Entity}", null, null, null, null, null, "ims_"),
												"" . ($Entity = "Loan") . "Scheme" => new Database\Table("{$Entity} scheme", null, null, null, null, null, "ims_"),
												"" . ($Entity = "Loan") . "Transaction" => new Database\Table("{$Entity} transaction", null, null, null, null, null, "ims_"),
												"" . ($Entity = "Invest") . "" => new Database\Table("{$Entity}", null, null, null, null, null, "ims_"),
												"" . ($Entity = "Invest") . "Scheme" . "Settings" => new Database\Table("{$Entity} scheme settings", null, null, null, null, null, "ims_"),
												"" . ($Entity = "Invest") . "Transaction" => new Database\Table("{$Entity} transaction", null, null, null, null, null, "ims_"),
												
											],

		// "FieldCaptionWidth"				=>	140,
		// "FieldCaptionInlineWidth"		=>	140,
		// "FieldContentWidth"				=>	null,
		// "FieldContentInlineWidth"		=>	null,
		// "FieldContentFullWidth"			=>	null,
		// "InputWidth"					=>	250,
		// "InputInlineWidth"				=>	250,
		// "InputFullWidth"				=>	670,
		// "TextareaHeight"				=>	75,

		"TinyMCETextareaTheme"			=>	"advanced", // advanced, simple
		"TinyMCETextareaSkin"			=>	"o2k7", // o2k7, default, highcontrast

		"Stylesheet"					=>	[ // Array for multiple style sheets
												"{$Environment->URL()}style/loader.css",
											],

		"JavaScript"					=>	[ // Array for multiple JavaScripts
												"{$Environment->URL()}javascript/3rdparty/jquery-3.5.0.min.js",
												"{$Environment->URL()}javascript/3rdparty/tinymce/tiny_mce.js",
												"{$Environment->URL()}javascript/3rdparty/chartjs/Chart.min.js",
												"{$Environment->URL()}javascript/3rdparty/chartjs/chartjs-plugin-datalabels.js",
												"{$Environment->URL()}javascript/3rdparty/md5.js",
												"{$Environment->URL()}javascript/3rdparty/w2ui/w2ui-1.5.rc1.js",
												//"{$Environment->URL()}javascript/3rdparty/popper.min.js",
												"{$Environment->URL()}javascript/3rdparty/moment.min.js",
												//"{$Environment->URL()}javascript/3rdparty/bootstrap/bootstrap.min.js",
												"{$Environment->URL()}javascript/3rdparty/bootstrap/bootstrap-table.js",
												"{$Environment->URL()}javascript/sjs.js",
												//"{$Environment->URL()}javascript/library/dhtml.js",
												//"{$Environment->URL()}javascript/library/dom.js",
												"{$Environment->URL()}javascript/main.js",
											],

		"HTMLHeadCode"					=>	"
												<!-- BEGIN: HTML/JavaScript for the head section -->
												<!-- END: HTML/JavaScript for the head section -->
											",

		"EncryptionKey"					=>	"{$Name} for {$_SERVER["SERVER_NAME"]}",
		"UseSystemScript"				=>	true,
		"CronNotificationInterval"		=>	10, // Notification batch send out interval in seconds
		"CronMaximumExecutionTime"		=>	60 * 60, // Maximum execution & resume time for Application cron in seconds
		"SendNotification"				=>	false,

		"UserDeviceNotification"		=>	false, // Use browser notification
		"UserSignInNotification"		=>	false, // Notification on User sign in for ADMINISTRATOR

		"SMTPBodyStyle"					=>	"margin: 15px; box-shadow: 0 0 5px 0 Black; padding: 15px;",
		"SMTPHost"						=>	null,
		"SMTPPort"						=>	null,
		"SMTPUser"						=>	null,
		"SMTPPassword"					=>	null,

		"ContentEditMode"				=>	false,
		"ContentEditModeServer"			=>	$LocalHost,
		"ContentEditModeClient"			=>	$LocalHost,

		"CustomError"					=>	true,
		"DebugMode"						=>	false,
		"DebugModeServer"				=>	$LocalHost,
		"DebugModeClient"				=>	$LocalHost,

		"SessionName"					=>	"{$Name}@{$Domain}",
		"SessionLifetime"				=>	20 * 60, // In seconds
		"SessionIsolate"				=>	true,

		"Viewport"						=>	"width=device-width, initial-scale=1.0",

		"LanguageName"					=>	"English (US)",
		"LanguageCode"					=>	"EN",
		"LanguageRegionCode"			=>	"US",
		"LanguageNativeName"			=>	"English (US)",
		"LanguageNativelyName"			=>	"English (US)", // Name in native alphabet

		"GuestEmail"					=>	"Guest@{$Domain}",
		"GuestName"						=>	"Guest Visitor",

		"TemplateCacheLifetime"			=>	5 * 60, // In seconds
		"TemplateCacheActionMarker"		=>	"#",

		"Timezone"						=>	"Asia/Dhaka",
		"DocumentType"					=>	DOCUMENT_TYPE_HTML,
		"DefaultScript"					=>	"Home",
		"CharacterSet"					=>	CHARACTER_SET_UTF8,
		"StatusCode"					=>	HTTP_STATUS_CODE_OK,

		"VersionMajor"					=>	1,
		"VersionMinor"					=>	0,
		"VersionRevision"				=>	0,

		// Other
		"SearchInputPrefix"				=>	"Search_",
		"EmailCSS"                      =>  "",
		"EmailHeader"                   =>  "
												<div style=\"background-color: White; color: Black; font-family: Roboto, Helvetica, Verdana, Tahoma, Arial; font-size: 14px; line-height: 1.62;\">
													<div>
											",
		"EmailFooter"                   =>  "
													</div>
	
													<div>
														<div>
															<a href=\"{$URL}\" style=\"display: inliine-block; color: Black; font-weight: bold; text-decoration: none;\">
																<img src=\"{$URL}image/" . strtolower($Domain) . "/logo.png\" alt=\"Logo\" style=\"width: 128px;\">
																<span style=\"display: block;\">{$Name}</span>
															</a>
														</div>
	
														<div>
															<div style=\"font-weight: bold;\">Customer Support Team</div>
															<div><a href=\"tel:{$SupportCallCenterNumber}\" style=\"color: Black; text-decoration: none;\">{$SupportCallCenterNumber}</a></div>
															<div><a href=\"mailto:{$SupportEmail}\" style=\"color: Black; text-decoration: none;\">{$SupportEmail}</a></div>
														</div>
	
														<div style=\"margin-top: 15px; color: Grey; font-size: 75%;\">This e-mail is private and confidential and may be legally privileged. If you have received this e-mail message in error please also notify our Compliance Department at <a href=\"mailto:compliance@bondstein.com\" style=\"color: Blue; text-decoration: none;\">compliance@bondstein.com</a>. Please delete this message from your computer and destroy any copies which have been made. The contents of this email do not necessarily represent the views or policies of Bondstein Technologies Limited, its employees or associates.</div>
													</div>
												</div>
											",
		"EmailHeaderAlert"				=>  "
												<p>Dear Valued Customer,</p>
												<p>Greetings from {$Name}. Thanks for using our service. We are committed to help you manage your vehicle(s) more efficiently. Our system has identified an event which is being notified to you via this email. Please find the event details below-</p>
											",
		"EmailFooterAlert"				=>  "
												<p>For further assistance, please feel free to contact us via <a href=\"tel:{$SupportCallCenterNumber}\" style=\"color: Blue; text-decoration: none;\">{$SupportCallCenterNumber}</a> or email us at <a href=\"mailto:{$SupportEmail}\" style=\"color: Blue; text-decoration: none;\">{$SupportEmail}</a>. If you don't want to receive notification emails, you can change settings through alert management by logging into your dashboard via this link <a href=\"{$URL}\" style=\"color: Blue; text-decoration: none;\">{$URL}</a>.</p>
												<p>We want to thank you once again for choosing us as your tracking partner. We are here to help you 24x7x365</p>
											",
		"EmailFromAddress"				=>	null,
	];
?>