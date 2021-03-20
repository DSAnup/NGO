<?php
require __DIR__ . "/leftpanelnavigation.php";

if($User->UserGroupIdentifierHighest() == "OPERATIONS"){
	$Customer = $Table["User"]->Get("UserID = {$User->ID()}");

	if(isset($Customer[0])){
		$Customer = $Customer[0];
		$LeftPanelUserTitle = $Customer["UserNameFirst"].' '.$Customer["UserNameLast"];
	}
	else{
		// *** !!! SUSPICIOUS ACTIVITY !!! ***
		$LeftPanelUserTitle = "REPORT THIS";

		$Terminal->Redirect($Application->URL("User/SignOut"));
	}
}
elseif($User->UserGroupIdentifierHighest() == "CUSTOMER_MANAGER"){
	//$LeftPanelUserTitle = $Table["CustomerManager"]->Get("CM.UserID = {$User->ID()}")[0]["CustomerName"];
	$LeftPanelUserTitle = $User->Name();
}
else{
	$LeftPanelUserTitle = $User->Name();
}
?>

<div class="Beta">BETA</div>

<header id="PageLocationTop">
	<section class="Fixed">
		<a href="<?=$Environment->URL()?>" class="Logo">
			<img src="<?="{$Environment->ImageURL()}"?>localhost/logo.png" alt="Logo">
			<span class="Caption"><?=$Application->Name()?></span>
		</a>

		<div class="Right">

			<div class="Popper">
				<div class="Caption"><img src="<?php if($User->PictureThumbnail() !=NULL) echo $Environment->URL().'upload/user/'.$User->PictureThumbnail(); else  echo $Environment->IconURL()."user.png";?>" alt="User" class="Icon"></div>

				<div class="Content">
					<a href="<?=$Application->URL("User/Profile")?>"><img src="<?=$Environment->IconURL()?>userprofile.png" alt="Information" class="Icon">Profile</a>
					<hr>
					<a href="<?=$Application->URL("User/SignOut")?>"><img src="<?=$Environment->IconURL()?>exit.png" alt="Information" class="Icon">Sign out</a>
					<?=$User->UserGroupIdentifierHighest() == "ADMINISTRATOR" ? "<a href=\"{$Application->URL("User/Impersonate")}\"><img src=\"{$Environment->IconURL()}impersonate.png\" alt=\"Switch user\" class=\"Icon\">Switch user</a>" : null?>
				</div>
			</div>

		</div>
	</section>
</header>

<div class="LeftPanel">
	<span class="Marker">≡</span>

	<div class="Content">
		<div class="Customer"><?=$LeftPanelUserTitle?></div>
		<?=implode(null, $LeftPanelLinkHTML)?>
	</div>
	<div class="Beta">BETA</div>
</div>

<main>
	<div class="Content">
