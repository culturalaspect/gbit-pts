@extends('layouts.mid')


@section('content')
<div class="row mt-2">
    <div class="col-lg-4 col-md-3 col-sm-2"></div>
    <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="card">
            @if ($errors->has('message'))
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>
                <div class="alert alert-danger d-flex mb-0 mt-0" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Error! </strong>{{ $errors->first('message') }}
                    </div>
                </div>
            @endif

            <div class="card-body">
                <h4 class="card-title text-center mb-0 mt-0">IT Department GB</h4>
                <h6 class="text-center mb-0 mt-0">Performance Monitoring Information System</h6>
                <h5 class="card-subtitle mt-3 mb-1 pb-3 border-bottom">
                    Sign in to start your session
                </h5>
                <form id="quickForm" action="{{ route('users.signin') }}" method="post" class="">
                    {{ csrf_field() }}
                    {{-- <div class="form-floating mb-3">
                        <input type="text" class="form-control border border-success"
                            placeholder="Username">
                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user feather-sm text-success fill-white me-2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg><span class="border-start border-success ps-3">Username</span></label>
                    </div> --}}
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control border border-success"
                            placeholder="Email" name="email"
                            value="{{ Request::old('email') }}"
                            required>
                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-mail feather-sm text-success fill-white me-2">
                                <path
                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg><span class="border-start border-success ps-3">Email address</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control border border-success"
                            placeholder="Password" name="password" required minlength="8">
                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-lock feather-sm text-success fill-white me-2">
                                <rect x="3" y="11" width="18" height="11"
                                    rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg><span class="border-start border-success ps-3">Password</span></label>
                    </div>
                    {{-- <div class="form-floating mb-3">
                        <input type="password" class="form-control border border-success"
                            placeholder="CPassword">
                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-lock feather-sm text-success fill-white me-2">
                                <rect x="3" y="11" width="18" height="11"
                                    rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg><span class="border-start border-success ps-3">Confirm
                                Password</span></label>
                    </div> --}}

                    <div class="d-md-flex align-items-center">
                        <div class="form-check mr-sm-2">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="mt-3 mt-md-0 ms-auto">
                            <button type="submit"
                                class="
                        btn btn-success
                        font-weight-medium
                        rounded-pill
                        px-4
                    ">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-send feather-sm fill-white me-2">
                                        <line x1="22" y1="2" x2="11" y2="13">
                                        </line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>
                                    Submit
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-2"></div>
</div>
@stop


