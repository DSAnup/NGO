SELECT			{ALIAS}.*,
				CONCAT({ALIAS}.{ENTITY}ID) AS {ENTITY}LookupCaption,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	{PREFIX}user AS U ON U.UserID = {ALIAS}.UserID
