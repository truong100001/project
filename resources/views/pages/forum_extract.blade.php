@extends('master')

@section('content')
    @include('components.header_moblie')
    @include('components.header')
    @include('components.menu')
    @include('components.forum.forum_extract')

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection