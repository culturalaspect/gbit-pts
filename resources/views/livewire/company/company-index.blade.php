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
                                <h3 class="mb-0">PKR {{ $top_cards_data['total_sanctioned']->total_sanctioned_amount }} M
                                </h3>
                                <h6 class="text-muted mb-0">Total Loan</h6>
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
                                    {{ $top_cards_data['total_returned']->total_returned }} M</h3>
                                <h6 class="text-muted mb-0">Total Returned</h6>
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
                            class="feather feather-grid feather-lg fill-white">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                            </div>
                            <div class="ms-2 align-self-center">
                                <h3 class="mb-0">
                                    {{ $top_cards_data['total_sanctioned']->total_installments }}
                                </h3>
                                <h6 class="text-muted mb-0">Total Installments</h6>
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
                                <h3 class="mb-0">{{ $top_cards_data['total_returned']->total_installments_paid }}</h3>
                                <h6 class="text-muted mb-0">Installments Paid</h6>
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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Disbursed Amount</h4>
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
                                                href="{{ url('company/companyprogress/' . $company->id . '/' . $company->phase_id) }}">{{ $company->company_name }}</a>
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

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Perfromace Measures</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="">
                                    <tr>
                                        <th class="p-1">Measure</th>
                                        <th class="p-1">Phase</th>
                                        <th class="p-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cpms as $cpm)
                                        <tr>
                                            <td class="p-1">{{ $cpm->measure->measure_name }}</td>
                                            <td class="p-1">{{ $cpm->phase->phase_name }}</td>
                                            <td class="p-1">
                                                <a href="{{ url('company/performancemeasure/'.$cpm->measure_id.'/'.$cpm->phase_id) }}" class="btn btn-xs btn-warning">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Company Financial Information</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Phase</th>
                                        <th scope="col">Loan Amount</th>
                                        <th scope="col">Markup %</th>
                                        <th scope="col">Total Amount With Markup</th>
                                        <th scope="col">Total Recovered</th>
                                        <th scope="col">Total Balance</th>
                                        <th scope="col">Total Installments</th>
                                        <th scope="col">Installments Paid</th>
                                        <th scope="col">Installments Remaining</th>
                                        <th scope="col">Installments Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($company_financials as $financial)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $financial->company_name }}</td>
                                            <td>{{ $financial->phase_name }}</td>
                                            <td>{{ round($financial->total_sanctioned_amount, 2) }}</td>
                                            <td>{{ round($financial->installment_markup_percentage, 2) }}</td>
                                            <td>{{ round($financial->total_amount_with_markup, 2) }}</td>
                                            <td>{{ round($financial->total_recovered_amount, 2) }}</td>
                                            <td>{{ round($financial->total_difference_amount, 2) }}</td>
                                            <td>{{ $financial->total_installments }}</td>
                                            <td>{{ $financial->total_paid_installments }}</td>
                                            <td>{{ $financial->total_remaining_installments }}</td>
                                            <td>{{ round($financial->installment_amount, 2) }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script type="text/javascript"></script>
@endpush
