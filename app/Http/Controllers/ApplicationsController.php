<?php

namespace App\Http\Controllers;

use App\Models\MonitoringApplication;
use App\Models\SupervisingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class ApplicationsController extends Controller
{
    function indexSupervising(){
        return view('applications.index-supervising');
    }
    function indexMonitoring(){
        return view('applications.index-monitoring');
    }

    function getSupervisingApplication(Request $request){
        $supervisingApplications = SupervisingApplication::with('user') -> get();
        return response()->json($supervisingApplications);
    }
    function getPendingSupervisingApplication(Request $request){
        $supervisingApplications = SupervisingApplication::with('user') -> where('status', Constants::APPLICATION_STATUS_PENDING) -> get();
        return response()->json($supervisingApplications);
    }
    function getMonitoringApplication(Request $request){
        $monitoringApplication = MonitoringApplication::with('user') -> get();
        return response()->json($monitoringApplication);
    }

    function takeActionSupervisingApplication(Request $request){
        $validator = Validator::make($request->all(), [
            'application_id' => ['required', Rule::exists('supervising_applications', 'id')],
            'action' => ['required', Rule::in(['accept', 'reject'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $supervisingApplication = SupervisingApplication::find($request->application_id);

        if ($supervisingApplication-> status !== Constants::APPLICATION_STATUS_PENDING){
            return redirect()->back()->with('error', 'تمت معالجة الطلب');
        }

        if ($request->action === 'accept') {
            $supervisingApplication->status = Constants::APPLICATION_STATUS_ACCEPTED;

            // add role to user
            $user = $supervisingApplication->user;
            $user->roles()->attach(Constants::ROLE_SUPERVISOR);
        } else {
            $supervisingApplication->status = Constants::APPLICATION_STATUS_REJECTED;
        }
        
        $supervisingApplication->save();
        return redirect()->back()->with('success', 'تمت المعالجة بنجاح');
    }
    function takeActionMonitoringApplication(Request $request) {
        $validator = Validator::make($request->all(), [
            'application_id' => ['required', Rule::exists('monitoring_applications', 'id')],
            'action' => ['required', Rule::in(['accept', 'reject'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $monitoringApplication = MonitoringApplication::find($request->application_id);

        if ($monitoringApplication-> status !== Constants::APPLICATION_STATUS_PENDING){
            return redirect()->back()->with('error', 'تمت معالجة الطلب');
        }

        if ($request->action === 'accept') {
            $monitoringApplication->status = Constants::APPLICATION_STATUS_ACCEPTED;

            // add role to user
            $user = $monitoringApplication->user;
            $user->roles()->attach(Constants::ROLE_MONITORING_COMMITTE_MEMBER);
        } else {
            $monitoringApplication->status = Constants::APPLICATION_STATUS_REJECTED;
        }
        
        $monitoringApplication->save();
        return redirect()->back()->with('success', 'تمت المعالجة بنجاح');
    }
}
