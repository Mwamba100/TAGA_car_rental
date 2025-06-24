<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    PaymentController,
    CarController,
    CommentController,
    BookingController
};
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => view('index'));
Route::get('/admin', fn() => view('adminPanel'));
Route::get('admin/signup', fn() => view('register'));
Route::get('/login', fn() => view('signin'));
Route::get('/register', fn() => view('signup'));

// Authentication
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
    // Add logout if implemented
    // Route::post('/logout', [AuthController::class, 'logout']);
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

// Admin Registration (public, not protected)
Route::post('/admin/register', [AuthController::class, 'registerAdmin']);

// Routes requiring authentication
Route::middleware('auth')->group(function () {

    // Admin-only management
    Route::middleware('can:admin')->group(function () {
        // User Management
        Route::apiResource('users', UserController::class)->except(['create', 'edit', 'store']);
        Route::post('/users/{user}/ban', [UserController::class, 'banUser']);
        Route::post('/users/{user}/unban', [UserController::class, 'unbanUser']);
        Route::get('/users/{user}/cars', [UserController::class, 'userCars']);
        Route::get('/users/{user}/reviews', [UserController::class, 'userReviews']);
        Route::get('/users/{user}/rentals', [UserController::class, 'userRentals']);
        Route::get('/users/{user}/comments', [UserController::class, 'userComments']);
        Route::post('/users/{user}/comments', [UserController::class, 'storeComment']);

        // Car Management
        Route::apiResource('cars', CarController::class)->except(['create', 'edit']);

        // Cars
        Route::get('/admin/cars', [CarController::class, 'index'])->name('admin.cars');

        // Bookings
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings');

        // Users
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    });

    // User profile & notifications
    Route::get('/user', [UserController::class, 'currentUser']);
    Route::post('/user/update-password', [UserController::class, 'updatePassword']);
    Route::post('/user/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/user/upload-avatar', [UserController::class, 'uploadAvatar']);
    Route::delete('/user/delete-avatar', [UserController::class, 'deleteAvatar']);
    Route::get('/user/notifications', [UserController::class, 'notifications']);
    Route::post('/user/notifications/mark-as-read', [UserController::class, 'markNotificationsAsRead']);
    Route::post('/user/notifications/mark-as-unread', [UserController::class, 'markNotificationsAsUnread']);
    Route::get('/user/notifications/{notification}', [UserController::class, 'showNotification']);

    // Transactions
    Route::apiResource('transactions', \App\Http\Controllers\TransactionController::class);

    // Payments
    Route::apiResource('payments', PaymentController::class);
    Route::post('/payments/{payment}/confirm', [PaymentController::class, 'confirmPayment']);
    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancelPayment']);
    Route::get('/payments/{payment}/user', [PaymentController::class, 'getPaymentUser']);
    Route::get('/payments/{payment}/transaction', [PaymentController::class, 'getPaymentTransaction']);
    Route::get('/payments/{payment}/status', [PaymentController::class, 'getPaymentStatus']);

    // Car Reviews & Comments
    Route::get('/cars/{car}/reviews', [CarController::class, 'reviews']);
    Route::post('/cars/{car}/reviews', [CarController::class, 'storeReview']);
    Route::get('/cars/{car}/reviews/{review}', [CarController::class, 'showReview']);
    Route::get('/cars/{car}/reviews/{review}/comments', [CarController::class, 'comments']);
    Route::post('/cars/{car}/reviews/{review}/comments', [CarController::class, 'storeComment']);

    // Payment page with query parameters (now secured)
    Route::get('/payment', function (\Illuminate\Http\Request $request) {
        $car = $request->query('car');
        $price = $request->query('price');
        $image = $request->query('image');
        $user = Auth::user();
        return view('payment', compact('car', 'price', 'image', 'user'));
    });

    // Process payment
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    // Car Hire (if needed)
    // Route::resource('car-hires', CarHireController::class);
});

// Complete profile form (GET and POST)
Route::middleware('auth')->group(function () {
    Route::get('/profile/complete', function () {
        return view('complete_profile');
    })->name('profile.complete');
    Route::post('/profile/complete', [UserController::class, 'updateProfile'])->name('profile.complete.submit');
});

// API route to get current user info (for JS profile check)
Route::middleware('auth')->get('/api/user-info', function () {
    return response()->json(Auth::user());
});

// Public car search and categories
Route::get('/cars/search', [CarController::class, 'search']);
Route::get('/cars/categories', [CarController::class, 'categories']);
Route::get('/cars/{car}/category', [CarController::class, 'carCategory']);
Route::get('/cars/{car}', [CarController::class, 'show']);
Route::get('/cars', [CarController::class, 'index']); //lists all cars

// Dashboard (only for authenticated users)
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
