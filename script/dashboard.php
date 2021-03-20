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
                        WHERE			      MONTH(LT.LoanTransactionPayableDate) = MONTH(CURRENT_DATE())
                              AND			YEAR(LT.LoanTransactionPayableDate) = YEAR(CURRENT_DATE())
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

                        SELECT 			COUNT(0) AS TransactionCount,
                                                IF(LT.LoanTransactionIsPaid = 1, 'PAID', 'UNPAID') AS Status,
                                                IF(LT.LoanTransactionIsPaid = 1, 'green', 'red') AS Color
                        FROM 			      ims_loantransaction AS LT
                              LEFT JOIN	      ims_loan AS L ON L.LoanID = LT.LoanID
                              LEFT JOIN	      ims_loanscheme AS LS ON LS.LoanSchemeID = L.LoanSchemeID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = L.UserID
                        WHERE			      (MONTH(LT.LoanTransactionPayableDate) = MONTH(CURRENT_DATE())
                                    AND			YEAR(LT.LoanTransactionPayableDate) = YEAR(CURRENT_DATE()))
                        GROUP BY			LT.LoanTransactionIsPaid


");

$InvestRecoredSet = $Database->Query("
                        SELECT 			COUNT(0) AS PaidCount,
                                                SUM(ISS.InvestSchemeSettingsPayPerInstallment) AS PaidTotal
                        FROM 			      ims_investtransaction AS IT
                              LEFT JOIN	      ims_invest AS I ON I.InvestID = IT.InvestID
                              LEFT JOIN	      ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = I.UserID
                        WHERE			      MONTH(IT.InvestTransactionPayableDate) = MONTH(CURRENT_DATE())
                              AND			YEAR(IT.InvestTransactionPayableDate) = YEAR(CURRENT_DATE())
                              AND			IT.InvestTransactionIsPaid = 1;
                        
                        SELECT 			COUNT(0) AS UnPaidCount,
                                                SUM(ISS.InvestSchemeSettingsPayPerInstallment) AS UnPaidTotal
                        FROM 			      ims_investtransaction AS IT
                              LEFT JOIN	      ims_invest AS I ON I.InvestID = IT.InvestID
                              LEFT JOIN	      ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = I.UserID
                        WHERE			      MONTH(IT.InvestTransactionPayableDate) = MONTH(CURRENT_DATE())
                              AND			YEAR(IT.InvestTransactionPayableDate) = YEAR(CURRENT_DATE())
                              AND			IT.InvestTransactionIsPaid = 0;

                        SELECT 			COUNT(0) AS TransactionCount,
                                                IF(IT.InvestTransactionIsPaid = 1, 'PAID', 'UNPAID') AS Status,
                                                IF(IT.InvestTransactionIsPaid = 1, 'green', 'red') AS Color
                        FROM 			      ims_investtransaction AS IT
                              LEFT JOIN	      ims_invest AS I ON I.InvestID = IT.InvestID
                              LEFT JOIN	      ims_investschemesettings AS ISS ON ISS.InvestSchemeSettingsID = I.InvestSchemeSettingsID
                              LEFT JOIN	      sphp_user AS U ON U.UserID = I.UserID
                        WHERE			      (MONTH(IT.InvestTransactionPayableDate) = MONTH(CURRENT_DATE())
                                    AND			YEAR(IT.InvestTransactionPayableDate) = YEAR(CURRENT_DATE()))
                        GROUP BY			IT.InvestTransactionIsPaid


");
// DebugDump($InvestRecoredSet);

print "<div class=\"Welcome\">
            <div class=\"Title\">Welcome {$User->Name()}!</div>
		</div>";

$Output[] = "
      <div class=\"ContainerRow\">
            <h3>Lend Statistics</h3>      
            <div class=\"Container Container_3Column\">
                  <div class=\"Subtitle\">Status</div>
                  <div class=\"Content Content_Height247\"><canvas id=\"StatusChart\" class=\"Chart\"></canvas></div>
            </div>

            <div class=\"Container Container_3Column\" id=\"paid\">
                  <div class=\"Subtitle\">Paid</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Complete " . $RecoredSet[0][0]['PaidCount'] . " Transactions</p>
                        <p> Paid Amount ৳" . $RecoredSet[0][0]['PaidTotal'] . "</p>
                  </div>
            </div>

            <div class=\"Container Container_3Column\" id=\"unpaid\">
                  <div class=\"Subtitle\">Due</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Remain " . $RecoredSet[1][0]['UnPaidCount'] . " Transactions</p>
                        <p> Due Amount ৳" . $RecoredSet[1][0]['UnPaidTotal'] . "</p>
                  </div>
            </div>

      </div>
      <script>
      " . (isset($RecoredSet[2]) ? "
            var StatusChart = new Chart(document.getElementById('StatusChart').getContext('2d'), {
                type: 'pie', // bar, horizontalBar, line, doughnut, pie
                data: {
                    labels: ['" . implode("', '", array_column($RecoredSet[2], "Status")) . "'],
                    datasets: [
                        {
                            backgroundColor: ['" . implode("', '", array_column($RecoredSet[2], "Color")) . "'],
                            data: [" . implode(", ", array_column($RecoredSet[2], "TransactionCount")) . "],
                            borderWidth: 0.5,
                            hoverBackgroundColor: '#ff99dd',
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false, // true, false
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                        },
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {

                                let datasets = ctx.chart.data.datasets;
                    
                                if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / sum) * 100) + '%';
                                return percentage;
                                } else {
                                return percentage;
                                }
                            },
                            color: 'black',
                            anchor: 'center',
                            align: 'center',
                            font: {
                                weight: 'bold',
                            },
                        },
                    },
                },
            });
        " : null) . "

		</script>
      ";


