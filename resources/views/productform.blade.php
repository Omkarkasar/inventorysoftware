<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</head>

<body>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1"
        data-bs-whatever="@mdo">Add New User</button>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModal1Label">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="SubmitForm1"  enctype="multipart/form-data">
                        <div class="mb-3">
                            <input name="id" type="hidden" class="form-control" id="id">
                            <label for="username" class="col-form-label">User Name:</label>
                            <input name="username" type="text" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- User List -->
    <a href="" class="btn btn-success">User List</a>

    <table class="table" id="datatable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">profilepic</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Condition</th>
                <th scope="col">Expiry date</th>
            </tr>
        </thead>
        <tbody>
            <!-- jquery will handle this -->

        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

              $('#SubmitForm1').on('submit',function(e){
                e.preventDefault();
                var id=$('#id').val();
                // var formdata=new FormData(this);
                var name=$('#name').val();
                var email=$('#email').val();
                var url=id ? `updateclient/${id}` : `clientstore`;
                $.ajax({
                    url:url,
                    type:"POST",
                    data:{

                        name:name,
                        email:email
                    },
                    processData:false,
                    contentType:false,
                    success:function(response)
                    {
                        $('#SubmitForm1').reset();
                        $('#exampleModal1').modal('hide');
                    }
                })

              })
        })
    </script>
</body>

</html>