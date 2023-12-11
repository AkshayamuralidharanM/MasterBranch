`
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap JS, jQuery, and Datepicker -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddEmployeeForm" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <ul class="alert alert-warning d-none" id="saveform_errList"></ul>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" class="form-control" id="gender">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address">
                        </div>

                        <div class="form-group mb-3">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control datepicker" name="dob"
                                placeholder="Select a date">
                        </div>

                        <div class="form-group mb-3">
                            <label for="doj">DOJ</label>
                            <input type="date" class="form-control datepicker" name="doj"
                                placeholder="Select a date">
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                        <div class="form-group mb-3">
                            <label for="department">Department</label>
                            <input type="text" name="department" class="form-control" id="department">
                        </div>

                        <div class="form-group mb-3">
                            <label for="designation">Designation</label>
                            <input type="text" name="designation" class="form-control" id="designation">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="EDIT_employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="UpdateEmployeeForm" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <ul class="alert alert-warning d-none" id="update_errList"></ul>
                        <input type="hidden" name="edit_emp_id" id="edit_emp_id" class="form-control" value="">
                        <div class="form-group mb-3">
                            <label for="edit_name">Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_email">Email</label>
                            <input type="text" name="email" id="edit_email" class="form-control"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_gender">Gender</label>
                            <input type="text" name="gender" id="edit_gender" class="form-control"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_phone">Phone</label>
                            <input type="number" name="phone" id="edit_phone" class="form-control"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_address">Address</label>
                            <input type="text" name="address" id="edit_address" class="form-control"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_dob">DOB</label>
                            <input type="date" class="form-control datepicker" id="edit_dob" name="dob"
                                placeholder="Select a date"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_doj">DOJ</label>
                            <input type="date" class="form-control datepicker" id="edit_doj" name="doj"
                                placeholder="Select a date"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_image">Image</label>
                            <input type="file" name="image" class="form-control" id="edit_image"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_department">Department</label>
                            <input type="text" name="department" id="edit_department"
                                class="form-control"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_designation">Designation</label>
                            <input type="text" name="designation" id="edit_designation"
                                class="form-control"required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" id='EDIT_employeeModal_close_button' class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Portal
                            <a href="#" data-bs-toggle="modal" data-bs-target="#employeeModal"
                                class="btn btn-primary btn-sm float-end">Add Employee</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="employeeTable" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Image</th>
                                        <th>DOB</th>
                                        <th>DOJ</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Employee data will be added here dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetchEmployee();

            function fetchEmployee() {
                $.ajax({
                    type: "GET",
                    url: "/fetch-employee",
                    dataType: "json",
                    success: function(response) {
                        $('tbody').html("");
                        $.each(response.employee, function(key, item) {
                            var formattedDob = moment(item.dob, 'YYYY-MM-DD').format(
                                'DD/MM/YYYY');
                            var formattedDoj = moment(item.doj, 'YYYY-MM-DD').format(
                                'DD/MM/YYYY');
                            $('tbody').append('<tr>' +
                                '<td>' + item.id + '</td>' +
                                '<td>' + item.name + '</td>' +
                                '<td>' + item.gender + '</td>' +
                                '<td>' + item.email + '</td>' +
                                '<td>' + item.phone + '</td>' +
                                '<td>' + item.address + '</td>' +
                                '<td><img src="uploads/employee/' + item.image +
                                '" width="50px" height="50px" alt="Image"></td>' +
                                '<td>' + formattedDob + '</td>' +
                                '<td>' + formattedDoj + '</td>' +
                                '<td>' + item.department + '</td>' +
                                '<td>' + item.designation + '</td>' +
                                '<td><button type="button" data-edit_employee="' + item.id +
                                '" class="edit_employee btn btn-primary btn-sm">Edit</button></td>' +
                                '<td><button type="button" data-id="' + item.id +
                                '" class="delete_employee btn btn-danger btn-sm">Delete</button></td>' +
                                '</tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.edit_employee', function(e) {
                e.preventDefault();
                var emp_id = $(this).data('edit_employee');
                console.log('Clicked edit button with emp_id:', emp_id);
                $('#EDIT_employeeModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit_emp/" + emp_id,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 404) {
                            alert(response.message);
                            $('#EDIT_employeeModal').modal('hide');
                        } else {
                            $('#edit_emp_id').val(response.employee.id)

                            $('#edit_name').val(response.employee.name);
                            $('#edit_email').val(response.employee.email);
                            $('#edit_gender').val(response.employee.gender);
                            $('#edit_phone').val(response.employee.phone);
                            $('#edit_address').val(response.employee.address);
                            $('#edit_department').val(response.employee.department);
                            $('#edit_designation').val(response.employee.designation);
                            $('#edit_dob').val(response.employee.dob);
                            $('#edit_doj').val(response.employee.doj);
                            $('#emp_name').val(emp_id);
                            $('.edit_employee').val(emp_id);
                        }
                    }
                });
            });

            $(document).on('submit', '#AddEmployeeForm', function(e) {
                e.preventDefault();
                let formData = new FormData($('#AddEmployeeForm')[0]);
                $.ajax({
                    type: "POST",
                    url: "/employee.store",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        //console.log(response)
                        if (response.status == 400) {
                            $('#saveform_errList').html("");
                            $('#saveform_errList').removeClass('d-none')

                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_errList').append('<li>' + err_values +
                                    '</li>');
                            });
                        } else if (response.status == 200) {
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass('d-none');
                            $('#AddEmployeeForm').find('input').val('');
                            $('#employeeModal').modal('hide');
                            
                            fetchEmployee();
                            // alert(response.message)

                        }
                        fetchEmployee();
                    }
                });
            });

            $(document).on('submit', '#UpdateEmployeeForm', function(e) {
                e.preventDefault();
                var emp_id = $('.edit_employee').val();
                // alert(emp_id);
                let EditformData = new FormData($('#UpdateEmployeeForm')[0]);
                $.ajax({
                    type: "POST",
                    url: "/update-emp/" + emp_id,
                    data: EditformData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        //console.log(response)
                        if (response.status == 400) {
                            $('#update_errList').html("");
                            $('#update_errList').removeClass('d-none')

                            $.each(response.errors, function(key, err_values) {
                                $('#update_errList').append('<li>' + err_values +
                                    '</li>');
                            });
                        } else if (response.status == 404) {
                            alert(response.message);
                        } else if (response.status == 200) {
                            $('#update_errList').html("");
                            $('#update_errList').addClass('d-none');
                            $('#EDIT_employeeModal').modal('hide');

                            alert(response.message);
                            fetchEmployee();
                        }
                        fetchEmployee();
                    }
                });

                $(document).on('click', '.delete_employee', function(e) {
                    e.preventDefault();
                    var emp_id = $(this).data('emp_id');
                    $.ajax({
                        type: "GET",
                        url: "/delete-emp/" + emp_id,
                        
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            //console.log(response)
                            if (response.status == 400) {
                                $('#update_errList').html("");
                                $('#update_errList').removeClass('d-none')

                                $.each(response.errors, function(key, err_values) {
                                    $('#update_errList').append('<li>' + err_values +
                                        '</li>');
                                });
                            } else if (response.status == 404) {
                                alert(response.message);
                            } else if (response.status == 200) {
                                $('#update_errList').html("");
                                $('#update_errList').addClass('d-none');
                                $('#EDIT_employeeModal').modal('hide');

                                alert(response.message);
                                fetchEmployee();
                            }
                            fetchEmployee();
                        }
                    });
                
                });

                $('#EDIT_employeeModal_close_button').on('click', function() {
                    $('#UpdateEmployeeForm')[0].reset();
                    $('#UpdateEmployeeForm').find('.edit_employee').val('');
                });
            });

        });
    </script>
</body>

</html>
