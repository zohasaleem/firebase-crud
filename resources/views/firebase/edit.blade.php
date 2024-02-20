<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container">
       <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3>Edit User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-user/'.$key) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name"  value="{{ $users['name'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ $users['email'] }}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Upload Image:</label>
                                <input type="file" name="image"   value="{{ $users['image_url'] }}" class="form-control" accept="image/*">
                            </div>
                            <img src="{{ @$users['image_url'] }}" style="width:240px; height: 300px;">
                            
                            <div class="form-group mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
       </div>

        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>