<?php

namespace App\Http\Controllers;

use App\Models\Recitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use QF\Constants;
use QFLogger;

class RecitationController extends Controller
{
    function index()
    {
        return view('recitation.index')->with([
            'students' => getSupervisorStudents(Auth::user()->id),
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
            'recitations' => getRecitationBySupervisorIdAndYear(Auth::user()->id, getCurrentYear()),
        ]);;
    }




    function update(Request $request)
    {
        [$status, $message] = $this->validateUpdate($request);

        if ($status === 'error') {
            return redirect()->route('recitation.index')->with('error', $message);
        }

        $recitations = json_decode($request->new_recitations);
        foreach ($recitations as $recitation) {
            if ($recitation->id == null) {
                $oldRecitation = Recitation::where([
                    'week_id' => $recitation->week->id,
                    'user_id' => $recitation->user->id,
                ]);

                if ($oldRecitation->exists()) {
                    QFLogger::error("found another recitation for user in same week", $oldRecitation);
                    $oldRecitation->delete();
                }
                Recitation::create([
                    'week_id' => $recitation->week->id,
                    'user_id' => $recitation->user->id,
                    'memorized_pages' => $recitation->memorized_pages,
                    'repeated_pages' => $recitation->repeated_pages,
                    'memorization_mark' => $recitation->memorization_mark,
                    'tajweed_mark' => $recitation->tajweed_mark,
                    'notes' => ''
                ]);

                $user = User::find($recitation->user->id);
                $user-> status = Constants::STUDENT_STATUS_ACTIVE;
                $user -> save();
            } else {
                $oldRecitation = Recitation::find($recitation->id);
                $oldRecitation->memorized_pages = $recitation->memorized_pages;
                $oldRecitation->repeated_pages = $recitation->repeated_pages;
                $oldRecitation->memorization_mark = $recitation->memorization_mark;
                $oldRecitation->tajweed_mark = $recitation->tajweed_mark;
                $oldRecitation->save();
            }
        }
        return redirect()->route('recitation.index')->with($status, $message);
    }

    function zero($val)
    {
        if ($val === "0" || $val === 0) {
            return true;
        }
        return false;
    }

    function validateUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_recitations' => ['required', 'json'],
        ]);


        if ($validator->fails()) {
            return ['error', $validator->errors()->first()];
        }

        $recitations = json_decode($request->new_recitations);

        if (!is_array($recitations)) {
            return ['error', 'request is not valid'];
        }

        foreach ($recitations as $recitation) {
            $arrayRecitation = (array) $recitation;
            $validator = Validator::make($arrayRecitation, [
                'memorized_pages' => ['required', 'numeric', 'min:0'],
                'repeated_pages' => ['required', 'numeric', 'min:0'],
                'memorization_mark' => ['required', 'numeric', 'min:0', 'max:10'],
                'tajweed_mark' => ['required', 'numeric', 'min:0', 'max:10'],
            ], [
                'memorized_pages.required' => 'حقل صفحات الحفظ مطلوب',
                'repeated_pages.required' => 'حقل صفحات التثبيت مطلوب',
                'memorization_mark.required' => 'حقل علامة الحفظ مطلوب',
                'tajweed_mark.required' => 'حقل علامة التجويد مطلوب',
                'memorization_mark.min' => 'علامة الحفظ يجب أن تكون أكبر من 0',
                'memorization_mark.max' => 'علامة الحفظ يجب أن تكون أقل من 10',
                'tajweed_mark.min' => 'علامة التجويد يجب أن تكون أكبر من 0',
                'tajweed_mark.max' => 'علامة التجويد يجب أن تكون أقل من 10',
                'memorized_pages.numeric' => 'حقل صفحات الحفظ يجب أن يكون رقميا',
                'repeated_pages.numeric' => 'حقل صفحات التثبيت يجب أن يكون رقميا',
                'memorization_mark.numeric' => 'حقل علامة الحفظ يجب أن يكون رقميا',
                'tajweed_mark.numeric' => 'حقل علامة التجويد يجب أن يكون رقميا',
                'memorized_pages.min' => 'حقل صفحات الحفظ يجب أن يكون أكبر من 0',
                'repeated_pages.min' => 'حقل صفحات التثبيت يجب أن يكون أكبر من 0',
            ]);
            if ($validator->fails()) {
                return ['error', $validator->errors()->first()];
            }
        }

        foreach ($recitations as $recitation) {
            if ($this->zero($recitation->memorized_pages) && $this->zero($recitation->repeated_pages)) {
                return ["error", "لا يمكن ترك صفحات الحفظ والتثبيت صفرا"];
            }
        }

        return ['success', 'تم تحديث البيانات بنجاح'];
    }
}
