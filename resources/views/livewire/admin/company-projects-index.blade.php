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
                        <livewire:company-project-table />
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Companies</label>
                                <select wire:model="company_id"
                                    class="form-control custom-select select2">
                                    <option>Select Company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('company_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Domains</label>
                                <select wire:model="domain_id"
                                    onchange="Livewire.emit('changeOtherDomain')"
                                    class="form-control custom-select select2">
                                    <option>Select Domain</option>
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}">{{ $domain->domain_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('domain_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('domain_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Domain (if other)</label>
                                <input {{ $is_disabled_other ? 'disabled' : '' }} type="text" wire:model='other_domain'
                                    class="form-control"
                                    placeholder="Domain (if other)">
                                @if ($errors->has('other_domain'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('other_domain') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Project Title</label>
                                <input type="text" wire:model='project_title'
                                    class="form-control"
                                    placeholder="Project Title">
                                @if ($errors->has('project_title'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('project_title') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Problem Statement</label>
                                <textarea class="form-control" placeholder="Problem Statement"
                                    wire:model='problem_statement'
                                    rows="3"></textarea>
                                @if ($errors->has('problem_statement'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('problem_statement') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Summary of Solution</label>
                                <textarea class="form-control"
                                    placeholder="Summary of Solution"
                                    wire:model='summary_of_solution'
                                    rows="3"></textarea>
                                @if ($errors->has('summary_of_solution'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('summary_of_solution') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Expected Results</label>
                                <textarea class="form-control"
                                    placeholder="Expected Results"
                                    wire:model='expected_results'
                                    rows="3"></textarea>
                                @if ($errors->has('expected_results'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('expected_results') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Organizational Expertise</label>
                                <textarea class="form-control"
                                    placeholder="Organizational Expertise"
                                    wire:model='organizational_expertise'
                                    rows="3"></textarea>
                                @if ($errors->has('organizational_expertise'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('organizational_expertise') }}
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
