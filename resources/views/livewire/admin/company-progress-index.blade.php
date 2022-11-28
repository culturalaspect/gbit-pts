<div class="content-container">
    @if (Session::has('message'))
        <div class="
            m-2
            alert
            customize-alert
            alert-dismissible
            border-success
            text-success
            fade
            show
            remove-close-icon
        "
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-x fill-white text-success feather-sm">
                </svg>
            </button>
            <div class="
      d-flex
      align-items-center
      font-weight-medium
      me-3 me-md-0
    ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-info text-success fill-white feather-sm me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="8"></line>
                </svg>
                {{ Session::get('message') }}
            </div>
        </div>
    @endif

    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">{{ $main_title }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ auth()->user()->role_id == 1 ? 'Admin' : (auth()->user()->role_id == 2 ? 'Bank' : 'Company') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <!-- Admin Panel # 1 -->

        @if(auth()->user()->role_id == 1)
            <div class="mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Company Progress Graph</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas id="line-chart" height="319" width="640"
                                style="display: block; height: 213px; width: 427px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class=" mt-3">
            <!-- Column -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Company Information</h5>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Company</td>
                                        <td>{{ $company->company_name }}</td>
                                        <td>CEO</td>
                                        <td>{{ $company->ceo_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $company->address }}</td>
                                        <td>Cell No</td>
                                        <td>{{ $company->cell_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>Official Email</td>
                                        <td>{{ $company->official_email }}</td>
                                        <td>Online Profile</td>
                                        <td><a class="btn btn-success" href="{{ $company->online_profile_link }}">Online
                                                Profile</a></td>
                                    </tr>
                                    <tr>
                                        <td>Total Employees</td>
                                        <td>{{ $company->total_employees }}</td>
                                        <td>Total Revenue</td>
                                        <td>{{ $company->total_revenue }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Profit</td>
                                        <td>{{ $company->total_profit }}</td>
                                        <td>District</td>
                                        <td>{{ isset($company->district->district_name) ? $company->district->district_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ isset($company->category->category_name) ? $company->category->category_name : '' }}</td>
                                        <td>Phase</td>
                                        <td>{{ App\Models\Phase::find($phase_id)->phase_name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
        </div>

        <div class=" mt-3">
            <!-- Column -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Financial Information</h5>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total Sanctioned Loan</td>
                                        <td>{{ round($company_financials->total_sanctioned_amount, 2) }}</td>
                                        <td>Total Recovered Amount</td>
                                        <td>{{ round($company_financials->total_recovered_amount, 2) }}</td>
                                        <td>Total Remaining Balance</td>
                                        <td>{{ round($company_financials->total_difference_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Installment Amount</td>
                                        <td>{{ round($company_financials->installment_amount, 2) }}</td>
                                        <td>Total Markup %</td>
                                        <td>{{ round($company_financials->installment_markup_percentage, 2) }}</td>
                                        <td>Total Amount with Markup</td>
                                        <td>{{ round($company_financials->total_amount_with_markup, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Installments</td>
                                        <td>{{ $company_financials->total_installments }}</td>
                                        <td>Total Installments Paid</td>
                                        <td>{{ $company_financials->total_paid_installments }}</td>
                                        <td>Total Installments Remaining</td>
                                        <td>{{ $company_financials->total_remaining_installments }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phase</td>
                                        <td>{{ $company_financials->phase_name }}</td>
                                        <td>Sanctioned By KCBL</td>
                                        <td>{{ $company_financials->is_sanctioned_by_kcbl == 0 ? 'No' : 'Yes' }}</td>
                                        <td>All Formaalities Completed</td>
                                        <td>{{ $company_financials->is_completed_by_kcbl == 0 ? 'No' : 'Yes' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="card-title mb-2 mt-2">Installments</h5>
                        <div style="margin-left:100px;">
                            <div class="table-responsive">
                                <table class="table table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Installment #</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($installments as $installment)
                                            <tr>
                                                <td>{{ $installment->installment_no }}</td>
                                                <td>{{ $installment->amount_paid }}</td>
                                                <td>{{ date('d-m-Y', strtotime($installment->date_of_payment)) }}</td>
                                                <td><span class="badge bg-success text-sm">Paid</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
        </div>

        @if(auth()->user()->role_id == 1)
            <div class=" mt-3">
                <!-- Column -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Company Progress</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th>S.#</th>
                                            <th scope="col">Measure</th>
                                            <th scope="col">Total Employees</th>
                                            <th scope="col">Total Revenue</th>
                                            <th scope="col">Total Profit</th>
                                            <th scope="col">Total Utilization</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($cpms as $cpm)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $cpm->measure->measure_name }}</td>
                                                <td>{{ $cpm->total_employees }}</td>
                                                <td>{{ $cpm->total_revenue }}</td>
                                                <td>{{ $cpm->total_profit }}</td>
                                                <td>{{ $cpm->total_amount_utilized }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
            </div>
        @endif
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

</div>
{{-- End of Content Container --}}

@push('scripts')
    <script type="text/javascript">
        var t_employees = '{{ json_encode($graph_array['total_employees']) }}';
        var t_revenue = '{{ json_encode($graph_array['total_revenue']) }}';
        var t_profit = '{{ json_encode($graph_array['total_profit']) }}';
        var t_loan_util = '{{ json_encode($graph_array['total_loan_utilization']) }}';
        var x_axis = '{{ json_encode($graph_array['x-axis']) }}';
        var employees = JSON.parse(t_employees.replace(/&quot;/g, '"'));
        var revenue = JSON.parse(t_revenue.replace(/&quot;/g, '"'));
        var profit = JSON.parse(t_profit.replace(/&quot;/g, '"'));
        var utilization = JSON.parse(t_loan_util.replace(/&quot;/g, '"'));
        var axis = JSON.parse(x_axis.replace(/&quot;/g, '"'));

        new Chart(document.getElementById("line-chart"), {
            type: "line",
            data: {
                labels: axis,
                datasets: [{
                        data: employees,
                        label: "Total Employees",
                        borderColor: "#3e95cd",
                        fill: false,
                    },
                    {
                        data: revenue,
                        label: "Total Revenue",
                        borderColor: "#36a2eb",
                        fill: false,
                    },
                    {
                        data: profit,
                        label: "Total Profit",
                        borderColor: "#07b107",
                        fill: false,
                    },
                    {
                        data: utilization,
                        label: "Loan Utilization",
                        borderColor: "#ff6384",
                        fill: false,
                    }
                ],
            },
            options: {
                legend: {
                    labels: {
                        fontColor: "#b2b9bf",
                    },
                },
                title: {
                    display: true,
                    fontColor: "#b2b9bf",
                    text: "Company Progress Line Chart",
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "#b2b9bf",
                            fontSize: 12,
                        },
                    }, ],
                    xAxes: [{
                        ticks: {
                            fontColor: "#b2b9bf",
                            fontSize: 12,
                        },
                    }, ],
                },
            },
        });
    </script>
@endpush
