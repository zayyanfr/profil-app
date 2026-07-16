<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil App')</title>
</head>
<body style="background-color: #f3f4f6; font-family: sans-serif; margin: 0; padding: 0;">

    <nav class="navbar" style="background-color: #1a202c; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <a href="{{ url('/') }}" style="color:white; text-decoration:none; font-weight:bold;">
            Profil App
        </a>

        <div style="display:flex; gap:16px; align-items:center;">
            {{-- Tampilkan nama jika sudah login --}}
            @auth
                <span style="color:#21B0A7; font-size:14px;">
                    Halo, {{ auth()->user()->name }}!
                </span>

                <a href="{{ route('mahasiswas.index') }}" style="color:white; text-decoration:none; font-size:14px;">
                    Daftar Mahasiswa
                </a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:transparent; border:1px solid #21B0A7; color:#21B0A7; padding:5px 14px; border-radius:5px; cursor:pointer; font-size:13px;">
                        Logout
                    </button>
                </form>
            @endauth

            {{-- Tampilkan link login/register jika belum login --}}
            @guest
                <a href="{{ route('login') }}" style="color:white; text-decoration:none; font-size:14px;">Login</a>
                <a href="{{ route('register') }}" style="background:#21B0A7; color:white; padding:6px 14px; border-radius:5px; text-decoration:none; font-size:13px;">
                    Register
                </a>
            @endguest
        </div>
    </nav>

    <div style="max-w-4xl: mx-auto; padding: 0 20px;">
        @yield('content')
    </div>

</body>
</html>