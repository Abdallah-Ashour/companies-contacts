@extends('layouts.main')

{{-- title --}}
@section("title", "Contact App | Edit New Contact")


@section('content')
<main class="py-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-title">
              <strong>Edit New Contact</strong>
            </div>
            <div class="card-body">

                <form action="{{ route('index.update', $contact->id)}}" method="post">
                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                    @csrf
                    @method('put')
              @include('index._form')
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


@endsection
