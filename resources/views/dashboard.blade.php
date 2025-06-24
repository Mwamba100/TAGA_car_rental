<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | TAGA Car Rentals</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h2>Welcome, {{ Auth::user()->name ?? 'User' }}</h2>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </nav>
    </header>
    <main>
        <h3>Your Dashboard</h3>
        <ul>
            <li>
                <strong>Profile Picture:</strong><br>
                <div style="background:#fff;padding:10px;display:inline-block;border-radius:10px;box-shadow:0 0 8px rgba(0,0,0,0.05);margin-bottom:10px;">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Profile Picture" style="max-width:120px;max-height:120px;border-radius:8px;">
                @else
                    <span>No profile picture uploaded.</span>
                @endif
                </div>
            </li>
            <li><strong>Name:</strong> {{ Auth::user()->name ?? '' }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email ?? '' }}</li>
            <li><strong>Registered At:</strong> {{ Auth::user()->created_at ? Auth::user()->created_at->format('F d, Y') : '' }}</li>
            <li><strong>Last Updated:</strong> {{ Auth::user()->updated_at ? Auth::user()->updated_at->format('F d, Y H:i') : '' }}</li>
            <li><strong>City:</strong> {{ Auth::user()->city ?? '' }}</li>
            <!-- Example: Add more widgets or stats below -->
            {{-- <li><strong>Total Rentals:</strong> {{ Auth::user()->rentals()->count() }}</li> --}}
            {{-- <li><strong>Account Status:</strong> {{ Auth::user()->is_active ? 'Active' : 'Inactive' }}</li> --}}
        </ul>
    </main>
</body>
</html>