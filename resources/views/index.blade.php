`
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <label for="">Gender</label>
                            <label for="phone">Male</label><br>
                                <input type="radio" class="" placeholder="Male"  id="male" name="gender" value="male">
                                <label for="phone">Female</label>
                                <input type="radio" class="" placeholder="FeMale" id="female" name="gender" value="Female">
            
                                 
                                                        
                             
                            
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
                            <select name="department" class="form-control" id="department">
                                <?var $department = response.department;?>
                                <option>select department</option>
                                @foreach ($department as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group mb-3">
                            <label for="designation">Designation</label>
                            <select name="designation" class="form-control" id="designation">
                                <option>select designation</option>
                                @foreach ($department as $item)
                                   <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Save</button>
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
                        <input type="hidden" name="edit_emp_id" id="edit_emp_id" class="form-control"
                            value="">
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
                        <label for="edit_male">Male</label><br>
                        <input type="radio" class="" placeholder="Male" id="edit_male" name="gender" value="male">
                        <label for="edit_female">Female</label>
                        <input type="radio" class="" placeholder="Female" id="edit_female" name="gender" value="female">
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
                            {{-- <label for="edit_image">Image</label>
                            <input type="file" name="image" class="" id="edit_image"required>
                            <label for="edit_image_label"></label> --}}

                            <div class="custom-file">
                                <input type="file" style="display: none;" id="edit_image">
                                <button type="button" class="btn btn-secondary" id="uploadButton">Upload Image</button>
                                <label  id="edit_image_label" for="edit_image_label"></label>
                            </div>

                            
                        </div> 

                        

                        <div class="form-group mb-3">
                            <label for="edit_department">Department</label>
                            <select name="edit_department" id="edit_department"
                                class="form-control"required>
                            
                            <option>select department</option>
                                 
                        </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_designation">Designation</label>
                            <select name="edit_designation" id="edit_designation"
                                class="form-control"required>
                                <option>select designation</option>
                            </select>
                        </div>

                    </div>
                    <input type="hidden" id="eid" name="id">
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

            function getDeptName(departmentId){
                return $.ajax({
                    type: 'GET',
                    url: '/getDepartmentName/' + departmentId,
                    dataType: 'json'
                });
            }
            function getDesgName(designationId){

                return $.ajax({
                    type: 'GET',
                    url: '/getDesignationName/' + designationId,
                    dataType: 'json'
                });
                
            }

            function fetchEmployee() {
                $.ajax({
                    type: "GET",
                    url: "/fetch-employee",
                    dataType: "json",
                    success: function(response) {
                        $('tbody').html("");
                        console.log(response.employee);
                        $.each(response.employee, function(key, item) {
                            var formattedDob = moment(item.dob, 'YYYY-MM-DD').format(
                                'DD/MM/YYYY');
                            var formattedDoj = moment(item.doj, 'YYYY-MM-DD').format(
                                'DD/MM/YYYY');  

                            var departmentPromise = getDeptName(item.department);
                            var designationPromise = getDesgName(item.designation);
                            
                            $.when(departmentPromise, designationPromise).done(function (departmentData, designationData) {
                             var departmentName = departmentData[0].name;
                             var designationName = designationData[0].name;

                                 $('tbody').append('<tr>' +
                                     '<td>' + item.id + '</td>' +
                                     '<td>' + item.name + '</td>' +
                                     '<td>' + item.gender + '</td>' +
                                     '<td>' + item.email + '</td>' +
                                     '<td>' + item.phone + '</td>' +
                                     '<td>' + item.address + '</td>' +
                                     '<td><img src="uploads/employee/' + item.image + '" width="50px" height="50px" alt="Image"></td>' +
                                     '<td>' + formattedDob + '</td>' +
                                     '<td>' + formattedDoj + '</td>' +
                                     '<td>' + departmentName + '</td>' +
                                     '<td>' + designationName + '</td>' +
                                     '<td><button type="button" data-edit_employee="' + item.id +
                                     '" class="edit_employee btn btn-primary btn-sm" id="edtBtn">Edit</button></td>' +
                                     '<td><button type="button" data-delete_employee="' + item.id +
                                     '" class="delete_employee btn btn-danger btn-sm">Delete</button></td>' +
                                     '</tr>');
                             });
                            });

                        //     $('tbody').append('<tr>' +
                        //         '<td>' + item.id + '</td>' +
                        //         '<td>' + item.name + '</td>' +
                                
                        //         '<td>' + item.gender + '</td>' +
                        //         '<td>' + item.email + '</td>' +
                        //         '<td>' + item.phone + '</td>' +
                        //         '<td>' + item.address + '</td>' +
                        //         '<td><img src="' + item.image +
                        //         '" width="50px" height="50px" alt="Image"></td>' +
                        //         '<td>' + formattedDob + '</td>' +
                        //         '<td>' + formattedDoj + '</td>' +
                        //         '<td>' + item.department + '</td>' +
                        //         '<td>' + item.designation + '</td>' +
                        //         '<td><button type="button" data-edit_employee="' + item.id +
                        //         '" class="edit_employee btn btn-primary btn-sm" id="edtBtn">Edit</button></td>' +
                        //         '<td><button type="button" data-delete_employee="' + item
                        //         .id +
                        //         '" class="delete_employee btn btn-danger btn-sm">Delete</button></td>' +
                        //         '</tr>');
                        // });
                    }
                });
            }

                        // Function to update the options of the designation dropdown based on the selected department
            function updateDesignationDropdown(selectedDepartment, selectedDesignation) {
                // Make an Ajax call to fetch the designations based on the selected department
                $.ajax({
                    type: 'GET',
                    url: '/getdepartment',  // Update the URL to match your route
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        // if (response.status == 200) {
                            // Clear existing options
                            $('#edit_department').empty();
                            // Add new options based on the response
                            $.each(response, function(key, department) {
                                $('#edit_department').append('<option value="' + department.id + '">' + department.name + '</option>');                            
                            });

                            // Set the selected designation
                            $('#edit_department').prop('selectedIndex',selectedDepartment);                        // } else {
                            // Handle error, unable to fetch designations
                            // alert('Unable to fetch designations');
                        // }
                        $.ajax({
                            type: 'GET',
                            url: '/getdesignation/'+selectedDepartment,
                            success: function(response) {
                                console.log(response);
                                $('#edit_designation').empty();

                                $.each(response, function(key, value) {
                                    $('#edit_designation').append('<option value = ' + key + '>' +
                                        value + '</option>');
                                });
                            
                            },
                            error: function(xhr2, status2, error2) {
                                console.error('Error fetching data from endpoint 2:', error2);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle Ajax error
                        console.error(xhr.responseText);
                    }
                });
            }
            
            $('#uploadButton').on('click', function() {
                $('#edit_image').click();
            });

            $('#edit_image').on('change', function() {
                var fileName = $(this).val().split('\\').pop();  // Get the file name from the path
                $('#edit_image_label').text(fileName || 'Upload Image');
            });

            $(document).on('click', '.edit_employee', function(e) {
                e.preventDefault();
                var emp_id = $(this).data('edit_employee');
                console.log('Clicked edit button with emp_id:', emp_id);
                $('#EDIT_employeeModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit_emp/" + emp_id,
                    success: function(response) {
                        console.log(response.employee);
                        console.log(response.employee.gender);
                        if (response.status == 404) {
                            $('#EDIT_employeeModal').modal('hide');
                        } else {
                            $('#edit_emp_id').val(response.employee.id)

                            $('#edit_name').val(response.employee.name);
                            $('#edit_email').val(response.employee.email);
                            // $('#edit_gender').val(response.employee.gender);  
                            var gender = response.employee.gender;

                            // Check the appropriate radio button based on the gender
                            if (gender === 'male') {
                                $('#edit_male').prop('checked', true);
                            } else if (gender === 'female') {
                                $('#edit_female').prop('checked', true);
                            } 
                             
                            $('#edit_phone').val(response.employee.phone);
                            $('#edit_address').val(response.employee.address);
                            //$('#edit_image').val(response.employee.image);
                            $('#edit_image_label').text(response.employee.image);
                            $('#edit_department').val(response.employee.department);
                            updateDesignationDropdown(response.employee.department, response.employee.designation);
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
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                $.ajax({
                    type: "POST",
                    url: "/employeestore",
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
                    url: "/update-emp",
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
                        } else if (response.status == 200) {
                            $('#update_errList').html("");
                            $('#update_errList').addClass('d-none');
                            $('#EDIT_employeeModal').modal('hide');

                            fetchEmployee();
                        }
                        fetchEmployee();
                    }
                });
            });
            $(document).on('click', '.delete_employee', function(e) {
                e.preventDefault();
                var emp_id = $(this).data('delete_employee');
                $.ajax({
                    method: "GET",
                    url: "/delete-emp/" + emp_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                        fetchEmployee();

                    }
                });
            });
            $('#EDIT_employeeModal_close_button').on('click', function() {
                $('#UpdateEmployeeForm')[0].reset();
                $('#UpdateEmployeeForm').find('.edit_employee').val('');
            });


            $('#department').change(function() {
                if ($('#department').val().trim() === '') {
                    $('#designation').html('<option></option>');
                    return false;
                }
                var department_id = $(this).val();
                // alert(department_id);
                $.ajax({
                    url: '/getdesignation/' + department_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#designation').empty();
                        $.each(data, function(key, value) {
                            $('#designation').append('<option value = ' + key + '>' +
                                value + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error in AJAX request:', status, error);
                        $('#designation').empty().append('<option></option>');
                        alert('Error loading designations. Please try again.');

                    }
                });
            });
            // Assuming you have a modal with ID edit_employee_modal
            $(document).on('change', '#edit_department', function() {
                //if ($(this).val().trim() === '') {
                //    $('#edit_designation').html('<option>select designation</option>');
                //    return false;
                //}
                var department_id = $(this).val();
                $.ajax({
                    url: '/getdesignation/' + department_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#edit_designation').empty();
                        console.log(data)
                        $.each(data, function(key, value) {
                            $('#edit_designation').append('<option value=' + key + '>' + value + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error in AJAX request:', status, error);
                         
                    }
                });
            });
             
        });
    </script>


</body>

</html>
