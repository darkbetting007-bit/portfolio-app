<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Models\About;
use App\Models\Project;
use App\Models\Skill;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Guard against missing tables during first deploy before migrations run.
    $tablesReady = Schema::hasTable('abouts')
        && Schema::hasTable('projects')
        && Schema::hasTable('skills');

    if (! $tablesReady) {
        return response(view('frontend.setup'), 503)
            ->header('Retry-After', '30');
    }

    try {
        $about = About::first();
        $featuredProjects = Project::where('featured', true)->latest()->take(3)->get();
        $projects = Project::latest()->paginate(6);
        $skills = Skill::all();
        return view('frontend.home', compact('about', 'featuredProjects', 'projects', 'skills'));
    } catch (\Exception $e) {
        return response(view('frontend.setup'), 503)
            ->header('Retry-After', '30');
    }
})->name('home');

Route::get('/project/{project:slug}', function (Project $project) {
    try {
        $about = Schema::hasTable('abouts') ? About::first() : null;
        return view('frontend.project-detail', compact('project', 'about'));
    } catch (\Exception $e) {
        return response(view('frontend.setup'), 503)
            ->header('Retry-After', '30');
    }
})->name('project.show');

Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Setup Route (untuk migrasi & storage link di Railway)
|--------------------------------------------------------------------------
*/
Route::get('/setup', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Setup completed! Migrations run and storage linked.';
});

/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Projects CRUD
    Route::resource('projects', ProjectController::class);

    // Skills CRUD
    Route::resource('skills', SkillController::class);

    // About (single record, hanya edit)
    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    // Contact Messages (hanya index & show)
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}/read', [AdminContactController::class, 'markRead'])->name('contacts.read');
});

require __DIR__.'/auth.php';
