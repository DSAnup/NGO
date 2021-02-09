<?php
namespace sPHP;

?>
	</div>
</main>

<footer>
	<section class="Fixed">
		<a href="<?=$Environment->URL()?>" class="Copyright"><img src="<?="{$Environment->ImageURL()}{$_SERVER["SERVER_NAME"]}/"?>logo.png" alt="Logo" class="Logo"><?=$Configuration["CompanyName"]?> &copy; <?=$Configuration["CopyrightYearFrom"]?> - <?=date("Y")?></a>
		<a href="http://BondStein.Com" target="_blank" class="Developer">Technology built by <img src="<?=$Environment->ImageURL()?>developer_logo.png" alt="BondStein" class="Logo"></a>
	</section>
</footer>

<a href="#PageLocationTop" class="Anchor_PageLocationTop">▲</a>

<div id="LoadingPopup" class="LoadingPopup">
	<div class="Dialog">Loading... Please wait</div>
</div>

<!-- <script>tinymce.init({selector:'textarea'});</script> -->