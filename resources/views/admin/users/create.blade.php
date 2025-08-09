{{-- resources/views/admin/users/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="row">
  <div class="col-xl-7 mx-auto mt-4">
    <div class="card border-top border-4 border-white shadow-sm mb-4">
      <div class="card-body p-5">
        <div class="card-title d-flex align-items-center mb-4">
          <i class="bx bxs-user me-2 fs-3 text-primary"></i>
          <h5 class="mb-0">User Registration</h5>
        </div>

        {{-- Validation summary (optional) --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="row g-3" method="POST" action="{{ route('admin.users.store') }}">
          @csrf

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text"
                     name="first_name"
                     class="form-control @error('first_name') is-invalid @enderror"
                     id="inputFirstName"
                     placeholder=" "
                     value="{{ old('first_name') }}"
                     required>
              <label for="inputFirstName">First Name</label>
              @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text"
                     name="last_name"
                     class="form-control @error('last_name') is-invalid @enderror"
                     id="inputLastName"
                     placeholder=" "
                     value="{{ old('last_name') }}"
                     required>
              <label for="inputLastName">Last Name</label>
              @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="email"
                     name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="inputEmail"
                     placeholder=" "
                     value="{{ old('email') }}"
                     required>
              <label for="inputEmail">Email address</label>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="password"
                     name="password"
                     class="form-control @error('password') is-invalid @enderror"
                     id="inputPassword"
                     placeholder=" "
                     required>
              <label for="inputPassword">Password</label>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="password"
                     name="password_confirmation"
                     class="form-control"
                     id="inputPasswordConfirm"
                     placeholder=" "
                     required>
              <label for="inputPasswordConfirm">Confirm Password</label>
            </div>
          </div>

          <div class="col-12">
            <div class="form-floating">
              <textarea name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        id="inputAddress"
                        placeholder=" "
                        style="height: 100px">{{ old('address') }}</textarea>
              <label for="inputAddress">Address</label>
              @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- 🔐 Role (Spatie) --}}
          <div class="col-md-6">
            <div class="form-floating">
              <select name="role_id"
                      id="inputRole"
                      class="form-select @error('role_id') is-invalid @enderror"
                      required>
                <option value="" disabled {{ old('role_id') ? '' : 'selected' }}>Select role</option>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option>
                @endforeach
              </select>
              <label for="inputRole">Role</label>
              @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-12">
            <button class="btn btn-primary px-5" type="submit">Register</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light ms-2">Cancel</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
