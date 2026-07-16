<nav class="navbar" style="background-color: #1a202c; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
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