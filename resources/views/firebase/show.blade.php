<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>

   

    <table class="table mt-1">
        <thead>
            <!-- <th style="font-weight: bold;">Sno</th>
            <th style="font-weight: bold;">Name</th> -->
            <th style="font-weight: bold; margin-right:40px;">Email</th>
            <th style="font-weight: bold; margin-right:40px;">Phone Number</th>
            <th style="font-weight: bold; margin-right:40px;">Action</th>

        </thead>
        <tbody id="tbody1"></tbody>

    </table>

    <div class="form-group">
        <label>Name</label>
        <input id="url" type="hidden" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input id="Emailbox" type="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Phone Number</label>
        <input id="Pnbox" type="text" class="form-control" required>
    </div>
    <label for="image">Upload Image:</label>
    <input type="file" id="imageInput" name="image" id="image">
<br>
<button id="Insbtn" class="btn btn-success"
    style="width: 40% ; text-align: center;">Insert</button>
</div>



<div class="modal fade" tabindex="-1" id="editUserModal" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Users</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Name</label>
								<input id="editName" type="text" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input id="editEmail" type="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input id="editPhone" type="text" class="form-control" required>
							</div>

						</div>
					
						<button id="updateBtn" class="btn btn-success"
							style="width: 40% ; text-align: center;">Save</button>
					</div>
				</div>
			</div>


    
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

@include('firebase.view')
</body>
</html>