@extends('layouts.admin.app')

<!-- Heading -->
@section('title', 'State List')

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
                        <h4 class="card-title">State List</h4>


                    </div>
                    

                </div>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($states as $state)

                                <tr>
                                    <td>{{$state->id}}</td>
                                    <td>{{$state->name}}</td>
                                    <td>{{$state->code}}</td>
                                    <td>
                                    <a href="{{route('state.counties',$state->id)}}"  class=" btn-delete btn btn-secondary">View Counties</a>

                                    </td>
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <br>
                {{$states->links()}}
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('custom-js')

<script>


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
   
});
</script>
@endsection
