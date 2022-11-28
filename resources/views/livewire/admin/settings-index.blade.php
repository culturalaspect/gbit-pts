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
                                            placeholder="Enter Name here" value="{{ auth()->user()->user_name }}">
                                        <label for="tb-fname">User Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input disabled type="email" class="form-control" id="tb-email"
                                            placeholder="name@example.com" value="{{ auth()->user()->email }}">
                                        <label for="tb-email">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input wire:model='old_password' type="password"
                                            class="form-control {{ $errors->has('old_password') ? 'border-danger' : '' }}"
                                            id="tb-old-pwd" placeholder="Old Password">
                                        <label for="tb-old-pwd">Old Password</label>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <p style="color: red;">{{ $errors->first('old_password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input wire:model='password' type="password"
                                            class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}"
                                            id="tb-pwd" placeholder="New Password">
                                        <label for="tb-pwd">New Password</label>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p style="color: red;">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input wire:model='confirm_password' type="password"
                                            class="form-control {{ $errors->has('confirm_password') ? 'border-danger' : '' }}"
                                            id="tb-cpwd" placeholder="Password">
                                        <label for="tb-cpwd">Confirm Password</label>
                                    </div>
                                    @if ($errors->has('confirm_password'))
                                        <p style="color: red;">{{ $errors->first('confirm_password') }}</p>
                                    @endif
                                </div>
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
