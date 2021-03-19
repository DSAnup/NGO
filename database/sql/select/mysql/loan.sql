SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.LoanPrefix, '_', {ALIAS}.LoanID) AS {ENTITY}LookupCaption,
				U.UserSignInName, 
				U.UserPhoneMobile,
				LS.LoanSchemeName,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	sphp_user AS U ON U.UserID = {ALIAS}.UserID
	LEFT JOIN	ims_loanscheme AS LS ON LS.LoanSchemeID = {ALIAS}.LoanSchemeID
	/*LEFT JOIN		X AS Y ON Y.YID = {ALIAS}.YID*/
