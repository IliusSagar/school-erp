<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup(){

        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_group.view_group',$data);

    } // End Mathod

    public function StudentGroupAdd(){

    return view('backend.setup.student_group.add_group');

    } // End Mathod

    public function StudentGroupStore(Request $request){

    $validatedData = $request->validate([
        'name' => 'required|unique:student_groups,name',
    ]);

    $data = new StudentGroup();
    $data->name = $request->name;
    $data->save();

    $notification = array(
        'message' => 'Student Group Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('student.group.view')->with($notification);

    } // End Mathod

    public function StudentGroupEdit($id){

    $editData = StudentGroup::find($id);
    return view('backend.setup.student_group.edit_group',compact('editData'));

    } // End Mathod

    public function StudentGroupUpdate(Request $request,$id){

    $data = StudentGroup::find($id);
    $validatedData = $request->validate([
        'name' => 'required|unique:student_groups,name,'.$data->id,
    ]);


    $data->name = $request->name;
    $data->save();

    $notification = array(
        'message' => 'Student Group Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('student.group.view')->with($notification);

    } // End Mathod

    public function StudentGroupDelete($id){

    $user = StudentGroup::find($id);
    $user->delete();

    $notification = array(
        'message' => 'Student Group Deleted Successfully',
        'alert-type' => 'info'
    );

    return redirect()->route('student.group.view')->with($notification);

    } // End Mathod


}
