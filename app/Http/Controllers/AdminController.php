<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClaimResource;
use App\Http\Resources\CollaborationResource;
use App\Http\Resources\ErrorReportResource;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\Claim;
use App\Models\Collaboration;
use App\Models\ErrorReport;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function finances()
    {

        return inertia('Admin/Finances');
    }

    public function configurations()
    {

        return inertia('Admin/Configurations');
    }

    public function claims()
    {
        $claims = ClaimResource::collection(Claim::with(['collaboration.homework' => ['chats' => ['users', 'messages.user'], 'schoolSubject', 'user']])->paginate());
        return inertia('Admin/Claims', compact('claims'));
    }

    public function notifications()
    {

        return inertia('Admin/Notifications');
    }

    public function users()
    {

        $users = User::with('level', 'collaborations')->paginate();

        // return UserResource::collection($users);
        return inertia('Admin/Users', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function errors(Request $request)
    {
        $filters = $request->all('search');
        $errors = ErrorReportResource::collection(ErrorReport::filter($filters)
            ->with('user')
            ->latest()
            ->paginate());

        // return $errors;
        return inertia('Admin/Errors', compact('errors'));
    }

    public function collaborations(Request $request)
    {
        $collaborations = CollaborationResource::collection(Collaboration::doesntHave('claim')
            ->with(['homework' => ['schoolSubject', 'user'], 'user'])
            ->paginate());
        return inertia('Admin/Collaborations', compact('collaborations'));
    }
}
