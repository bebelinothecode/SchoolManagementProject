<?php

namespace App\Http\Controllers;

use App\Fees;
use App\Session;
use App\Student;
use App\FeesPaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  FeesController extends Controller
{
    public function show() {
        $sessions = Session::all();

        return view('backend.fees.show', compact('sessions'));
    }

    public function  create(Request $request) {

    $validatedData = $request->validate([
        'school_fees' => 'required|integer',
        'currency' => 'required',
        'session' => 'required',
        'student_type' => 'required',
        'start_academic_year' => 'required',
        'end_academic_year' => 'required'
    ]);

    Fees::create($validatedData);

    return redirect()->back()->with("success","School Fees has been set successfully");
    }

    public function showcollectfees() {
        $sessions = Session::all(); 

        $fees = Fees::all();

        $details = Student::with('user')->latest()->get();

        return view('backend.fees.collect', compact('sessions','details','fees'));
    }

    public function getStudentName(Request $request) {
        $indexNumber = $request->input('index_number');

        $student = Student::with('user')->where('index_number', $indexNumber)->first();

        if($student) {
            return response()->json(['name'=> $student->user->name]);
        } else {
            return response()->json(['name'=>null], 404);
        }
    }

    public function collectfees(Request $request) {

        $validatedData = $request->validate([
            'student_index_number' => 'required|string',
            'student_name' => 'required | string',
            'start_academic_year' => 'required',
            'end_academic_year' => 'required',
            'semester' => 'required',
            'method_of_payment' => 'required',
            'amount' => 'required',
            'balance' => 'required',
            'currency' => 'required',
            'Momo_number' => 'nullable',
            'cheque_number' => 'nullable',
        ]);

        $feespaid = FeesPaid::create($validatedData);

        return view('backend.fees.receipt', compact('feespaid'))->with('success', 'School Fees has been collected');
    }

    public function selectdefaulters() {
        $sessions = Session::all();

        return view('backend.fees.defaulters', compact('sessions'));
    }

    public function getdefaulters(Request $request) {
        $start_academic_year = $request->start_academic_year;
        $end_academic_year = $request->end_academic_year;
        $semester = $request->semester;

        $defaulters = FeesPaid::select('student_index_number', 'student_name','balance','currency')
        ->where('start_academic_year', $start_academic_year)
        ->where('end_academic_year', $end_academic_year)
        ->where('semester', $semester)
        ->where('balance', '>', 0)
        ->groupBy('student_index_number', 'student_name','balance','currency')
        ->get();

        return view('backend.fees.defaulters', [
            'defaulters' => $defaulters,
            'sessions' => Session::all(), // Pass sessions for the dropdown
        ]);
        

    }


    public function test() {
        $fees = FeesPaid::all();

        // dd($defaulters);

        return $fees;
    }
}


