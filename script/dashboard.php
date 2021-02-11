<?php


namespace sPHP;
// DebugDump($User);
$Month = date('F');

$RecoredSet = $Database->Query("
                        SELECT 			COUNT(0) AS PaidCount,
                                                SUM(LS.LoanSchemePayPerInstallment) AS PaidTotal
                        FROM 			      ims_loantransaction AS LT
                              LEFT JOIN	      ims_loan AS L ON L.LoanID = LT.LoanID
                              LEFT JOIN	      ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = L.UserID
                        WHERE			      MONTH(LT.LoanTransactionPaidDate) = MONTH(CURRENT_DATE())
                              AND			YEAR(LT.LoanTransactionPaidDate) = YEAR(CURRENT_DATE())
                              AND			LT.LoanTransactionIsPaid = 1;
                        
                        SELECT 			COUNT(0) AS UnPaidCount,
                                                SUM(LS.LoanSchemePayPerInstallment) AS UnPaidTotal
                        FROM 			      ims_loantransaction AS LT
                              LEFT JOIN	      ims_loan AS L ON L.LoanID = LT.LoanID
                              LEFT JOIN	      ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = L.UserID
                        WHERE			      MONTH(LT.LoanTransactionPayableDate) = MONTH(CURRENT_DATE())
                              AND			YEAR(LT.LoanTransactionPayableDate) = YEAR(CURRENT_DATE())
                              AND			LT.LoanTransactionIsPaid = 0;


");
// DebugDump($RecoredSet[0][0]);

print "<div class=\"Welcome\">
            <div class=\"Title\">Welcome {$User->Name()}!</div>
		</div>";

$Output[] = "
      <div class=\"ContainerRow\">

            <div class=\"Container Container_3Column\">
                  <div class=\"Subtitle\">Client</div>
                  <div class=\"Content Content_Height247\"></div>
            </div>


            <div class=\"Container Container_3Column\" id=\"paid\">
                  <div class=\"Subtitle\">Paid</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Complete " . $RecoredSet[0][0]['PaidCount'] . " Transactions</p>
                        <p> Paid Amount $" . $RecoredSet[0][0]['PaidTotal'] . "</p>
                  </div>
            </div>

            <div class=\"Container Container_3Column\" id=\"unpaid\">
                  <div class=\"Subtitle\">Due</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Remain " . $RecoredSet[1][0]['UnPaidCount'] . " Transactions</p>
                        <p> Due Amount $" . $RecoredSet[1][0]['UnPaidTotal'] . "</p>
                  </div>
            </div>
      </div>";


print "
      " . implode(null, $Output) . "
";

?>