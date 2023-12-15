<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\designation;
use App\Models\employee;
use App\Models\department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class EmployeeController extends Controller
{

    public function index(){
        $department = department::all();
        return view("index",['department'=>$department]);
    }
    public function create(Request $request)
    {
        // dd($request);
        employee::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "gender" => $request->gender,
            "image" => $request->image,
            "dob" => $request->dob,
            "department" => $request->department,
            "doj" => $request->doj,
            "designation" => $request->designation,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully',
        ]);
    }
    public function fetch_employee(Request $request)
    {
        $fetchedEmployee = Employee::all();
        return response()->json(['employee' => $fetchedEmployee]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'address' => 'required|max:191',
            'image' => 'required|image|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {


            $employee = new employee;
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->address = $request->input('address');
            $employee->gender = $request->input('gender');
            $employee->department = $request->input('department');
            $employee->designation = $request->input('designation');

            try{
                $dobstring = $request->input('doj');
                $dojstring = $request->input('dob');

                $dob = Carbon::createFromFormat('Y-m-d', $dobstring);
                $doj = Carbon::createFromFormat('Y-m-d', $dojstring);

                $employee->dob = $dob->format('Y-m-d');
                $employee->doj = $doj->format('Y-m-d');
            }catch(\Exception $e){
                dd($e->getMessage());
            

            }

            if($request->hasFile('image'))
            {

              $file = $request->file('image');
              $extension = $file->getClientOriginalExtension();
              $filename = time() . '.' . $extension;
              $file->move('uploads/employee/', $filename);
              $employee->image = $filename;
            }
    
    
            $employee->save();

            return response()->json([
            'status' => 200,
            'message' => 'Added Successfully',
            ]);
        }
    }


    public function edit_employee($emp_id)
    {
        // Find the employee by ID
        $employee = Employee::find($emp_id);
        // Check if the employee exists
        if (!$employee) {
            // Handle the case where the employee is not found
            return response()->json(['status' => 404, 'message' => 'Employee not found']);
        } else {
            // Return the employee data
            return response()->json(['status' => 200, 'employee' => $employee]);
        }
    }

    public function update_employee(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'address' => 'required|max:191',
            'gender' => 'required',
            'image' => 'image|max:2048',
            'dob' => 'required',
            'department' => 'required',
            'doj' => 'required',
            'designation' => 'required',
        ]);
        $employee = Employee::find($request->input('edit_emp_id'));
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/employee');
            $imagePath = basename($imagePath);
        } else {
            $imagePath = $employee->image;
        }

        // dd($data);
        $employee->update([
            "name" => $data['name'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "address" => $data['address'],
            "gender" => $data['gender'],
            "image" => $imagePath,
            "dob" => $data['dob'],
            "department" => $data['edit_department'],
            "doj" => $data['doj'],
            "designation" => $data['edit_designation'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully',
        ]);
    }
    public function delete_employee($emp_id)
    {
        //Log::info('Deleting employee with ID: ' . $emp_id);
        $employee = Employee::find($emp_id);
        if (!$employee) {
            return response()->json(['status' => 404, 'message' => 'employee not found']);

        }
        $employee->delete();
        return response()->json(['status' => 200, 'message' => 'employee deleted']);
    }
    public function getdesignation($department_id)
    {
        $designation= designation::where('department_id', $department_id)->pluck('name', 'id');
        return response()->json($designation);
    }
    public function getdepartment()
{
    $department = department::all(); // Replace with your model and query logic
    return response()->json($department);
    //$designation = Designation::where('department_id', $department_id)->pluck('name', 'id');
    //return response()->json($designation);
}

    public function getDepartmentName($id)
    {
        $department = department::find($id);
    
        if ($department) {
            return response()->json([
                'id' => $department->id,
                'name' => $department->name,
            ]);
        }
    
        return response()->json(['error' => 'Department not found'], 404);
    }
    
    public function getDesignationName($id)
    {
        $designation = designation::find($id);
    
        if ($designation) {
            return response()->json([
                'id' => $designation->id,
                'name' => $designation->name,
            ]);
        }
    
        return response()->json(['error' => 'Designation not found'], 404);
    }

}



// if($validator->fails()){
//     return response()->json([
//         'status'=>400,
//         'errors' => $validator->messages(),
//     ]);
// }
// else
// {
//     $employee = employee::find();

//     if($employee)
//     {
//         $employee->name = $request->input('name');
//         $employee->email = $request->input('email');
//         $employee->phone = $request->input('phone');
//         $employee->address = $request->input('address');

//         $employee->gender = $request->input('gender');
//         // $employee->dob = $request->input('dob');
//         $employee->department = $request->input('department');
//         $employee->designation = $request->input('designation');
//         // $employee->doj = $request->input('doj');

//         try {
//             $dobString = $request->input('dob');
//             $dojString = $request->input('doj');

//             // Parse and format the 'dob' and 'doj' dates
//             $dob = Carbon::createFromFormat('m/d/Y', $dobString);
//             $doj = Carbon::createFromFormat('m/d/Y', $dojString);

//             $employee->dob = $dob->format('Y-m-d');
//             $employee->doj = $doj->format('Y-m-d');
//         } catch (\Exception $e) {
//             // Print the error message for further debugging
//             dd($e->getMessage());
//         }

//         if($request->hasFile('image'))
//         {
//             $path = 'uploads/employee/'.$employee->image;

//             if(File::exists($path))
//             {
//                 File::delete($path);
//             }

//             $file = $request->file('image');
//             $extension =  $file->getClientOriginalExtension();
//             $filename = time() . '.' .$extension;
          //$file->move('uploads/employee/', $filename);
//             $employee->image = $filename;
//         }

//         $employee->save();

// else
// {

//     return response()->json([
//         'status'=>404,
//         'message' => 'Employee Not found',
//     ]);
// }
 