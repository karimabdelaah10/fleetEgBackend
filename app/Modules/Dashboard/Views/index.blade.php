@extends('BaseApp::layouts.master')
@section('page-title')
الصفحه الرئيسيه
@endsection
@section('content')
<div class="section-wrapper">
        <example-component></example-component>
</div>
@endsection
@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
@endpush
