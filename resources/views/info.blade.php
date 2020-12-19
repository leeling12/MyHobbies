@extends('layouts.app')

<!--the descriotion show under the title when search -->
<!-- to overrride the content -->
@section('page_description')
@section('page_title', 'About this project')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">
                  Info 1
                  Info 2
                  Info 3
                  Info 4
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
