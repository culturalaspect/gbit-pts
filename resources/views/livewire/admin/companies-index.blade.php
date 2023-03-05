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
                        <livewire:company-table />
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Company Name</label>
                                <input type="text" wire:model.lazy='company_name'
                                    class="form-control"
                                    placeholder="Company Name">
                                @if ($errors->has('company_name'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('company_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">CEO Name</label>
                                <input type="text" wire:model.lazy='ceo_name'
                                    class="form-control"
                                    placeholder="CEO Name">
                                @if ($errors->has('ceo_name'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('ceo_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Cell Number</label>
                                <input type="text" wire:model.lazy='cell_no'
                                    class="form-control"
                                    placeholder="Cell No">
                                @if ($errors->has('cell_no'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('cell_no') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Official Email</label>
                                <input type="text" wire:model.lazy='official_email'
                                    class="form-control"
                                    placeholder="Official Email">
                                @if ($errors->has('official_email'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('official_email') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Address</label>
                                <input type="text" wire:model.lazy='address'
                                    class="form-control"
                                    placeholder="Address">
                                @if ($errors->has('address'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('address') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Online Profile Link</label>
                                <input type="text" wire:model.lazy='online_profile_link'
                                    class="form-control"
                                    placeholder="Online Profile Link">
                                @if ($errors->has('online_profile_link'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('online_profile_link') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Current Assets</label>
                                <textarea type="text" wire:model.lazy='current_assets'
                                    class="form-control"
                                    placeholder="Current Assets">Current Assets</textarea>
                                @if ($errors->has('current_assets'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('current_assets') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Business / Startup Stage</label>
                                <select wire:model.lazy='startup_stage' class="form-control custom-select">
                                    <option>Select Business / Startup Stage</option>
                                    <option value="Ideation Level">Ideation Level</option>
                                    <option value="Early Age Level">Early Age Level</option>
                                    <option value="Established Level">Established Level</option>
                                    <option value="Expansion Level">Expansion Level</option>
                                    <option value="N/A">N/A</option>
                                </select>
                                @if ($errors->has('startup_stage'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('startup_stage') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Categories</label>
                                <select wire:model.lazy='category_id' class="form-control custom-select">
                                    <option selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('category_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Districts</label>
                                <select wire:model.lazy='district_id' class="form-control custom-select">
                                    <option selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('district_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('district_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Total Employees</label>
                                <input type="text" wire:model.lazy='total_employees'
                                    class="form-control"
                                    placeholder="Total Employees">
                                @if ($errors->has('total_employees'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_employees') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Total Revenue</label>
                                <input type="number" wire:model.lazy='total_revenue'
                                    class="form-control"
                                    placeholder="Total Revenue">
                                @if ($errors->has('total_revenue'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_revenue') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Total Profit</label>
                                <input type="number" wire:model.lazy='total_profit'
                                    class="form-control"
                                    placeholder="Total Profit">
                                @if ($errors->has('total_profit'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_profit') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Is Completed</label>
                                <select wire:model.lazy='is_completed' class="form-control custom-select">
                                    <option selected>Is Completed</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @if ($errors->has('is_completed'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('is_completed') }}
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

        window.addEventListener('showErrorToast', event => {
            $('#errorToast').toast("show");
        })

        window.addEventListener('showSuccessToast', event => {
            $('#successToast').toast("show");
        })
    </script>
@endpush
