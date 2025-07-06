<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use GroupValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class GroupController extends Controller
{
    use GroupValidator;
    function index(){
        
        $gender = Auth::user() -> gender == "ذكر" ? "ذكور" : "إناث";

        $groups = Group::with(['supervisor','monitor','students']) -> where('gender', $gender) -> get();
        $users = User::with(['roles', 'college', 'group']) -> where("banned", false) ->  where('gender', Auth::user() -> gender) -> get();

        $students = [];
        foreach ($users as $user){
            if (in_array(Constants::ROLE_STUDENT, $user -> roles -> pluck('id') -> toArray())){
                $students[] = $user;
            }
        }


        return view('group.index') -> with([
            'groups' => $groups,
            'students' => $students,
        ]);
    }

    function store(Request $request){
        [$status, $message] = $this -> isValidGroupStore($request);
        if ($status == 'error'){
            return redirect() -> back() -> with('error', $message);
        }

        $supervisor_id = $request -> supervisor_id;
        $monitor_id = $request -> monitor_id;
        $group_name = $request -> group_name;
        
        $group = new Group();
        $group -> supervisor_id = $supervisor_id;
        $group -> monitor_id = $monitor_id;
        $group -> name = $group_name;

        $groupGender = Auth::user() -> gender == "ذكر" ? "ذكور" : "إناث";
        $group -> gender = $groupGender;

        $group -> save();

        return redirect() -> back() -> with('success', $message);
    }

    function delete(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'group_id' => ['required', 'integer', Rule::exists('groups', 'id'), Rule::unique('users', 'group_id')],
                // unique means doesn't exist in the table
            ],
            [
                'group_id.required' => 'لا يمكن ترك حقل رقم المجموعة فارغًا',
                'group_id.integer' => 'رقم المجموعة يجب أن يكون رقمًا صحيحًا',
                'group_id.exists' => 'الحلقة غير موجودة أو تحتوي على طلاب',
                'group_id.unique' => 'الحلقة تحتوي على طلاب ولا يمكن حذفها', 
            ]
        );

        if ($validator -> fails()){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $group_id = $request -> group_id;
        $group = Group::find($group_id);
        $group -> delete();
        return redirect() -> back() -> with('success', 'تم حذف الحلقة بنجاح');
    }

    function updateSupervisor(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'group_id' => ['required', 'integer', Rule::exists('groups', 'id')],
                'supervisor_id' => ['nullable', 'integer', Rule::exists('users', 'id'), Rule::unique('groups', 'supervisor_id')]
            ],
            [
                'group_id.required' => 'لا يمكن ترك حقل رقم المجموعة فارغًا',
                'group_id.integer' => 'رقم المجموعة يجب أن يكون رقمًا صحيحًا',
                'group_id.exists' => 'الحلقة غير موجودة',
                'supervisor_id.required' => 'لا يمكن ترك حقل رقم المشرف فارغًا',
                'supervisor_id.integer' => 'رقم المشرف يجب أن يكون رقمًا صحيحًا',
                'supervisor_id.exists' => 'المشرف غير موجود',
                'supervisor_id.unique' => 'المشرف مشرف لحلقة أخرى'
            ]
        );


        if ($validator -> fails()){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $supervisor_id = $request -> supervisor_id;

        if ($supervisor_id && !in_array(Constants::ROLE_SUPERVISOR, User::find($supervisor_id) -> roles -> pluck('id') -> toArray())){
            return redirect() -> back() -> with('error', 'المشرف المحدد ليس مشرفًا');
        }

        $group = Group::find($request -> group_id);
        $group -> supervisor_id = $request -> supervisor_id;

        $group -> save();

        return redirect() -> back() -> with('success', 'تم تغيير المشرف بنجاح');
    }

    function updateMonitor(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'group_id' => ['required', 'integer', Rule::exists('groups', 'id')],
                'monitor_id' => ['nullable', 'integer', Rule::exists('users', 'id')]
            ],
            [
                'group_id.required' => 'لا يمكن ترك حقل رقم المجموعة فارغًا',
                'group_id.integer' => 'رقم المجموعة يجب أن يكون رقمًا صحيحًا',
                'group_id.exists' => 'الحلقة غير موجودة',
                'monitor_id.required' => 'لا يمكن ترك حقل رقم المتابع فارغًا',
                'monitor_id.integer' => 'رقم المتابع يجب أن يكون رقمًا صحيحًا',
                'monitor_id.exists' => 'المتابع غير موجود',
            ]
        );


        if ($validator -> fails()){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $monitor_id = $request -> monitor_id;

        if ($monitor_id && !in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER, User::find($monitor_id) -> roles -> pluck('id') -> toArray())){
            return redirect() -> back() -> with('error', 'المتابع المحدد ليس متابعًا');
        }

        $group = Group::find($request -> group_id);
        $group -> monitor_id = $request -> monitor_id;

        $group -> save();

        return redirect() -> back() -> with('success', 'تم تغيير المتابع بنجاح');
    }

    function updateStudentGroup(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'student_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'group_id' => ['required', 'integer', Rule::exists('groups', 'id')]
            ], [
                'student_id.required' => 'لا يمكن ترك حقل رقم الطالب فارغًا',
                'student_id.integer' => 'رقم الطالب يجب أن يكون رقمًا صحيحًا',
                'student_id.exists' => 'الطالب غير موجود',
                'group_id.required' => 'لا يمكن ترك حقل رقم المجموعة فارغًا',
                'group_id.integer' => 'رقم المجموعة يجب أن يكون رقمًا صحيحًا',
                'group_id.exists' => 'المجموعة غير موجودة'
            ]
        );

        if ($validator -> fails()){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $student_id = $request -> student_id;
        $group_id = $request -> group_id;

        $student = User::find($student_id);

        $student -> group_id = $group_id;
        $student -> save();

        return redirect() -> back() -> with('success', 'تم تغيير المجموعة بنجاح');
    }
}
