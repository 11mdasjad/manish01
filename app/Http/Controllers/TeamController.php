<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $executiveBoard = TeamMember::active()->where('department', 'Executive Board')->orderBy('order')->get();
        $otherMembers = TeamMember::active()->where('department', '!=', 'Executive Board')->orderBy('order')->get();

        if ($executiveBoard->isEmpty()) {
            $executiveBoard = TeamMember::active()->orderBy('order')->take(3)->get();
            $otherMembers = TeamMember::active()->orderBy('order')->skip(3)->take(10)->get();
        }

        return view('pages.team', compact('executiveBoard', 'otherMembers'));
    }
}
