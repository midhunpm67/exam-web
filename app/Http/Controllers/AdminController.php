<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TeacherRegisterRequest;
use App\Http\Requests\AdminTeacherRegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\SendEmailJob;
use App\Mail\emailVerify;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ViewErrorBag;
use Nette\Utils\Json;

use function Symfony\Component\VarDumper\Dumper\esc;

class AdminController extends Controller
{

    public function __construct(AdminRepository $AdminRespository)
    {
        $this->adminRepository = $AdminRespository;
    }

    public function login(LoginRequest $request)
    {
        $loginStatus = $this->adminRepository->login($request);
        if ($loginStatus) {
            if ($loginStatus['user'] == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return view('Student.dashboard');
            }
        } else {
            return back()->with('error', 'These credentials do not match our records..!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }   
    public function adminDashboard()
    {
        return view('Admin.dashboard.dashboard');
    }
    public function register(Request $request)
    {
        $tkn = Str::random(64);
        SendEmailJob::dispatch($request->email, $tkn);
        if (Mail::failures()) {
            $response = "mail failed";
        } else {
            $response = $this->adminRepository->register($request,$tkn);
        }
        return response()->json($response);
    }
    public function listTeacher()
    {
        return view('Admin.teacher.list-teacher');
    }
    public function teacherJsonData(Request $request)
    {
        $response = $this->adminRepository->teacherList($request);
        return response()->json($response);
    }
    public function deleteTeacher()
    {
        $response = $this->adminRepository->deleteTeacher(request()->id);
        return response()->json($response);
    }
    public function getTeacherData()
    {
        $response = $this->adminRepository->getTeacherData(request()->id);
        return response()->json($response);
    }
    public function createTeacher(TeacherRegisterRequest $request)
    {
        $create = $this->adminRepository->addTeacher($request);
        return back()->with('success', 'New teacher details added..!');
    }
    public function editTeacher(Request $request)
    {
        $this->adminRepository->editTeacher($request);
        return back()->with('success', 'Teacher details updated..!');
    }
}
