<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Your Profile | TAGA Car Rentals</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-form {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .profile-form label { font-weight: 500; margin-top: 10px; }
        .profile-form input, .profile-form select {
            width: 100%; padding: 8px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;
        }
        .profile-form button { width: 100%; }
    </style>
</head>
<body>
    <div class="profile-form">
        <h2>Complete Your Profile</h2>
        <form method="POST" action="{{ url('/profile/complete') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name ?? '') }}" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>

            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address ?? '') }}" required>

            <label for="nrc_no">NRC No</label>
            <input type="text" name="nrc_no" id="nrc_no" value="{{ old('nrc_no', Auth::user()->nrc_no ?? '') }}" required>

            <label for="company">Company</label>
            <input type="text" name="company" id="company" value="{{ old('company', Auth::user()->company ?? '') }}" required>

            <label for="job_title">Job Title</label>
            <input type="text" name="job_title" id="job_title" value="{{ old('job_title', Auth::user()->job_title ?? '') }}" required>

            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', Auth::user()->birth_date ?? '') }}" required min="{{ \Carbon\Carbon::now()->subYears(100)->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">

            <label for="city">City</label>
            <input type="text" name="city" id="city" value="{{ old('city', Auth::user()->city ?? '') }}" required>

            <label for="state">State</label>
            <input type="text" name="state" id="state" value="{{ old('state', Auth::user()->state ?? '') }}" required>

            <label for="country">Country</label>
            <input type="text" name="country" id="country" value="{{ old('country', Auth::user()->country ?? '') }}" required>

            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', Auth::user()->postal_code ?? '') }}" required>

            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            @if(Auth::user()->profile_picture)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Profile Picture" style="max-width:100px;">
                </div>
            @endif

            <button type="submit" class="btn">Save & Continue</button>
        </form>
        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>