@extends('layouts.admin.app')

<!-- Heading -->
@section('title', 'County')

<!-- Body -->
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <h2></h2>
                    <form id="ajaxForm" method="{{$edit_mode ? "PUT" : "POST"}}" action="{{$edit_mode ? route('county.update',$county->id) : route('county.store') }}">
                        @if ($edit_mode)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" required  placeholder="Enter name" name="name" value ="{{$edit_mode ? $county->name : ""}}">
                        </div>

                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select class="form-control" id="state_id" name="state" required>
                                <option selected disabled> Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ $edit_mode ? ($state->id == $county->state_id ? 'selected' : '') : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="cancle" class="btn btn-secondary">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('custom-js')
<script>


    $('#ajaxForm').on('submit',function(event){
        event.preventDefault();
        var method = $(this).attr('method');
        
        var url = $(this).attr('action');
        var name = $('#name').val();
        var state = $('#state_id').val();

        $.ajax({
                method: method,
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    state: state,

                }
            }).done(function(data) {
                if (data.status == "success") {
                    window.location.href = "{{route('county.index')}}";
                }

                else {
                    $.each(data.data,function(key,value) {
                        alert(value)
                    })
                }
            })
    });
</script>
@endsection
