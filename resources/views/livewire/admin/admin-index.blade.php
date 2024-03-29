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
                            <li class="breadcrumb-item"><a
                                    href="javascript:void(0);">{{ auth()->user()->role_id == 1 ? 'Admin' : (auth()->user()->role_id == 2 ? 'Bank' : 'Company') }}</a>
                            </li>
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

        <div class="row mt-3">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div
                                class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-info
                      ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-dollar-sign feather-xl">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                            <div class="ms-2 align-self-center">
                                <h3 class="mb-0">PKR {{ $top_cards_data['schemes_sum']->total_approved_amount }} M
                                </h3>
                                <h6 class="text-muted mb-0">Total Approved Amount</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div
                                class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-warning
                      ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-dollar-sign feather-xl">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                            <div class="ms-2 align-self-center">
                                <h3 class="mb-0">PKR
                                    {{ $top_cards_data['total_sanctioned']->total_sanctioned_amount }} M</h3>
                                <h6 class="text-muted mb-0">Total Disbursed Amount</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div
                                class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-primary
                      ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-users fill-white text-white">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="ms-2 align-self-center">
                                <h3 class="mb-0">
                                    {{ $top_cards_data['total_sanctioned']->total_sanctioned_companies }}</h3>
                                <h6 class="text-muted mb-0">Total Benefeciaries</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div
                                class="
                            round round-lg
                            text-white
                            d-flex
                            justify-content-center
                            align-items-center
                            rounded-circle
                            bg-danger
                          ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid feather-lg fill-white">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </div>
                            <div class="ms-2 align-self-center">
                                <h3 class="mb-0">{{ $top_cards_data['total_sanctioned']->total_companies }}</h3>
                                <h6 class="text-muted mb-0">Total Companies</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

        <div class="row gx-3">
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-primary rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-grid feather-lg fill-white">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $activities[0]->total_projects }}</h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Total Projects
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-success rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-archive feather-lg fill-white">
                                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                <rect x="1" y="3" width="22" height="5"></rect>
                                <line x1="10" y1="12" x2="14" y2="12"></line>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $activities[0]->total_activities }}</h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Total Activities
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-warning rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users feather-lg fill-white">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $activities[0]->total_in_progress_activities }}
                        </h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Activities Inprogress
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-danger rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-gift feather-lg fill-white">
                                <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                <rect x="2" y="7" width="20" height="5"></rect>
                                <line x1="12" y1="22" x2="12" y2="7"></line>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">
                            {{ $activities[0]->total_in_completed_activities }}</h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Activities Completed
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-info rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-credit-card feather-lg fill-white">
                                <rect x="1" y="4" width="22" height="16" rx="2"
                                    ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">
                            {{ $activities[0]->total_in_not_applicable_activities }}</h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Activities N/A
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 col-6">
                <div class="card text-white bg-secondary rounded">
                    <div class="card-body">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-github feather-lg fill-white">
                                <path
                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                </path>
                            </svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">
                            {{ round(($activities[0]->total_in_completed_activities / $activities[0]->total_activities) * 100, 2) }}
                            %</h3>
                        <p class="card-text text-white-50 fs-3 fw-normal">
                            Completion Ratio
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Panel # 2 -->
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Disbursed Amount</h4>
                        <h6 class="card-subtitle">List of companies with respective disbursed amount.</h6>
                        <div class="bar-graph">
                            @foreach ($companies as $company)
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{ ($company->total_sanctioned_amount_in_m / $top_cards_data['total_sanctioned']->total_sanctioned_amount) * 100 }}%">
                                    </div>
                                </div>
                                <div class="row list-inline d-flex justify-content-center align-items-center mb-2">
                                    <div class="col-lg-7">
                                        <h6 class="text-info mb-0"><i class="fa fa-circle font-10 me-2 "></i><a
                                                href="{{ url('admin/companyprogress/' . $company->id . '/' . $company->phase_id) }}">{{ $company->company_name }}</a>
                                        </h6>
                                    </div>
                                    <div class="col-lg-3">
                                        <h6 class=" text-success mb-0"><i
                                                class="fa fa-circle font-10 me-2"></i>{{ $company->phase_name }}
                                        </h6>
                                    </div>
                                    <div class="col-lg-2">
                                        <h6 class=" text-danger mb-0"><i
                                                class="fa fa-circle font-10 me-2"></i>{{ $company->total_sanctioned_amount_in_m }}
                                            M</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="card-footer">

                    </div> --}}
                </div>
            </div>

            {{-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-body little-profile text-center">
                        <h3 class="mb-0 text-primary">Azalea Group</h3>
                        <p class="text-secondary">Web Design &amp; Develompment</p>
                        <a href="javascript:void(0)"
                            class="mt-2 waves-effect waves-dark btn btn-success btn-sm">Online Profile</a>
                        <div class="row list-inline d-flex mt-2 mb-0 justify-content-center">
                            <div class="col-lg-12">
                                <small style="text-align: left;display:block;"
                                    class=" text-primary mb-0">Address</small>
                                <small style="text-align: justify;dispaly:block;">Mehboob Manzil No 3. Chinar Bagh
                                    Gilgit</small>
                            </div>
                        </div>
                        <div class="row list-inline d-flex mt-2 mb-0 justify-content-center">
                            <div class="col-lg-6">
                                <small style="text-align: left;display:block;" class="text-info mb-0">Phone</small>
                                <small style="text-align: justify;dispaly:block;">05811-452165</small>
                            </div>
                            <div class="col-lg-6">
                                <small style="text-align: left;display:block;" class=" text-primary mb-0">Cell
                                    No</small>
                                <small style="text-align: justify;dispaly:block;">0333-3367788</small>
                            </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="col-lg-4 col-md-4 mt-3">
                                <h3 class="mb-0 font-light">10 M</h3><small>Loan</small>
                            </div>
                            <div class="col-lg-4 col-md-4 mt-3">
                                <h3 class="mb-0 font-light">4.1 M</h3><small>Returned</small>
                            </div>
                            <div class="col-lg-4 col-md-4 mt-3">
                                <h3 class="mb-0 font-light">6.8 M</h3><small>Balance</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="border-bottom">
                            <h5 style="font-size:16px;" class="card-title mb-0 text-center p-10">District Wise Loan
                                Disbursed (Companies)</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="chartjs-size-monitor"
                                    style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas id="pie-chart" height="319" width="640"
                                    style="display: block; height: 213px; width: 427px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="border-bottom">
                            <h5 style="font-size:16px;" class="card-title mb-0 text-center p-10">District Wise Loan
                                Disbursed (Amount)</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="chartjs-size-monitor"
                                    style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas id="bar-chart-horizontal" height="319" width="640"
                                    style="display: block; height: 213px; width: 427px;"
                                    class="chartjs-render-monitor">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="border-bottom">
                            <h5 style="font-size:16px;" class="card-title mb-0 text-center p-10">Category Wise Loan
                                Disbursed (Amount)</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="chartjs-size-monitor"
                                    style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas id="bar-chart-horizontal-2" height="319" width="640"
                                    style="display: block; height: 213px; width: 427px;"
                                    class="chartjs-render-monitor">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- Temp Login --->


        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
{{-- End of Content Container --}}


@push('scripts')
    <script type="text/javascript">
        var d_names =
            '{{ !isset($dw_sep_array) ? json_encode([]) : json_encode(!empty($dw_sep_array['district_names'])) }}';
        var t_companies =
            '{{ !isset($dw_sep_array) ? json_encode([]) : json_encode(!empty($dw_sep_array['total_companies'])) }}';
        var t_amount_m =
            '{{ !isset($dw_sep_array) ? json_encode([]) : json_encode(!empty($dw_sep_array['total_amount_in_m'])) }}';
        var colors = '{{ !isset($dw_sep_array) ? json_encode([]) : json_encode(!empty($dw_sep_array['colors'])) }}';
        var labels = JSON.parse(d_names.replace(/&quot;/g, '"'));
        var data_nos = JSON.parse(t_companies.replace(/&quot;/g, '"'));
        var data_tam = JSON.parse(t_amount_m.replace(/&quot;/g, '"'));
        var backgroundColor = JSON.parse(colors.replace(/&quot;/g, '"'));

        var c_names =
            '{{ !isset($cw_sep_array) ? json_encode([]) : json_encode(!empty($cw_sep_array['category_names'])) }}';
        var t_amount_m2 =
            '{{ !isset($cw_sep_array) ? json_encode([]) : json_encode(!empty($cw_sep_array['total_amount_in_m'])) }}';
        var colors2 = '{{ !isset($cw_sep_array) ? json_encode([]) : json_encode(!empty($cw_sep_array['colors'])) }}';
        var labels2 = JSON.parse(c_names.replace(/&quot;/g, '"'));

        var backgroundColor2 = JSON.parse(colors2.replace(/&quot;/g, '"'));
        var data_tam2 = JSON.parse(t_amount_m2.replace(/&quot;/g, '"'));


        new Chart(document.getElementById("bar-chart-horizontal-2"), {
            type: "horizontalBar",
            data: {
                labels: labels2,
                datasets: [{
                    label: "Amount (M)",
                    backgroundColor: backgroundColor2,
                    data: data_tam2,
                }, ],
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    fontColor: "#b2b9bf",
                    text: "Categorywise Amount Disbursed",
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

        new Chart(document.getElementById("bar-chart-horizontal"), {
            type: "horizontalBar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Amount (M)",
                    backgroundColor: backgroundColor,
                    data: data_tam,
                }, ],
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    fontColor: "#b2b9bf",
                    text: "Districtwise Amount Disbursed",
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

        new Chart(document.getElementById("pie-chart"), {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    label: "Districtwise Loan Disbursment",
                    backgroundColor: backgroundColor,
                    data: data_nos,
                }, ],
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
                    text: "Ditstrictwise loan disbursment summary in numbers",
                },
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
        });
    </script>
@endpush
