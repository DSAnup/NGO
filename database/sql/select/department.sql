SELECT			{ALIAS}.*,
				CONCAT(E.EnterpriseName, ', ', EC.CountryName, ': ', O.OrganizationName, '- ', {ALIAS}.{ENTITY}Name) AS {ENTITY}LookupCaption,

				O.OrganizationName,

				E.EnterpriseName,

				EC.CountryName AS EnterpriseCountryName,

				DT.DepartmentTypeName,

				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	{PREFIX}organization AS O ON O.OrganizationID = {ALIAS}.OrganizationID
	LEFT JOIN	{PREFIX}enterprise AS E ON E.EnterpriseID = O.EnterpriseID
	LEFT JOIN	{PREFIX}country AS EC ON EC.CountryID = E.CountryID
	LEFT JOIN	{PREFIX}{NAME}type AS DT ON DT.{ENTITY}TypeID = {ALIAS}.{ENTITY}TypeID

