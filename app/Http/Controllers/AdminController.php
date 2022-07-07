<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TeacherRegisterRequest;
use App\Http\Requests\AdminTeacherRegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\SendEmailJob;
use App\Mail\emailVerify;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
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
            return view('login');
        }
    }
    public function adminDashboard()
    {
        return view('Admin.dashboard');
    }
    public function register(Request $request)
    {
        // dispatch(new SendEmailJob($request->email));

        // $status = SendEmailJob::dispatch($request->email);

        $response = $this->adminRepository->register($request);
        return response()->json($response);
    }
    public function listTeacher()
    {
        return view('Admin.list-teacher');
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
    // public function listStudent()
    // {

    // }
    public function createTeacher(TeacherRegisterRequest $request)
    {
        $create = $this->adminRepository->addTeacher($request);
        return true;
    }
}
