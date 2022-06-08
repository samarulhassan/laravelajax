<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sudents</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Student <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">ADD NEW</button>
					</div>
					<div class="card-body">
						<table id="studentTable" class="table">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($students as $student)
								<tr>
									<td>{{$student->firstname}}</td>
									<td>{{$student->lastname}}</td>
									<td>{{$student->email}}</td>
									<td>{{$student->phone}}</td>
									<td><a href="javascript:void(0)" onclick="editStudent({{$student->id}})" class="btn btn-info">Edit</a></td>
								</tr>
								@endforeach


							</tbody>


					</div>
				</div>
			</div>

		</div>





	</div>
<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <form id="studentForm">
			  @csrf
			  <div class="form-group">
				  <label for="firstname">FirstName</label>
				  <input type="text" name="firstname" class="form-control"/>
				  <label for="lastname">LastName</label>
				  <input type="text" name="lastname" class="form-control"/>
				  <label for="email">Email</label>
				  <input type="text" name="email" class="form-control"/>
				  <label for="phone">Phone</label>
				  <input type="text" name="phone" class="form-control"/>
				</div>
				<button type="submit" class="btn btn-success">Submit</buttom>

		  </form>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <form id="studentForm">
			  @csrf
			  <input type="hidden" name="id" id="id"/>
			  <div class="form-group">
				  <label for="firstname">FirstName</label>
				  <input type="text" name="firstname" id="firstname" class="form-control"/>
				  <label for="lastname">LastName</label>
				  <input type="text" name="lastname" id="lastname" class="form-control"/>
				  <label for="email">Email</label>
				  <input type="text" name="email" id="email" class="form-control"/>
				  <label for="phone">Phone</label>
				  <input type="text" name="phone" id="phone" class="form-control"/>
				</div>
				<button type="submit" class="btn btn-success">Submit</buttom>

		  </form>
        
      </div>
    </div>
  </div>
</div>

<script>
	$('#studentForm').submit(function(e){
		e.preventDefault();
		var firstname = $("input[name=firstname]").val();
		var lastname = $("input[name=lastname]").val();
		var email = $("input[name=email]").val();
		var phone = $("input[name=phone]").val();
		var _token = $("input[name=_token]").val();

		$.ajax({
			url:"{{route('student.add')}}",
			type:"POST",
			data:{
				firstname:firstname,
				lastname:lastname,
				email:email,
				phone:phone,
				_token:_token
			},
			success:function(response){
				console.log(response)
				$('#studentTable').append('<tr><td>'+firstname+'</td><td>'+lastname+'</td><td>'+email+'</td><td>'+phone+'</td><tr>');
				$('#studentModal').modal('toggle');
				$('#studentForm')[0].reset();
			}
		})


	})
</script>


<script>

	function editStudent(id){
		$.get('students/'+id,function(student){
			$("#id").val(student.id);
			$("#firstname").val(student.firstname);
			$("#lastname").val(student.lastname);
			$("#email").val(student.email);
			$("#phone").val(student.phone);
			$("#studentEditModal").modal("toggle");
			

		});
	}

</script>



</body>
</html>