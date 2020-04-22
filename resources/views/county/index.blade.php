@extends('layouts.admin.app')

<!-- Heading -->
@section('title', 'Counties list')

@section('custom-css')

@endsection

<!-- Body -->
@section('content')
<div class="container">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">Counties List</h4>


                    </div>
                    <div class="col-md-2 mb-4">
                        <button class="create btn btn-primary mr-2">Create</button>
                        @if (!$deleted_mode)
                            <button class="trash btn btn-danger">Trash</button>
                        @else
                            <button class="index btn btn-secondary">Index</button>
                        @endif
                    </div>

                </div>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            if($deleted_mode) 
                                $title = "Restore";
                            else 
                                $title = "Delete";

                            @endphp
                            @foreach ($counties as $county)

                                <tr>
                                    <td>{{$county->id}}</td>
                                    <td>{{$county->name}}</td>
                                    <td>{{$county->state->name}}</td>
                                    <td>
                                    
                                        @if (!$deleted_mode)
                                            <a href="{{route('county.edit',$county->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{route('county.services',$county->id)}}" class="btn btn-secondary">Services</a>
                                        @endif
                                            <a href="#" data-id={{$county->id}} class=" btn-delete btn btn-danger">{{$title}}</a>
                                        <form id="delete-form-{{ $county->id }}" method="{{$deleted_mode ? 'GET' : 'POST'}}" action="{{ $deleted_mode ? route('county.restore', $county->id) : route('county.destroy', $county->id) }}" style="display: none;">
                                            @if(!$deleted_mode)
                                                @csrf
                                                @method('delete')
                                                @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <br>
                {{$counties->links()}}
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('custom-js')

<script>
$('.create').click(function() {
    window.location.href="{{route('county.create')}}";
})

$('.trash').click(function() {
    window.location.href="{{route('county.deleted')}}";
})

$('.index').click(function() {
    window.location.href="{{route('county.index')}}";
})


$(document).ready(function() {

	// DataTable initialisation
	$('#example').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": false,
			"autoWidth": true,
			"buttons": [
				'colvis',
				'copyHtml5',
                'csvHtml5',
				'excelHtml5',
                'pdfHtml5',
				'print'
			]
		}
	);

        // Delete Button Click
        $('#example').on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#delete-form-' + id).submit();
        });
});
</script>
@endsection
