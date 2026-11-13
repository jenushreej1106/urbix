<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\CitizenDashboardController;
use App\Http\Controllers\StaffDashboardController;


/*
|--------------------------------------------------------------------------
| HOME PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| ABOUT URBIX
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('pages.standard', [
        'title' => 'About URBIX',
        'number' => '01',
        'description' => 'Discover how URBIX connects citizens, technology and smart city infrastructure.',
        'features' => [
            [
                'icon' => '🏙️',
                'title' => 'Our Vision',
                'description' => 'Building connected and sustainable cities.'
            ],
            [
                'icon' => '🚀',
                'title' => 'Our Mission',
                'description' => 'Transforming urban services through technology.'
            ],
            [
                'icon' => '🌍',
                'title' => 'Our Impact',
                'description' => 'Creating better communities for everyone.'
            ]
        ]
    ]);
})->name('about');


/*
|--------------------------------------------------------------------------
| EXPLORE CITY
|--------------------------------------------------------------------------
*/

Route::get('/explore-city', function () {
    return view('pages.standard', [
        'title' => 'Explore City',
        'number' => '02',
        'description' => 'Discover smart locations, public infrastructure and city facilities.',
        'features' => [
            [
                'icon' => '🗺️',
                'title' => 'City Map',
                'description' => 'Explore important city locations.'
            ],
            [
                'icon' => '🏥',
                'title' => 'Hospitals',
                'description' => 'Find nearby healthcare facilities.'
            ],
            [
                'icon' => '🏫',
                'title' => 'Public Places',
                'description' => 'Discover public infrastructure.'
            ]
        ]
    ]);
})->name('explore');


/*
|--------------------------------------------------------------------------
| SMART SERVICES
|--------------------------------------------------------------------------
*/

Route::get('/smart-services', function () {
    return view('pages.standard', [
        'title' => 'Smart Services',
        'number' => '03',
        'description' => 'Access modern digital services designed for smarter urban living.',
        'features' => [
            [
                'icon' => '💡',
                'title' => 'Smart Lighting',
                'description' => 'Intelligent public lighting services.'
            ],
            [
                'icon' => '🚦',
                'title' => 'Traffic Systems',
                'description' => 'Better traffic management.'
            ],
            [
                'icon' => '♻️',
                'title' => 'Waste Management',
                'description' => 'Cleaner and greener communities.'
            ]
        ]
    ]);
})->name('services');


/*
|--------------------------------------------------------------------------
| TRACK COMPLAINT
|--------------------------------------------------------------------------
*/

Route::get('/track-complaint', [
    ComplaintController::class,
    'track'
])->name('track');


/*
|--------------------------------------------------------------------------
| EMERGENCY SERVICES
|--------------------------------------------------------------------------
*/

Route::get('/emergency-services', function () {
    return view('pages.standard', [
        'title' => 'Emergency Services',
        'number' => '07',
        'description' => 'Find important emergency contacts and public safety information.',
        'features' => [
            [
                'icon' => '🚓',
                'title' => 'Police',
                'description' => 'Emergency police assistance: 112.'
            ],
            [
                'icon' => '🚑',
                'title' => 'Ambulance',
                'description' => 'Medical emergency assistance: 112.'
            ],
            [
                'icon' => '🔥',
                'title' => 'Fire Services',
                'description' => 'Fire emergency assistance: 112.'
            ]
        ]
    ]);
})->name('emergency');


/*
|--------------------------------------------------------------------------
| CITY UPDATES
|--------------------------------------------------------------------------
*/

Route::get('/city-updates', function () {
    return view('pages.standard', [
        'title' => 'City Updates',
        'number' => '08',
        'description' => 'Stay informed about public announcements and city developments.',
        'features' => [
            [
                'icon' => '📢',
                'title' => 'Announcements',
                'description' => 'Important public announcements.'
            ],
            [
                'icon' => '🏗️',
                'title' => 'Development',
                'description' => 'Updates on city projects.'
            ],
            [
                'icon' => '🌦️',
                'title' => 'Public Alerts',
                'description' => 'Important public safety alerts.'
            ]
        ]
    ]);
})->name('updates');


/*
|--------------------------------------------------------------------------
| HELP CENTER
|--------------------------------------------------------------------------
*/

Route::get('/help-center', function () {
    return view('pages.standard', [
        'title' => 'Help Center',
        'number' => '09',
        'description' => 'Find guidance on using URBIX and accessing city services.',
        'features' => [
            [
                'icon' => '❓',
                'title' => 'FAQs',
                'description' => 'Find answers to common questions.'
            ],
            [
                'icon' => '📖',
                'title' => 'Guides',
                'description' => 'Learn how to use URBIX.'
            ],
            [
                'icon' => '📞',
                'title' => 'Support',
                'description' => 'Get assistance with your account.'
            ]
        ]
    ]);
})->name('help');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('register.store');

    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.store');

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| CITIZEN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:citizen'])->group(function () {

    // Citizen Dashboard
    Route::get('/citizen-dashboard', [
        CitizenDashboardController::class,
        'index'
    ])->name('citizen.dashboard');

    // Report Problem
    Route::get('/report-problem', [
        ComplaintController::class,
        'create'
    ])->name('report');

    // Submit Complaint
    Route::post('/report-problem', [
        ComplaintController::class,
        'store'
    ])->name('report.store');

    // My Complaints
    Route::get('/my-complaints', [
        ComplaintController::class,
        'index'
    ])->name('my-complaints');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // Admin Complaint Dashboard
        Route::get('/panel', [
            AdminComplaintController::class,
            'index'
        ])->name('admin.complaints.index');

        // View Complaint
        Route::get('/complaints/{id}', [
            AdminComplaintController::class,
            'show'
        ])->name('admin.complaints.show');

        // Update Complaint Status
        Route::patch('/complaints/{id}/status', [
            AdminComplaintController::class,
            'update'
        ])->name('admin.complaints.update');

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return redirect()->route('admin.complaints.index');
        })->name('admin.dashboard');

    });


/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->group(function () {

    // Staff Dashboard
    Route::get('/staff-dashboard', [
        StaffDashboardController::class,
        'index'
    ])->name('staff.dashboard');

    // Update Complaint Status
    Route::patch('/staff/complaints/{id}/status', [
        StaffDashboardController::class,
        'updateStatus'
    ])->name('staff.complaints.update');

});


/*
|--------------------------------------------------------------------------
| TEMPORARY ROLE CHECK
|--------------------------------------------------------------------------
| Used only to identify the currently logged-in account and its role.
| Remove this route after debugging.
|--------------------------------------------------------------------------
*/

Route::get('/check-role', function () {

    return response()->json([
        'logged_in' => auth()->check(),
        'user_id' => auth()->id(),
        'name' => auth()->user()?->name,
        'email' => auth()->user()?->email,
        'role' => auth()->user()?->role,
    ]);

});