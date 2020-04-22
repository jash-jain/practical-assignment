@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <a href="{{route('states.index')}}" ><h5>State List</h5></a>
                        <a href="{{route('county.index')}}" ><h5>Counties List</h5></a>
                        <a href="{{route('service.index')}}" ><h5>Services List</h5></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
