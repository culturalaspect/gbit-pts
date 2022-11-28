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
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="tb-fname"
                                            placeholder="Enter Company here" value="{{ $company->company_name }}">
                                        <label for="tb-fname">Company Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='ceo_name' type="text"
                                            class="form-control {{ $errors->has('ceo_name') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="CEO Name">
                                        <label for="tb-old-pwd">CEO Name</label>
                                    </div>
                                    @if ($errors->has('ceo_name'))
                                        <p style="color: red;">{{ $errors->first('ceo_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='address' type="text"
                                            class="form-control {{ $errors->has('address') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Address">
                                        <label for="tb-old-pwd">Address</label>
                                    </div>
                                    @if ($errors->has('address'))
                                        <p style="color: red;">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='cell_no' type="text"
                                            class="form-control {{ $errors->has('cell_no') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Cell No">
                                        <label for="tb-old-pwd">Cell No</label>
                                    </div>
                                    @if ($errors->has('cell_no'))
                                        <p style="color: red;">{{ $errors->first('cell_no') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='official_email' type="email"
                                            class="form-control {{ $errors->has('official_email') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Official Email">
                                        <label for="tb-old-pwd">Official Email</label>
                                    </div>
                                    @if ($errors->has('official_email'))
                                        <p style="color: red;">{{ $errors->first('official_email') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <select {{ $is_completed == 1 ? 'disabled' : '' }}
                                            class="form-control {{ $errors->has('category_id') ? 'border-danger' : '' }}"
                                            wire:model='category_id'
                                            id="tb-old-pwd">
                                            <option>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tb-old-pwd">Category</label>
                                    </div>
                                    @if ($errors->has('category_id'))
                                        <p style="color: red;">{{ $errors->first('category_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <select {{ $is_completed == 1 ? 'disabled' : '' }}
                                            class="form-control {{ $errors->has('district_id') ? 'border-danger' : '' }}"
                                            wire:model='district_id'
                                            id="tb-old-pwd">
                                            <option>Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tb-old-pwd">District</label>
                                    </div>
                                    @if ($errors->has('district_id'))
                                        <p style="color: red;">{{ $errors->first('district_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='online_profile_link' type="text"
                                            class="form-control {{ $errors->has('online_profile_link') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Online Profile Link">
                                        <label for="tb-old-pwd">Online Profile Link</label>
                                    </div>
                                    @if ($errors->has('online_profile_link'))
                                        <p style="color: red;">{{ $errors->first('online_profile_link') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='total_employees' type="number"
                                            class="form-control {{ $errors->has('total_employees') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Total Employees">
                                        <label for="tb-old-pwd">Total Employees</label>
                                    </div>
                                    @if ($errors->has('total_employees'))
                                        <p style="color: red;">{{ $errors->first('total_employees') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='total_revenue' type="number"
                                            class="form-control {{ $errors->has('total_revenue') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Total Revenue">
                                        <label for="tb-old-pwd">Total Revenue</label>
                                    </div>
                                    @if ($errors->has('total_revenue'))
                                        <p style="color: red;">{{ $errors->first('total_revenue') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input {{ $is_completed == 1 ? 'disabled' : '' }} wire:model='total_profit' type="number"
                                            class="form-control {{ $errors->has('total_profit') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Total Profit">
                                        <label for="tb-old-pwd">Total Profit</label>
                                    </div>
                                    @if ($errors->has('total_profit'))
                                        <p style="color: red;">{{ $errors->first('total_profit') }}</p>
                                    @endif
                                </div>
                                @if(!$is_completed)
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
        window.addEventListener('showSuccessToast', event => {
            $('#successToast').toast("show");
        })
    </script>
@endpush
