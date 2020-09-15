<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use Illuminate\Http\Request;
use App\Project;
use App\User;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
//        $this->authorize('update', $project);         //moved to form request ProjectInvitationRequest
//
//        request()->validate([
//            'email' => ['required', 'exists:users,email']
//        ], [
//            'email.exists'=>'The user you are inviting must have a Birdboard account.'
//        ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
