SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.InvestTransactionID, '') AS {ENTITY}LookupCaption, 
				U.UserSignInName, 
				CONCAT(L.InvestPrefix, '_', L.InvestID) AS InvestIdentity,
				LS.InvestSchemeSettingsName, 
				LS.InvestSchemeSettingsPayPerInstallment,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	ims_invest AS L ON L.InvestID = {ALIAS}.InvestID
	LEFT JOIN	ims_investschemesettings AS LS ON L.InvestSchemeSettingsID = LS.InvestSchemeSettingsID
	LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
	/*LEFT JOIN		X AS Y ON Y.YID = {ALIAS}.YID*/
