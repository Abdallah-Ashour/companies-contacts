@extends('layout/master')
@section('title', "Contact Me")

@section('content')
<div class="container">

      Hi This Is Contact Me Page
      <h1>{{ $page_name}}</h1>
      <p> {{ $page_description }} </p>

</div>
@endsection


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_name}}</title>
</head>
<body>
  <h1>{{ $page_name}}</h1>
  <p>{{ $page_description }}</p>
</body>
</html> --}}
