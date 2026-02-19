<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abir's FoodCourt - Professional Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* --- LEFT SIDE: WIDE IMAGE AREA --- */
        .left-side {
            position: relative;
            flex: 1.4;
            height: 100vh;
            background-color: #f8f8f8;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            object-position: center;
        }

        .left-side::after{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(180deg, rgba(0,0,0,.05), rgba(0,0,0,.12));
            pointer-events:none;
        }

        /* --- RIGHT SIDE: REGISTER FORM --- */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 28px;
            box-shadow: -5px 0 20px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 360px;
            position: relative;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo h1 {
            font-family: 'Poppins', sans-serif;
            color: #222;
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 4px;
            letter-spacing: -1px;
        }

        .brand-logo h1 span {
            color: #ff7f50;
        }

        /* Success Message Styling */
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            text-align: left;
            border: 1px solid #c3e6cb;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            z-index: 1000;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #f1f1f1;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: 0.3s;
            background-color: #fafafa;
        }

        .form-group input:focus {
            border-color: #ff7f50;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(255, 127, 80, 0.1);
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #ff7f50, #ff6333);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 8px 15px rgba(255, 99, 51, 0.2);
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(255, 99, 51, 0.3);
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .auth-footer a {
            color: #ff7f50;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            .left-side { flex: 1; height: 100vh; }
            .right-side { flex: 1.2; height: 100vh; }
        }
        @media (max-height: 800px) {
            .brand-logo h1 { font-size: 24px; }
            .auth-wrapper { max-width: 340px; }
            .form-group input, .form-group select { padding: 11px 14px; font-size: 13.5px; }
            .register-btn { padding: 13px; font-size: 14.5px; }
            .right-side { padding: 24px; }
        }
        @media (max-height: 700px) {
            .brand-logo h1 { font-size: 22px; }
            .auth-wrapper { max-width: 330px; }
            .form-group { margin-bottom: 10px; }
            .form-group input, .form-group select { padding: 10px 12px; font-size: 13px; border-radius: 7px; }
            .register-btn { padding: 12px; font-size: 14px; }
            .right-side { padding: 20px; }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="left-side">
            <img src="{{ asset('assets/images/Login-Logo.PNG') }}" alt="Abir's FoodCourt Banner">
        </div>

        <div class="right-side">
            <div class="auth-wrapper">

                <div class="brand-logo">
                    <h1>Register <span>Now</span></h1>
                </div>

                @if (session('status'))
                    <div id="reg-success" class="alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        @error('email')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" required style="width:100%;padding:14px 18px;border:2px solid #f1f1f1;border-radius:10px;background:#fafafa;">
                            <option value="">Select role</option>
                            <option value="Admin" {{ old('role')=='Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Manager" {{ old('role')=='Manager' ? 'selected' : '' }}>Manager</option>
                            <option value="Cashier" {{ old('role')=='Cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="Kitchen Staff" {{ old('role')=='Kitchen Staff' ? 'selected' : '' }}>Kitchen Staff</option>
                        </select>
                        @error('role')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Create password" required>
                        @error('password')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                    </div>

                    <button type="submit" class="register-btn">CREATE ACCOUNT</button>
                </form>
                @if (session('status'))
                <script>
                    setTimeout(function(){ var el=document.getElementById('reg-success'); if(el){ el.style.opacity='0'; setTimeout(function(){ el.remove(); },300); } }, 2500);
                </script>
                @endif

                <div class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
