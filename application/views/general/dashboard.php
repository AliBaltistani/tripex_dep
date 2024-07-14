
<?php 

$today = date('Y-m-d'); // Get today's date
$dateBefore3Months = date('Y-m-d', strtotime('-3 months', strtotime($today))); // Calculate the date 3 month before
$dateBefore1Months = date('Y-m-d', strtotime('-1 months', strtotime($today))); // Calculate the date 1 month before
$last_14_days = date('Y-m-d', strtotime('-14 days', strtotime($today))); // Calculate the date 14 days before
$last_7_days = date('Y-m-d', strtotime('-7 days', strtotime($today))); // Calculate the date 7 days before

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= totalCount('tbl_booking','','') ?></h3>
                  <p>Sales | Total</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php  
                    $total_per =  (( totalCount('tbl_booking','',['status'=> ACTIVE]) / totalCount('tbl_booking','','') ) * 100);
                   echo  number_format((float)$total_per, 2, '.', ''); 
                   ?><sup style="font-size: 20px">%</sup></h3>
                  <p>Completed Tasks</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?= totalCount('tbl_users','','') ?></h3>
                  <p>New User</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Reopened Issue</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <div class="row">
          <div class="col-md-8">
          <h1>Sales Data Visualization</h1>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="isAdmin">Filter </label>
                <select class="form-control required" id="isAdmin" onchange="load_data(this.value)" name="role_type">
                    <option value="">Select date</option>
                    <option value="366">Last 1 Year</option>
                    <option value="270">Last 9 month</option>
                    <option value="180">Last 6 month</option>
                    <option value="90" selected>Last 3 month</option>
                    <option value="30"> Last 1 Month</option>
                    <option value="14">Last 14 days</option>
                    <option value="7">This Weak</option>
                    <option value="1">Today</option>
                </select>
            </div>
          </div>
        </div>
          <canvas id="salesChart" width="800" height="400"></canvas>
        </div>
      </div>
    </section>
</div>

<script>

function load_data(date){

      // Fetch data from PHP script
    fetch('<?= base_url()?>Task/getGraphData?filter='+date)
        .then(response => response.json())
        .then(data => {
            const categories = data.categories;
            const sales = data.sales;
            const revenue = data.revenue;
            const expenses = data.expenses;
            const profit_losses = data.profit_losses;

            // Render Bar Chart
            renderBarChart(categories, sales, revenue, expenses, profit_losses);
        })
        .catch(error => console.error('Error fetching data:', error));

     } // end load_data()

     var myChart = null;

     function renderBarChart(categories, sales, revenue, expenses, profit_losses) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        if(myChart != null){
            myChart.destroy();
        };
myChart =  new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [
                    {
                        label: 'Sales',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        data: sales
                    },
                    {
                        label: 'Revenue',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        data: revenue
                    },
                    {
                        label: 'Expenses',
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        data: expenses
                    },
                    {
                        label: 'Profit/Losses',
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        data: profit_losses
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    }


    window.onload = function() {
      load_data(90);
    };

  </script>