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
                    <h3>Add User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('add-user') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Upload Image:</label>
                                <input type="file" name="image"  class="form-control" accept="image/*">
                            </div>
                            
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
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