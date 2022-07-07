<?php

namespace App\Repositories;

use App\Jobs\SendEmailJob;
use App\Mail\emailVerify;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminRepository.
 */
class AdminRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
    public function login($request)
    {
        $credentials = array('email' => $request->email, 'password' => $request->password);

        if (Auth::guard('admin')->attempt($credentials)) {
            $status = ['status' => true, 'user' => 1];
        } elseif (Auth::guard('student')->attempt($credentials)) {
            $status = ['status' => true, 'user' => 2];
        } else {
            $status = false;
        }
        return $status;
    }
    public function register($request)
    {
        $token = Str::random(64);
        // $status = SendEmailJob::dispatch($request->email, $token);
        $email = new emailVerify($token);
        Mail::to($request->email)->send($email);
        if (Mail::failures()) {
            $response = "mail failure";
        } else {
            $request->token = $token;
            $response['create'] = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'token' => $token,
                'verified' => 0
            ]);
            $response['token'] = $token;
        }
        return $response;
    }
    public function teacherList($request)
    {
        $draw = $request->draw;
        $search = $request->search['value'];
        $length = $request->length;
        $start = $request->start;
        // getting driver data
        $query = Admin::select('id', 'name', 'email')->where('usertype', '2');
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['name', 'email'];
            $query->where(function ($query) use ($searchColumns, $search) {
                foreach ($searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            $filteredCount = $query->count();
        } else {
            $filteredCount = $count;
        }
        $teachers = $query->offset($start)->limit($length)->get();
        // creating action buttons
        foreach ($teachers as $teacher) {
            $teacher['actions'] = "
            <button class='btn btn-success me-2 editbtn' data-toggle='modal' data-target='#exampleModal' value='$teacher->id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
             </svg></button>
            <button class='btn btn-danger deletebtn' value='$teacher->id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
          </svg></button>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $teachers];
    }
    public function deleteTeacher($id)
    {
        return Admin::find($id)->delete();
    }
    public function getTeacherData($id)
    {
        return Admin::select('*')->where('_id', $id)->first();
    }
    public function addTeacher($request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        dd($admin);
    }
}
