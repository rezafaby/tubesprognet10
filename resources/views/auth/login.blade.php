@extends('layouts.master')
@section('tittle', 'Login')

@push('css')
    <style>
        #splash{
            object-fit: cover;
            height: 577px;
            opacity: 0.8;
            filter: blur(1px);
        }

        @media screen and (max-width: 500px) {
                #splash {
                    display:none !important;
            }
        }
    </style>

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">

@endpush

@section('content')
    <div class="container">
        <div class="row p-lg-5 m-2 justify-content-center">
                {{-- <div id="screen1" class="col-12 col-sm-6 p-0" >
                    <div class="card card-primary m-0">
                        <img id="splash" class="rounded" src="{{asset('base-template/dist/img/6263.jpg')}}" alt="Product Image">
                    </div>
                </div> --}}
                <div class="col-12 col-sm-6 p-0">
                    <div class="card card-primary mb-0">
                        <div class="card-header bg-white text-center">
                            <img class="rounded mx-auto d-block my-3" src="{{ asset('base-template/dist/img/7475869-01.png') }}" alt="peminjaman buku logo" width="80" height="80">
                            <p class="login-box-msg mb-0 pb-0 px-0 fw-bold h6 mt-2 mb-1"> Selamat Datang di Sistem</p>
                            <a href="" class="text-decoration-none h4 fw-bold m-2">Ikatan Kerja Sama</a>
                        </div>
                        <div class="card-body">
                            <p class="text-center pb-2 fs-6">Silakan Login untuk masuk ke sistem</p>
                            <form  class="p-3" action="{{route('auth.login.post')}}" method="POST" id="form">
                                @csrf
                                <div class="input-group mb-3">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('email') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('password') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-outline-primary btn-block float-lg-right mb-4 mt-2">Masuk</button>
                            </form>
                        </div>
                        <div class="text-center mt-4 my-3">
                            <a class="nav-link link-dark">Sistem Ikatan Kerja Sama 2023 &copy</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('js')

    <script src="{{asset('base-template\dist\js\sweetalert2.all.min.js')}}"></script>

    <script>
        @if(Session::has('status'))
            Swal.fire({
                icon:  @if(Session::has('icon')){!! '"'.Session::get('icon').'"' !!} @else 'question' @endif,
                title: @if(Session::has('title')){!! '"'.Session::get('title').'"' !!} @else 'Oppss...'@endif,
                text: @if(Session::has('message')){!! '"'.Session::get('message').'"' !!} @else 'Oppss...'@endif,
            });
        @endif
    </script>


@endpush
