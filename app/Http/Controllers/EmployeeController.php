<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class EmployeeController extends Controller
{
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
            'status'=>200,
            'message' => 'Added Successfully',
        ]);




    }
    public function fetch_employee(Request $request)
    {
        $fetchedEmployee = Employee::all();
        // Format date fields before sending the response

        return response()->json(['employee' => $fetchedEmployee]);
    }
    // public function store(Request $request){
        
    // }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:191',
            'address'=>'required|max:191',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]); 

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $date = $request->input('doj');
            $employee = new employee;
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->address = $request->input('address');

            $employee->gender = $request->input('gender');
            $employee->department = $request->input('department');
            $employee->designation = $request->input('designation');


            try {
                $dobString = $request->input('dob');
                $dojString = $request->input('doj');

                // Parse and format the 'dob' and 'doj' dates
                $dob = Carbon::createFromFormat('d/m/Y', $dobString);
                $doj = Carbon::createFromFormat('d/m/Y', $dojString);
            
                $employee->dob = $dob->format('Y-m-d');
                $employee->doj = $doj->format('Y-m-d');
            } catch (\Exception $e) {
                // Print the error message for further debugging
                dd($e->getMessage());
            }
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension =  $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('uploads/employee/', $filename);
                $employee->image = $filename;
            }
            
            $employee->save();

            return response()->json([
                'status'=>200,
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
        }

        // Return the employee data
        return response()->json(['status' => 200, 'employee' => $employee]);


    }
    public function update_employee(Request $request, $emp_id)
    {
        $employee = Employee::find($emp_id);
        $data = $request->all();
        // dd($data);
        $employee->update([
            "name" => $data['name'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "address" => $data['address'],
            "gender" => $data['gender'],
            "edit_image" => $data['image'],
            "dob" => $data['dob'],
            "department" => $data['department'],
            "doj" => $data['doj'],
            "designation" => $data['designation'],
        ]);

    }

    
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:191',
            'address'=>'required|max:191',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]); 

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $employee = employee::find($id);

            if($employee)
            {
                $employee->name = $request->input('name');
                $employee->email = $request->input('email');
                $employee->phone = $request->input('phone');
                $employee->address = $request->input('address');

                $employee->gender = $request->input('gender');
                // $employee->dob = $request->input('dob');
                $employee->department = $request->input('department');
                $employee->designation = $request->input('designation');
                // $employee->doj = $request->input('doj');

                try {
                    $dobString = $request->input('dob');
                    $dojString = $request->input('doj');
    
                    // Parse and format the 'dob' and 'doj' dates
                    $dob = Carbon::createFromFormat('m/d/Y', $dobString);
                    $doj = Carbon::createFromFormat('m/d/Y', $dojString);
                
                    $employee->dob = $dob->format('Y-m-d');
                    $employee->doj = $doj->format('Y-m-d');
                } catch (\Exception $e) {
                    // Print the error message for further debugging
                    dd($e->getMessage());
                }

                if($request->hasFile('image'))
                {
                    $path = 'uploads/employee/'.$employee->image;

                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $file = $request->file('image');
                    $extension =  $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('uploads/employee/', $filename);
                    $employee->image = $filename;
                }
                
                $employee->save();

                return response()->json([
                    'status'=>200,
                    'message' => 'Added Successfully',
                ]);
            }
            else
            {

                return response()->json([
                    'status'=>404,
                    'message' => 'Employee Not found',
                ]);
            }
                
      
        
        } 
    }
}