<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewYear(){

        $data['allData'] = StudentYear::all();
        return view('backend.setup.student_year.view_year',$data);

    } // End Mathod

    public function StudentYearAdd(){

        return view('backend.setup.student_year.add_year');

    } // End Mathod

    public function StudentYearStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);

        } // End Mathod

        public function StudentYearEdit($id){

            $editData = StudentYear::find($id);
            return view('backend.setup.student_year.edit_year',compact('editData'));

        } // End Mathod

        public function StudentYearUpdate(Request $request,$id){

        $data = StudentYear::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id,
        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);

        } // End Mathod

        public function StudentYearDelete($id){

        $user = StudentYear::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Year Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);

} // End Mathod

}
