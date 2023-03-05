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
                        <form wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
                            <div class="row">
                                <div class="row pt-1">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="control-label">Measure</label>
                                            <input disabled type="text" class="form-control"
                                                placeholder="Measure"
                                                value="{{ $measure->measure_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="control-label">Phase</label>
                                            <input disabled type="text" class="form-control"
                                                placeholder="Phase"
                                                value="{{ $phase->phase_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="control-label">Total Employees</label>
                                            <input type="number" name='total_employees' class="form-control"
                                                placeholder="Total Employees"
                                                value="{{ $cpm->total_employees }}"
                                                required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="control-label">Total Revenue</label>
                                            <input type="number" name='total_revenue' class="form-control"
                                                placeholder="Total Revenue"
                                                value="{{ $cpm->total_revenue }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="control-label">Total Profit</label>
                                            <input type="number" name='total_profit' class="form-control"
                                                placeholder="Total Profit"
                                                value="{{ $cpm->total_profit }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="control-label">Total Loan Amount Utilized</label>
                                            <input type="number" name='total_amount_utilized' class="form-control"
                                                value="{{ $cpm->total_amount_utilized }}"
                                                placeholder="Total Loan Amount Utilized"
                                                required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
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

                            </div>
                            <div class="d-block">
                                {{-- <button style="float: right;" type="submit" class="btn btn-success">Save changes</button> --}}
                                <button type="submit" wire:loading.attr="disabled">
                                    <span wire:loading wire:target="save">Saving...</span>
                                    <span wire:loading.remove>Save</span>
                                </button>
                            </div>
                        </form>
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
        window.addEventListener('showSuccessToast', event => {
            $('#successToast').toast("show");
            //window.location.href = "{{ url('company/dashboard') }}";
        })
    </script>
@endpush
