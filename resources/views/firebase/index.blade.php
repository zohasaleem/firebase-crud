<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
    
    <div class="container">

       <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Users</h4>
                        <a href="{{ url('new-user')}}" class="btn btn-md btn-primary">Add User</a>
                    </div>
                    <div class="card-body">
                    <table class="table table-striped users-data">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>
                                    <img src="{{ @$user['image_url'] }}" style="width:225; height: 140px;"/>
                                </td>
                                <td>
                                    <a href="{{  url('edit-user/'.$key) }}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{  url('delete-user/'.$key) }}" class="btn btn-sm btn-danger">Del</a>
                                </td>
                            </tr>
                            @endforeach  --}}
                        </tbody>
                    </table>


                    </div>
                </div>
            </div>
       </div>
        
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">



    <script type="text/javascript">

        $(function () {
            setTimeout(function () {
                var table = $('.users-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('firebase/users-list') }}"
                   
                  
                },
                columns: [
                
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},

                    {
                        data: 'image_url', 
                        name: 'image_url',
                        render: function (data) {
                            if (data != null) {
                                return '<img src="' + data + '" alt="Image" width="200">';
                            }
                            return '';
                        }
                    },

                    {
                        data: 'action', 
                        name: 'action',
                    }
                ],
                
                order: [[0, 'desc']],
                });

               
            }, 1000); 
        });

    </script>

</body>
</html>