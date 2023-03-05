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
                        <livewire:company-performance-measure-table />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ------------------------------MODALS / TOASTS --------------------------------------- --}}

    <div wire:ignore.self class="modal fade" id="modalQuestionsForm" tabindex="-1" aria-labelledby="modalFormLabel"
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
                <form wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
                    <div class="modal-body">
                        @if ($pmquestions)
                            <input type="hidden" name="cpm_id" value="{{ $cpm_id }}">
                            <?php $i = 0; ?>
                            @foreach ($pmquestions as $question)
                                <input type="hidden" name="question_id[{{ $i }}]"
                                    value="{{ $question->id }}">
                                <div class="row pt-1">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="d-block">{{ $question->question }}</label>
                                            @if ($question->question_type == 1)
                                                <?php $val = App\Models\CpmQuestionAnswer::where('cpm_id', $cpm_id)->where('pm_question_id', $question->id)->first('pm_answer'); ?>
                                                <input type="hidden" name="field_type[{{ $i }}]"
                                                    value="1">
                                                <select {{ $question->is_required == 1 ? 'required' : '' }}
                                                    name="answeres[{{ $i }}][answer_text]"
                                                    class="form-control custom-select select2">
                                                    <option value="">Select Options</option>
                                                    @foreach ($question->pmquestionoptions as $option)
                                                        @if(is_null($val))
                                                            <option value="{{ $option->option_text }}">
                                                                {{ $option->option_text }}</option>
                                                        @else
                                                            @if($val->pm_answer == $option->option_text)
                                                                <option selected value="{{ $option->option_text }}">
                                                                    {{ $option->option_text }}</option>
                                                            @else
                                                                <option value="{{ $option->option_text }}">
                                                                    {{ $option->option_text }}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @elseif($question->question_type == 2)
                                                <input type="hidden" name="field_type[{{ $i }}]"
                                                    value="2">
                                                <?php $j = 0; ?>
                                                @foreach ($question->pmquestionoptions as $option)
                                                    <?php $val = App\Models\CpmQuestionAnswer::where('cpm_id', $cpm_id)->where('pm_question_id', $question->id)->where('pm_answer', $option->option_text)->first('pm_answer'); ?>
                                                    <div class="form-check form-check-inline options">
                                                        <input
                                                            @if(!is_null($val))
                                                                {{ $val->pm_answer == $option->option_text ? 'checked' : '' }}
                                                            @endif
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="inlineCheckbox{{ trim($option->option_text) }}"
                                                            name="answeres[{{ $i }}][answer_text][{{ $j }}][option]"
                                                            value="{{ $option->option_text }}"
                                                            {{ $question->is_required == 1 ? 'required' : '' }}>
                                                        <label class="form-check-label"
                                                            for="inlineCheckbox{{ trim($option->option_text) }}">{{ $option->option_text }}</label>
                                                    </div>
                                                    <?php $j++; ?>
                                                @endforeach
                                            @else
                                                <?php $val = App\Models\CpmQuestionAnswer::where('cpm_id', $cpm_id)->where('pm_question_id', $question->id)->first('pm_answer'); ?>
                                                <input type="hidden" name="field_type[{{ $i }}]"
                                                    value="0">
                                                <input type="text"
                                                    value="{{ is_null($val) ? '' : $val->pm_answer }}"
                                                    class="form-control"
                                                    name="answeres[{{ $i }}][answer_text]"
                                                    placeholder="{{ $question->question }}"
                                                    {{ $question->is_required == 1 ? 'required' : '' }}>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-success">Save changes</button> --}}
                        <button type="submit" wire:loading.attr="disabled">
                            <span wire:loading wire:target="save">Saving...</span>
                            <span wire:loading.remove>Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <div class="row pt-1">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Companies</label>
                                <select wire:model="company_id" onchange="Livewire.emit('updatedSelectedPhase')"
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Phase</label>
                                <select wire:model="phase_id" class="form-control custom-select select2">
                                    <option>Select Phase</option>
                                    @if ($phases)
                                        @foreach ($phases as $phase)
                                            <option value="{{ $phase->id }}">{{ $phase->phase_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('phase_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('phase_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row pt-1">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">Performance Measure</label>
                                <select wire:model='measure_id' class="form-control custom-select">
                                    <option value="" selected>Select a Performance Measure</option>
                                    @foreach ($measures as $measure)
                                        <option value="{{ $measure->id }}">{{ $measure->measure_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('measure_id'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('measure_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Total Employees</label>
                                <input type="number" wire:model='total_employees' class="form-control"
                                    placeholder="Total Employees">
                                @if ($errors->has('total_employees'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_employees') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Total Revenue</label>
                                <input type="number" wire:model='total_revenue' class="form-control"
                                    placeholder="Total Revenue">
                                @if ($errors->has('total_revenue'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_revenue') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="control-label">Total Profit</label>
                                <input type="number" wire:model='total_profit' class="form-control"
                                    placeholder="Total Profit">
                                @if ($errors->has('total_profit'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_profit') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Total Loan Amount Utilized</label>
                                <input type="number" wire:model='total_amount_utilized' class="form-control"
                                    placeholder="Total Loan Amount Utilized">
                                @if ($errors->has('total_amount_utilized'))
                                    <p class="form-control-feedback text-danger">
                                        {{ $errors->first('total_amount_utilized') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label">Is Completed</label>
                                <select wire:model='is_completed' class="form-control custom-select">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="save()" class="btn btn-success">Save changes</button>
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

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>

        jQuery("#datepicker-autoclose-date_of_payment").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        window.addEventListener('showModal', event => {
            $("#modalForm").modal('show');
        })

        window.addEventListener('showQuestionsModal', event => {
            $("#modalQuestionsForm").modal('show');
        })

        window.addEventListener('hideQuestionsModal', event => {
            $('#form-success-msg').removeClass('hide').addClass('show');

            setTimeout(function() {
                $('#form-success-msg').removeClass('show').addClass('hide');
                $("#modalQuestionsForm").modal('hide');
            }, 1500);

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
