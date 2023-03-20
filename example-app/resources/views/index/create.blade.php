@extends('layouts.main')

{{-- title --}}
@section("title", "Contact App | Add New Contact")


@section('content')
<main class="py-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-title">
              <strong>Add New Contact</strong>
            </div>
            <div class="card-body">

                <form action="{{ route('index.store')}}" method="post">
                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                    @csrf
              @include('index._form')
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


@endsection
