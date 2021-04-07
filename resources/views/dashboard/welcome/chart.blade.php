<div class="box box-light direct-chat direct-chat-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Bar Chart</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->

  <div class="box-body p-0">
    <div class="chart">
      <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
          <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
          <div class=""></div>
        </div>
      </div>
      <canvas id="barChart"></canvas>
    </div>
  </div>
  <!-- /.card-body -->
  <!-- /.box-footer -->
</div>

@push('js')
<script>
  $(function() {

    var charts = {
      init: function () {
        this.ajaxGetPostMonthlyData();
      },

      ajaxGetPostMonthlyData: function () {
        var urlPath =  "{{ route('dashboard.charts') }}";
        var request = $.ajax( {
          method: 'GET',
          url: urlPath
      } );

        request.done( function ( response ) {
          charts.createCompletedJobsChart( response );
        });
      },

      /**
      * Created the Completed Jobs Chart
      */
      createCompletedJobsChart: function ( response ) {

        var ctx = document.getElementById("barChart");
        var myLineChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: response.months, // The response got from the ajax request containing all month names in the database
            datasets: [{
              label: "Posts",
              lineTension: 0.2,
              backgroundColor: "rgba(2,117,216,0.2)",
              borderColor: "rgba(2,117,216,1)",
              data: response.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: response.max, // The response got from the ajax request containing max limit for y axis
                  maxTicksLimit: 5
                },
                gridLines: {
                  color: "rgba(0, 0, 0, .125)",
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
      }
    };
    charts.init();

  });
</script>
@endpush