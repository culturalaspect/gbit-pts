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
                        <livewire:phase-table />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ------------------------------MODALS / TOASTS --------------------------------------- --}}

    <div wire:ignore.self class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel"
        aria-hidden="true">
        <div class="modal-dialog">
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
                    <div class="form-group">
                        <label>Phase Name</label><br />
                        <input type="text" wire:model.lazy="phase_name" class="form-control" />
                        @if ($errors->has('phase_name'))
                            <p style="color: red;">{{ $errors->first('phase_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Scheme Name</label><br />
                        <select class="form-select" wire:model.lazy="scheme_id">
                            <option selected>Select Scheme</option>
                            @foreach ($schemes as $scheme)
                                <option value="{{ $scheme->id }}">{{ $scheme->scheme_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('scheme_id'))
                            <p style="color: red;">{{ $errors->first('scheme_id') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Date From</label><br />
                        <input type="text" wire:model.lazy="date_from" class="form-control datepicker" id="datepicker-autoclose-date_from" placeholder="yyyy-mm-dd"
                            onchange="Livewire.emit('setDateFrom', this.value)" readonly>
                        @if ($errors->has('date_from'))
                            <p style="color: red;">{{ $errors->first('date_from') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Date To</label><br />
                        <input type="text" wire:model.lazy="date_to" class="form-control datepicker" id="datepicker-autoclose-date_to" placeholder="yyyy-mm-dd"
                            onchange="Livewire.emit('setDateTo', this.value)" readonly>
                        @if ($errors->has('date_to'))
                            <p style="color: red;">{{ $errors->first('date_to') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label class="control-label">Is Active</label>
                            <select wire:model.lazy='is_active' class="form-control custom-select">
                                <option selected>Is Active</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @if ($errors->has('is_active'))
                                <p class="form-control-feedback text-danger">
                                    {{ $errors->first('is_active') }}
                                </p>
                            @endif
                        </div>
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
        <div id="errorToast" class="toast hide" data-bs-autohide="true" role="alert" aria-live="assertive" aria-atomic="true">
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
        <div id="successToast" class="toast hide" data-bs-autohide="true" role="alert" aria-live="assertive" aria-atomic="true">
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
        jQuery("#datepicker-autoclose-date_from").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        jQuery("#datepicker-autoclose-date_to").datepicker({
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

        window.addEventListener('showErrorToast', event=>{
            $('#errorToast').toast("show");
        })

        window.addEventListener('showSuccessToast', event=>{
            $('#successToast').toast("show");
        })
    </script>
@endpush
