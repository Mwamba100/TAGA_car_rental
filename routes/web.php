<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    PaymentController,
    CarController,
    CommentController
};

Route::get('/', function () {
    return view('index');
});

//Admin page
Route::get('/admin', function () {
    return view('adminPanel');
});

// Public routes for authentication
Route::get('/login', function () {
    return view('signin');
});

Route::get('/register', function () {
    return view('signup');
});

// Accept car and price as query parameters for payment page
Route::get('/payment', function (\Illuminate\Http\Request $request) {
    $car = $request->query('car');
    $price = $request->query('price');
    return view('payment', compact('car', 'price'));
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Routes that require authentication
    Route::middleware('auth:sanctum')->group(function () {

    //Management APIs by admin
    Route::middleware('can:admin')->group(function () {

        //User Management
        Route::get('/users', [UserController::class, 'index']); //lists all users
        Route::get('/users/{user}', [UserController::class, 'show']); //shows a specific user
        Route::put('/users/{user}', [UserController::class, 'update']); //updates a specific user
        Route::delete('/users/{user}', [UserController::class, 'destroy']); //deletes a specific user
        Route::post('/users/{user}/ban', [UserController::class, 'banUser']); //bans a specific user
        Route::post('/users/{user}/unban', [UserController::class, 'unbanUser']); //unbans a specific user
        Route::get('/users/{user}/cars', [UserController::class, 'userCars']); //lists all cars owned by a specific user
        Route::get('/users/{user}/reviews', [UserController::class, 'userReviews']); //lists all reviews made by a specific user
        Route::get('/users/{user}/rentals', [UserController::class, 'userRentals']); //lists all rentals made by a specific user
        Route::get('/users/{user}/comments', [UserController::class, 'userComments']); //lists all comments made by a specific user
        Route::post('/users/{user}/comments', [UserController::class, 'storeComment']); //creates a new comment for a specific user

        //Car Management
        Route::get('/cars', [CarController::class, 'index']); //lists all cars
        Route::get('/cars/{car}', [CarController::class, 'show']); //shows a specific car
        Route::get('/car/create', [CarController::class, 'create']); //shows a form to create a new car
        Route::post('/cars/store', [CarController::class, 'store']); //creates a new car
        Route::put('/cars/{car}', [CarController::class, 'update']); //updates a specific car
        Route::delete('/cars/{car}', [CarController::class, 'destroy']); //deletes a specific car
        Route::put('/cars/{car}', [CarController::class, 'update']);
        Route::delete('/cars/{car}', [CarController::class, 'destroy']);

        // Payment Management


        //Transaction Management
    });
    // End of admin APIs

    // Uer-based APIs
    Route::get('/user', [UserController::class, 'currentUser']); // Get current authenticated user
    Route::post('/user/update-password', [UserController::class, 'updatePassword']);
    Route::post('/user/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/user/upload-avatar', [UserController::class, 'uploadAvatar']);
    Route::delete('/user/delete-avatar', [UserController::class, 'deleteAvatar']);
    Route::get('/user/notifications', [UserController::class, 'notifications']);
    Route::post('/user/notifications/mark-as-read', [UserController::class, 'markNotificationsAsRead']);
    Route::post('/user/notifications/mark-as-unread', [UserController::class, 'markNotificationsAsUnread']);
    Route::get('/user/notifications/{notification}', [UserController::class, 'showNotification']);
    

    // Transactions
    Route::get('/transactions', [UserController::class, 'transactions']);
    Route::get('/transactions/{transaction}', [UserController::class, 'showTransaction']);
    Route::post('/transactions', [UserController::class, 'storeTransaction']);
    Route::put('/transactions/{transaction}', [UserController::class, 'updateTransaction']);
    Route::delete('/transactions/{transaction}', [UserController::class, 'destroyTransaction']);    

    //Payments
    Route::get('/payments', [PaymentController::class, 'payments']);
    Route::get('/payments/{payment}', [PaymentController::class, 'showPayment']);
    Route::post('/payments', [PaymentController::class, 'storePayment']);
    Route::put('/payments/{payment}', [PaymentController::class, 'updatePayment']);
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroyPayment']);
    Route::post('/payments/{payment}/confirm', [PaymentController::class, 'confirmPayment']);
    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancelPayment']);
    Route::get('/payments/{payment}/user', [PaymentController::class, 'getPaymentUser']);
    Route::get('/payments/{payment}/transaction', [PaymentController::class, 'getPaymentTransaction']);
    Route::get('/payments/{payment}/status', [PaymentController::class, 'getPaymentStatus']);

    // Public routes for cars and reviews
    Route::get('/cars/search', [CarController::class, 'search']); //search for cars
    Route::get('/cars/categories', [CarController::class, 'categories']); //list all car categories
    Route::get('/cars/{car}/category', [CarController::class, 'carCategory']); //get category of a specific car
    Route::get('/cars/{car}/reviews', [CarController::class, 'reviews']);
    Route::post('/cars/{car}/reviews', [CarController::class, 'storeReview']);
    Route::get('/cars/{car}/reviews/{review}', [CarController::class, 'showReview']);
    Route::get('/cars/{car}/reviews/{review}/comments', [CarController::class, 'comments']);
    Route::post('/cars/{car}/reviews/{review}/comments', [CarController::class, 'storeComment']);

    // Car Management
    Route::get('/cars', [CarController::class, 'index']); //lists all cars
    Route::get('/cars/{car}', [CarController::class, 'show']); //shows a specific car
 
    // Car Hires
    Route::get('/car-hires', [CarController::class, 'carHires']); //lists all bank transfers
    Route::get('/car-hires/{car-hired}', [CarController::class, 'carHires']); //shows a specific bank transfer
    Route::get('/car-hire/hire', [CarController::class, 'carHire']); //shows a form to hire a car
    Route::post('/car-hire/{hire}', [CarController::class, 'carHire']); //submits a car hire request
    Route::put('/car-hire/{update}', [CarController::class, 'updateCarHire']); //updates a car hire request
    Route::delete('/car-hire/{delete}', [CarController::class, 'deleteCarHire']); //deletes a car hire request
});
