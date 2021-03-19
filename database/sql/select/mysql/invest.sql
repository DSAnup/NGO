SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.InvestPrefix, '_', {ALIAS}.InvestID) AS {ENTITY}LookupCaption, 
				U.UserSignInName, 
				U.UserPhoneMobile,
				IIS.InvestSchemeSettingsName,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	sphp_user AS U ON U.UserID = {ALIAS}.UserID
	LEFT JOIN	ims_investschemesettings AS IIS ON IIS.InvestSchemeSettingsID = {ALIAS}.InvestSchemeSettingsID
	/*LEFT JOIN		X AS Y ON Y.YID = {ALIAS}.YID*/
