@extends('layouts.admin.app')

<!-- Heading -->
@section('title', 'Service')

<!-- Body -->
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <h2></h2>
                    <form id="ajaxForm" method="{{$edit_mode ? "PUT" : "POST"}}" action="{{$edit_mode ? route('service.update',$service->id) : route('service.store') }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"  required placeholder="Enter name" name="name" value ="{{$edit_mode ? $service->name : ""}}">
                        </div>

                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select class="form-control" id="state_id" name="state" required>
                                <option selected disabled> Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="county">Counties</label>
                            <select class="form-control m-select2" id="counties_is" name="counties[]" required multiple="multiple">
                                @foreach ($counties as $county)
                                    <option value="{{ $county->id }}" selected>{{ $county->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <br>
                        </div>
                        <br>
                        <br>
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

    $(document).ready(function() {
        $(".m-select2").select2();
        var id;
        $('#state_id').change(function(){
            id = $('#state_id').val();
            var url = "{{route('get.counties','STATE_ID' )}}".replace('STATE_ID',id);

            $(".m-select2").select2({
                closeOnSelect: false,
                placeholder: "Select counties",
                ajax: {
                    url: url,

                    data: function (params) {
                        return {
                            search: params.term,
                        };
                    },

                    processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    }
                }
            });


        })
    });



    $('#ajaxForm').on('submit',function(event){
        event.preventDefault();
        var method = $(this).attr('method');
        var url = $(this).attr('action');
        var name = $('#name').val();
        var counties = $('#counties_is').val();

        $.ajax({
                method: method,
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    counties : counties,

                }
            }).done(function(data) {
                if (data.status == "success") {
                    window.location.href = "{{route('service.index')}}";
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
