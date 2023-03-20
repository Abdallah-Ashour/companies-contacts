@extends('layouts.main')

{{-- title --}}
@section("title", "Contact App | All Contacts")

@section('content')



<main class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-title">
                <div class="d-flex align-items-center">
                  <h2 class="mb-0">
                    All Contacts
                    @if (request()->query('trash'))
                       <small>(In Trash)</small>
                    @endif
                </h2>
                  <div class="ml-auto">
                    <a href="{{ route("index.create")}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                  </div>
                </div>
              </div>
            <div class="card-body">
                {{-- include filter file --}}
                @include("shared.filter", [
                    "filterDropDown" => 'index._company_selection'
                ])
                @include('shared.flash')

              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>
                        {!! sortable("First Name") !!}
                    </th>
                    <th scope="col">
                        {!! sortable("Last Name") !!}

                    </th>
                    <th scope="col">
                        {!! sortable("Phone") !!}

                    </th>
                    <th scope="col">
                        {!! sortable("Email") !!}

                    </th>
                    <th scope="col">Company</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $showTrashButton = request()->query('trash')? true : false;
                @endphp


                    @forelse ($arr as $index => $contact)
                    @include('index._contact', ['contact' => $contact, 'index' => $index])

                   @empty
                   @include('shared.empty', ["numCol" => 6])
                  @endforelse

                  {{-- @each('index._contact', $arr, 'contact', 'index._empty') --}}





                </tbody>
              </table>

              {{ $arr->withQueryString()->links()}}

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


@endsection
