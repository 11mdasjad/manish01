<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\SitemapController;

// Auth Controller
use App\Http\Controllers\Auth\LoginController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactMessageController as AdminMessageController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| Public Corporate Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::redirect('/about', '/about-us');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/our-team', [TeamController::class, 'index'])->name('team.index');
Route::redirect('/team', '/our-team');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::redirect('/contact', '/contact-us');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-and-conditions', [LegalController::class, 'terms'])->name('legal.terms');

// Technical SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.alias');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Executive Admin Panel Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['web', 'admin'])->group(function () {
    Route::get('/', fn() => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Products Management
    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::post('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('admin.products.toggle-status');

    // Services Management
    Route::resource('services', AdminServiceController::class)->names('admin.services');
    Route::post('services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus'])->name('admin.services.toggle-status');

    // Categories Management
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories');

    // Projects Management
    Route::resource('projects', AdminProjectController::class)->names('admin.projects');

    // Team Members Management
    Route::resource('team', AdminTeamController::class)->names('admin.team');

    // Testimonials Management
    Route::resource('testimonials', AdminTestimonialController::class)->names('admin.testimonials');

    // Clients Management
    Route::resource('clients', AdminClientController::class)->names('admin.clients');

    // Gallery Management
    Route::resource('gallery', AdminGalleryController::class)->names('admin.gallery');

    // Blogs Management
    Route::resource('blogs', AdminBlogController::class)->names('admin.blogs');

    // Contact Messages
    Route::get('messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
    Route::post('messages/{message}/toggle-read', [AdminMessageController::class, 'toggleRead'])->name('admin.messages.toggle-read');
    Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Commercial Enquiries
    Route::get('enquiries', [AdminEnquiryController::class, 'index'])->name('admin.enquiries.index');
    Route::get('enquiries/{enquiry}', [AdminEnquiryController::class, 'show'])->name('admin.enquiries.show');
    Route::put('enquiries/{enquiry}/status', [AdminEnquiryController::class, 'updateStatus'])->name('admin.enquiries.update-status');
    Route::delete('enquiries/{enquiry}', [AdminEnquiryController::class, 'destroy'])->name('admin.enquiries.destroy');

    // Website Settings
    Route::get('settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');

    // Admin Profile & Security
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password');
});
