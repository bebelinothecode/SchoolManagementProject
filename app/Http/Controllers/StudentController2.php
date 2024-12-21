<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class StudentController2 extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:8',
            'parent_id'         => 'required|numeric|exists:parents,id',
            'class_id'          => 'required|string',
            'roll_number'       => [
                'required',
                'numeric',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'gender'            => 'required|string',
            'phone'             => 'required|string|max:255',
            'dateofbirth'       => 'required|date',
            'current_address'   => 'required|string|max:255',
            'academicyear'      => 'required|string',
            'session'           => 'required|string'
        ]);

        // dd($request);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('profile_picture')) {
                $profile = Str::slug($user->name) . '-' . $user->id . '.' . $request->profile_picture->getClientOriginalExtension();
                $request->profile_picture->move(public_path('images/profile'), $profile);
            } else {
                $profile = 'avatar.png';
            }

            $user->update(['profile_picture' => $profile]);

            $user->student()->create([
                'parent_id'         => $request->parent_id,
                'class_id'          => $request->class_id,
                'roll_number'       => $request->roll_number,
                'gender'            => $request->gender,
                'phone'             => $request->phone,
                'dateofbirth'       => $request->dateofbirth,
                'current_address'   => $request->current_address,
                'permanent_address' => $request->permanent_address ?? null,
                'index_number'      => $request->index_number ?? null,
                'academicyear'      => $request->academicyear,
                'session'           => $request->session,
            ]);

            $user->assignRole('Student');

            DB::commit();

            return redirect()->route('backend.students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            Log::error('Failed to create student: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->withErrors('An error occurred while creating the student. Please try again.');
        }
    }
    //
}
