SELECT			{ALIAS}.*,
				CONCAT({ALIAS}.UserUserGroupID) AS {ENTITY}LookupCaption,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	/*LEFT JOIN		X AS Y ON Y.YID = {ALIAS}.YID*/
