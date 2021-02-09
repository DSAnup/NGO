SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.LoanTransactionID, '') AS {ENTITY}LookupCaption, 
				U.UserSignInName, 
				CONCAT(L.LoanPrefix, '_', L.LoanID) AS LoanIdentity,
				LS.LoanSchemeName, 
				LS.LoanSchemePayPerInstallment,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	ims_loan AS L ON L.LoanID = {ALIAS}.LoanID
	LEFT JOIN	ims_loanscheme AS LS ON L.LoanSchemeID = LS.LoanSchemeID
	LEFT JOIN	sphp_user AS U ON U.UserID = L.UserID
-- GROUP BY		{ALIAS}.LoanID
	/*LEFT JOIN		X AS Y ON Y.YID = {ALIAS}.YID*/
