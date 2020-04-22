@extends('layouts.admin.app')

<!-- Heading -->
@section('title', "$state->name's Countries List ")

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
                        <h4 class="card-title">{{$state->name}}'s Counties List</h4>
                    </div>
                    <div class="col-md-2 mb-4">
                        <button class="back btn btn-primary mr-2"> Back to Main page</button>
                    </div>   
                    

                </div>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($state->counties as $county)

                                <tr>
                                    <td>{{$county->id}}</td>
                                    <td>{{$county->name}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('custom-js')

<script>
$('.back').click(function () {
    window.location.href = "{{route('states.index')}}"
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
   
});
</script>
@endsection
