<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $leadership = TeamMember::active()->orderBy('order')->take(6)->get();
        $testimonials = Testimonial::active()->orderBy('order')->take(4)->get();
        $clients = Client::active()->orderBy('order')->take(8)->get();

        return view('pages.about', compact('leadership', 'testimonials', 'clients'));
    }
}
