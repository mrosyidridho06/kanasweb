@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row">
            <!-- Name -->
            <div class="col-md-6">
                <label class="form-control-label" >Nama</label>
                <input class="form-control @error('name') is-invalid @enderror " type="text" name="name" value="{{ old('name') }}" required autofocus />
                @error('name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Username -->
            <div class="col-md-6">
                <label class="form-control-label">Username</label>
                <input id="username" class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username')  }}" required autofocus />
                @error('username')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="col-md-6 mt-4">
                <label class="form-control-label">Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required />
                @error('email')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="col-md-6 mt-4">
                <label class="form-control-label">Role</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="" selected="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Pemilik</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pegawai</option>
                    <option value="hr" {{ old('role') == 'hr' ? 'selected' : '' }}>HR</option>
                </select>
                @error('role')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="col-md-6 mt-4">
                <label class="form-control-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6 mt-4">
                <label class="form-control-label">Confirm Password</label>

                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password"
                                name="password_confirmation" required />
                @error('password_confirmation')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-12 mt-4">
                <button class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
