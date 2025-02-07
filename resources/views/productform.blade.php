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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">Add New Product</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="SubmitForm" action="{{ route('productstore') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input name="id" type="hidden" class="form-control" id="id">
                            <label for="name" class="col-form-label">Name:</label>
                            <input name="name" type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="col-form-label">Price:</label>
                            <input name="price" type="number" class="form-control" id="price">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="col-form-label">Category:</label>
                            <select name="category" id="category">
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="condition" class="col-form-label">Condition:</label>
                            <input type="radio" name="condition" value="brandnew"> New
                            <input type="radio" name="condition" value="used"> Used
                        </div>
                        <div class="mb-3">
                            <label for="expirydate" class="col-form-label">Expiry Date:</label>
                            <input type="date" id="expirydate" name="expirydate" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="profilepic" class="col-form-label">Upload Profile Image:</label>
                            <input type="file" id="profilepic" name="profilepic" class="form-control">
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
            fetchrecord()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `productupdate/${id}` : "productstore";

                $.ajax({
                    url: url,
                    data: formData,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    type: "post",
                    success: function (response) {
                        $('#SubmitForm')[0].reset();
                        $('#exampleModal').modal('hide');
                        alert(response.success);
                        fetchrecord();
                    },
                    error: function (xhr) {
                        alert(xhr.responseText);
                    }

                })
            })
            function fetchrecord() {
                $.ajax({
                    url: "{{route('productget')}}",
                    type: "GET",
                    success: function (response) {
                        var tr = '';
                        for (var i = 0; i < response.length; i++) {
                            var id = response[i].id;
                            var name = response[i].name;
                            var price = response[i].price;
                            var category = response[i].category;
                            var condition = response[i].condition;
                            var expirydate = response[i].expirydate;

                            tr += '<tr>';
                            tr += '<td>' + id + '</td>';
                            tr += '<td>' + name + '</td>';
                            tr += '<td>' + price + '</td>';
                            tr += '<td>' + category + '</td>';
                            tr += '<td>' + condition + '</td>';
                            tr += '<td>' + expirydate + '</td>';
                            tr += `<td><button class="btn btn-success editBtn" data-id="${id}">Edit</button></td>   <td><button class="btn btn-danger deleteBtn" data-id="${id}">Delete</button></td>`;

                            tr += '</tr>';
                        }
                        $('#datatable tbody').html(tr);
                    }
                })
            }
            fetchrecord();


            $(document).on('click','.editBtn',function(){
                var id=$(this).data('id');
                $.ajax({
                   url:`productedit/${id}`,
                   type:"GET",
                   success:function(response)
                   {
                       $('#id').val(response.id);
                       $('#name').val(response.name);
                       $('#price').val(response.price);
                       $('#condition').val(response.condition);
                    //    for condition
                    // $("input[name='condition'][value='" + response.condition + "']").prop("checked", true);
                       $('#category').val(response.category);
                       $('#expirydate').val(response.expirydate);
                       $('#exampleModal').modal('show');
                       fetchrecord();
                   }
                })
            })
            $(document).on('click','.deleteBtn',function(){
                var id=$(this).data('id');
                $.ajax({
                   url:`productdelete/${id}`,
                   type:"delete",
                   data:{
                     _token:"{{csrf_token()}}"
                   },
                   success:function(response)
                   {
                      alert(response.success);
                       fetchrecord();
                   }
                })
            })
        })
    </script>
</body>

</html>