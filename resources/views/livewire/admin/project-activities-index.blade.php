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
                            <h3 class="card-title custom-card-title">{{ $card_title }}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <livewire:project-activity-table />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ------------------------------MODALS / TOASTS --------------------------------------- --}}

    <div wire:ignore.self class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Please fill in the form shown below.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form-success-msg" style="margin-left:10px;margin-right:10px;"
                    class="alert alert-success fade hide" role="alert">
                    <strong>Success!</strong> Record Updated Successfully.
                </div>
                <div class="modal-body">
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Projects</label>
                                <select wire:model="project_id"
                                    class="form-control custom-select select2">
                                    <option>Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_title }} ({{ $project->company->company_name }})</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('project_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Activity Title</label>
                                <input type="text" wire:model='activity_title'
                                    class="form-control"
                                    placeholder="Activity Title">
                                @if ($errors->has('activity_title'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('activity_title') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Methodology</label>
                                <textarea class="form-control" placeholder="Methodology"
                                    wire:model='methodology'
                                    rows="3"></textarea>
                                @if ($errors->has('methodology'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('methodology') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Start Date</label><br />
                                    <input type="text" wire:model="start_date" class="form-control datepicker"
                                        id="datepicker-autoclose-start_date" placeholder="yyyy-mm-dd"
                                        onchange="Livewire.emit('setStartDate', this.value)" readonly>
                                    @if ($errors->has('start_date'))
                                        <p style="color: red;">{{ $errors->first('start_date') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>End Date</label><br />
                                    <input type="text" wire:model="end_date" class="form-control datepicker"
                                        id="datepicker-autoclose-end_date" placeholder="yyyy-mm-dd"
                                        onchange="Livewire.emit('setEndDate', this.value)" readonly>
                                    @if ($errors->has('end_date'))
                                        <p style="color: red;">{{ $errors->first('end_date') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Status</label>
                                    <select wire:model='status' class="form-control custom-select">
                                        <option selected>Status</option>
                                        <option value="0">In Progress</option>
                                        <option value="1">Completed</option>
                                        <option value="2">N/A</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <p class="form-control-feedback text-danger">
                                            {{ $errors->first('status') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="control-label">Deliverable</label>
                                    <input type="file" class="form-control" wire:model="deliverable" />
                                    @if ($errors->has('deliverable'))
                                        <p class="form-control-feedback text-danger">
                                            {{ $errors->first('deliverable') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Result</label>
                                <textarea class="form-control"
                                    placeholder="Result"
                                    wire:model='result'
                                    rows="3"></textarea>
                                @if ($errors->has('result'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('result') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Is Deadline Set</label>
                                <select wire:model='is_deadline_set' class="form-control custom-select">
                                    <option selected>Is Deadline Set</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @if ($errors->has('is_deadline_set'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('is_deadline_set') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" wire:click.prevent="save()" class="btn btn-success">Save changes</button> --}}
                    <button wire:loading.attr="disabled"  class="btn btn-success"
                        wire:click.prevent="save()">
                        <span wire:loading wire:target="save">Saving...</span>
                        <span wire:loading.remove>Save</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFormDelete" tabindex="-1" aria-labelledby="modalFormDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormDeleteLabel">Please Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Do you wish to continue?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="delete" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="position-fixed top-0 end-0 border-0" style="z-index: 9999">
        <div id="errorToast" class="toast hide" data-bs-autohide="true" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Attention!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-danger text-white">
                {{ $deleteErrorMessage }}
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

        window.addEventListener('showModal', event => {
            $("#modalForm").modal('show');
        })

        window.addEventListener('showDeleteModal', event => {
            $("#modalFormDelete").modal('show');
        })

        window.addEventListener('hideDeleteModal', event => {
            $("#modalFormDelete").modal('hide');
        })

        window.addEventListener('hideModal', event => {
            $('#form-success-msg').removeClass('hide').addClass('show');

            setTimeout(function() {
                $('#form-success-msg').removeClass('show').addClass('hide');
                $("#modalForm").modal('hide');
            }, 1500);


        })

        window.addEventListener('showErrorToast', event => {
            $('#errorToast').toast("show");
        })

        window.addEventListener('showSuccessToast', event => {
            $('#successToast').toast("show");
        })
    </script>
@endpush