print "
      " . implode(null, $Output) . "
";

$Output2[] = "
      <div class=\"ContainerRow\">
            <h3>Invest Statistics</h3>      
            <div class=\"Container Container_3Column\">
                  <div class=\"Subtitle\">Status</div>
                  <div class=\"Content Content_Height247\"><canvas id=\"InvestChart\" class=\"Chart\"></canvas></div>
            </div>

            <div class=\"Container Container_3Column\" id=\"paid\">
                  <div class=\"Subtitle\">Paid</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Complete " . $InvestRecoredSet[0][0]['PaidCount'] . " Transactions</p>
                        <p> Paid Amount ৳" . $InvestRecoredSet[0][0]['PaidTotal'] . "</p>
                  </div>
            </div>

            <div class=\"Container Container_3Column\" id=\"unpaid\">
                  <div class=\"Subtitle\">Due</div>
                  <div class=\"Content Content_Height247\">
                        <h3>" . $Month . "</h3>
                        <p> Remain " . $InvestRecoredSet[1][0]['UnPaidCount'] . " Transactions</p>
                        <p> Due Amount ৳" . $InvestRecoredSet[1][0]['UnPaidTotal'] . "</p>
                  </div>
            </div>

      </div>
      <script>
      " . (isset($InvestRecoredSet[2]) ? "
            var InvestChart = new Chart(document.getElementById('InvestChart').getContext('2d'), {
                type: 'pie', // bar, horizontalBar, line, doughnut, pie
                data: {
                    labels: ['" . implode("', '", array_column($InvestRecoredSet[2], "Status")) . "'],
                    datasets: [
                        {
                            backgroundColor: ['" . implode("', '", array_column($InvestRecoredSet[2], "Color")) . "'],
                            data: [" . implode(", ", array_column($InvestRecoredSet[2], "TransactionCount")) . "],
                            borderWidth: 0.5,
                            hoverBackgroundColor: '#ff99dd',
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false, // true, false
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                        },
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {

                                let datasets = ctx.chart.data.datasets;
                    
                                if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / sum) * 100) + '%';
                                return percentage;
                                } else {
                                return percentage;
                                }
                            },
                            color: 'black',
                            anchor: 'center',
                            align: 'center',
                            font: {
                                weight: 'bold',
                            },
                        },
                    },
                },
            });
        " : null) . "

		</script>
      ";

print "
      " . implode(null, $Output2) . "
";

?>