<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Project;
use App\Models\Enquiry;
use App\Models\ContactMessage;
use App\Models\Blog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_products' => Product::count(),
            'total_services' => Service::count(),
            'total_projects' => Project::count(),
            'total_enquiries' => Enquiry::count(),
            'pending_enquiries' => Enquiry::where('status', 'pending')->count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_blogs' => Blog::count(),
        ];

        $recentEnquiries = Enquiry::latest()->take(6)->get();
        $recentMessages = ContactMessage::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentEnquiries', 'recentMessages'));
    }
}
