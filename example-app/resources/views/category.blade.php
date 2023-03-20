@extends('layout/master')
@section('title', "Category")

@section('content')
<div class="container">
    category {{ $id}}
</div>

@endsection

@section('sidebar')
 @parent
 <br>
 This Is Sidebar From Child
@endsection
