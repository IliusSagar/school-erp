<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewShift(){

        $data['allData'] = StudentShift::all();
        return view('backend.setup.student_shift.view_shift',$data);

    } // End Mathod

    public function StudentShiftAdd(){

        return view('backend.setup.student_shift.add_shift');

    } // End Mathod

    public function StudentShiftStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);

    } // End Mathod

    public function StudentShiftEdit($id){

        $editData = StudentShift::find($id);
        return view('backend.setup.student_shift.edit_shift',compact('editData'));

    } // End Mathod

    public function StudentShiftUpdate(Request $request,$id){

        $data = StudentShift::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id,
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);

    } // End Mathod

    public function StudentShiftDelete($id){

        $user = StudentShift::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Shift Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.shift.view')->with($notification);

    } // End Mathod

}
