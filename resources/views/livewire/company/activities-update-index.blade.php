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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">

                    <div class="card-header row">
                        <div class="col-lg-12">
                            <h3 class="card-title custom-card-title">{{ $activity->activity_title }}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    @if(!$is_deadline_set)
                                        <div class="form-floating">
                                            <textarea wire:model.lazy='methodology' type="text"
                                                class="form-control {{ $errors->has('methodology') ? 'border-danger' : '' }}"
                                                id="tb-old-pwd" placeholder="Methodology"
                                                style="height:100px;">{{ $methodology }}</textarea>
                                            <label for="tb-old-pwd">Methodology</label>
                                        </div>
                                        @if ($errors->has('methodology'))
                                            <p style="color: red;">{{ $errors->first('methodology') }}</p>
                                        @endif
                                    @else
                                        <label for="tb-old-pwd">Methodology</label>
                                        <p style="padding:5px;">{{ $methodology }}</p>
                                    @endif
                                </div>
                                @if(!$is_deadline_set)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" wire:model.lazy="start_date" class="form-control {{ $errors->has('start_date') ? 'border-danger' : '' }} datepicker"
                                                id="datepicker-autoclose-start_date" placeholder="yyyy-mm-dd"
                                                onchange="Livewire.emit('setStartDate', this.value)"
                                                placeholder="Start Date"
                                                readonly
                                                value="{{ $start_date }}">
                                            <label for="tb-old-pwd">Start Date</label>
                                        </div>
                                        @if ($errors->has('start_date'))
                                            <p style="color: red;">{{ $errors->first('start_date') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" wire:model.lazy="end_date" class="form-control {{ $errors->has('end_date') ? 'border-danger' : '' }} datepicker"
                                                id="datepicker-autoclose-end_date" placeholder="yyyy-mm-dd"
                                                onchange="Livewire.emit('setEndDate', this.value)"
                                                placeholder="End Date"
                                                readonly
                                                value="{{ $end_date }}">
                                            <label for="tb-old-pwd">End Date</label>
                                        </div>
                                        @if ($errors->has('end_date'))
                                            <p style="color: red;">{{ $errors->first('end_date') }}</p>
                                        @endif
                                    </div>
                                @else
                                    <div style="padding-left:25px; padding-right:25px;">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p class="text-center" style="margin:0px;"><label>Start Date</label></p>
                                                <p style="font-size:14px;" class="badge bg-success">{{ date('d F, Y', strtotime($start_date)) }}</p>
                                            </div>
                                            <div class="col-lg-8"></div>
                                            <div class="col-lg-2">
                                                <p class="text-center" style="margin:0px;"><label>End Date</label></p>
                                                <p style="font-size:14px;" class="badge bg-danger">{{ date('d F, Y', strtotime($end_date)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($activity->status == 0)
                                    @if(!$is_deadline_over)
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                                <select
                                                    class="form-control {{ $errors->has('status') ? 'border-danger' : '' }}"
                                                    wire:model.lazy='status'
                                                    id="tb-old-pwd">
                                                    <option value="">Select Status</option>
                                                    <option value="0">In Progress</option>
                                                    <option value="1">Completed</option>
                                                    <option value="2">N/A</option>
                                                </select>
                                                <label for="tb-old-pwd">Select Status</label>
                                            </div>
                                            @if ($errors->has('status'))
                                                <p style="color: red;">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                @if($is_deadline_over || $activity->status != 0)
                                    <div class="mt-2">
                                        <label>Status</label>
                                        <div class="mb-3">
                                            @if($activity->status ==0)
                                                <span class="badge bg-primary">In Progress</span>
                                            @elseif($activity->status == 1)
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12 mb-3">
                                    @if($activity->status == 0)
                                        @if(!$is_deadline_over)
                                            <div class="form-floating">
                                                <input {{ $is_deadline_over ? 'disabled' : '' }} style="height:60px;padding-bottom:35px;padding-top:35px;padding-left:20px;" type="file"
                                                    class="form-control {{ $errors->has('deliverable') ? 'border-danger' : '' }}"
                                                    wire:model.lazy="deliverable"
                                                    id="tb-old-pwd" placeholder="Deliverable"/>
                                                <label for="tb-old-pwd">Deliverable</label>
                                            </div>
                                            @if ($errors->has('deliverable'))
                                                <p style="color: red;">{{ $errors->first('deliverable') }}</p>
                                            @endif
                                        @endif
                                    @endif
                                    @if($activity->deliverable)
                                        <div class="mt-2">
                                            <label>Deliverable</label>
                                            <p style="margin-top: 10px;margin-bottom: 10px;margin-left: 20px;">
                                                <a download class="" href="{{ url('uploads/deliverables/'.$activity->deliverable) }}">Download Deliverable</a>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    @if($activity->status == 0)
                                        @if(!$is_deadline_over)
                                            <div class="form-floating">
                                                <textarea {{ $is_deadline_over ? 'disabled' : '' }} wire:model.lazy='result' type="text"
                                                    class="form-control {{ $errors->has('result') ? 'border-danger' : '' }}"
                                                    id="tb-old-pwd" placeholder="Result"
                                                    style="height: 100px;">{{ $result }}</textarea>
                                                <label for="tb-old-pwd">Result</label>
                                            </div>
                                            @if ($errors->has('result'))
                                                <p style="color: red;">{{ $errors->first('result') }}</p>
                                            @endif
                                        @endif
                                    @endif
                                    @if($is_deadline_over || $activity->status != 0)
                                        <div class="mt-2">
                                            <label for="tb-old-pwd">Methodology</label>
                                            <p style="padding:5px;">{{ $result }}</p>
                                        </div>
                                    @endif
                                </div>
                                @if($activity->status == 0)
                                    @if(!$is_deadline_over)
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">
                                                <div class="ms-auto mt-3 mt-md-0">
                                                    <button wire:click.prevent="save()" type="submit"
                                                        class="
                                                            btn btn-success
                                                            font-weight-medium
                                                            rounded-pill
                                                            px-4
                                                        ">
                                                        <div class="d-flex align-items-center">
                                                            Submit
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 border-0" style="z-index: 9999">
        <div id="successToast" class="toast hide" data-bs-autohide="true" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Attention!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-success text-white">
                Operation Performed Successfully.
            </div>
        </div>
    </div>

</div>
{{-- End of Content Container --}}

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        jQuery("#datepicker-autoclose-start_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        jQuery("#datepicker-autoclose-end_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        window.addEventListener('showSuccessToast', event => {
            $('#successToast').toast("show");
        })
    </script>
@endpush
