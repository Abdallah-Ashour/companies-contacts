
@extends('layouts.main')
@section('Contact App | Profile Information')

@section('content')

<main class="py-5">
    <div class="container">
      <div class="row">
        @include('settings._sidenav')

        <div class="col-md-9">
          <div class="card">
            <div class="card-header card-title">
              <strong>Edit Profile</strong>
            </div>

            <form method="POST" action="{{route('user-profile-information.update')}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                        @if ($message =session('status'))
                    <div class="alert alert-success">
                        {{$message}}
                    </div>

                @endif
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $user->name)}}">

                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email', $user->email)}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                    </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $user->phone)}}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                      <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company" class="form-control @error('company') is-invalid @enderror" value="{{old('company', $user->company)}}">
                        @error('company')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                      <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror"  value="{{old('country', $user->country)}}">
                        @error('country')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" >{{old('address', $user->address)}}</textarea>
                        @error('address')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    </div>
                    <div class="offset-md-1 col-md-3">
                      <div class="form-group">
                        <label for="bio">Profile picture</label>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new img-thumbnail" style="width: 150px; height: 150px;">
                            <img src="{{ asset('storage/' . $user->profile_picture)}}" alt="..." style="width: 150px; height: 150px;">
                          </div>
                          <div class="fileinput-preview fileinput-exists img-thumbnail"
                            style="max-width: 150px; max-height: 150px;"></div>
                          <div class="mt-2">
                            <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                image</span><span class="fileinput-exists">Change</span><input type="file"
                                name="profile_picture" accept="image/*" value="{{old('profile_picture', $user->profile_picture)}}"></span>
                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                              data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <div class="card-footer">
              <div class="row">
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                      <button type="submit" class="btn btn-success">Update Profile</button>
                    </div>
                </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


@endsection

@push('scripts')
<script src="{{asset('js/jasny-bootstrap.min.js')}}"></script>

@endpush

@push('styles')
<link href="{{asset('/css/jasny-bootstrap.min.css')}}" rel="stylesheet">

@endpush
