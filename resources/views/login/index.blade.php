@extends('layouts.main', ['hideNavbar' => true])

@section('title', 'Login Page')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-4 login-container">
        <main class="form-container w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>

            <!-- Menampilkan pesan error jika ada -->
            @if (session('loginError'))
                <div class="alert alert-danger">
                    {{ session('loginError') }}
                </div>
            @endif

            <form action="/login" method="POST" autocomplete="off" novalidate>
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email address" value="{{ old('email') }}" autofocus required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="new-password">
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>
            </form>
            
            
            <small class="text-center d-block mt-3">Not registered? <a href="/register">Register Now!</a></small>
        </main>
    </div>
</div>
@endsection
