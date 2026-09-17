<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-SPPD Bima — Disperindag Kab. Bima</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%2300288e'/%3E%3Ctext x='16' y='21.5' font-size='13' font-weight='700' text-anchor='middle' fill='%23fff' font-family='sans-serif'%3ES%3C/text%3E%3C/svg%3E">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "royal-blue": "#2563EB",
                        "navy-900": "#0A1128",
                        "navy-800": "#162547",
                        "navy-700": "#1C315E"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans"],
                        "display-md": ["Plus Jakarta Sans"],
                        "display-sm": ["Plus Jakarta Sans"],
                        "headline-md-mobile": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md-mobile": ["20px", { "lineHeight": "28px", "fontWeight": "700", "letterSpacing": "-0.01em" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "700", "letterSpacing": "-0.01em" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-md": ["13px", { "lineHeight": "18px", "letterSpacing": "0.02em", "fontWeight": "600" }],
                        "display-lg": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.03em", "fontWeight": "800" }],
                        "display-md": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.03em", "fontWeight": "800" }]
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-modern-gradient text-white antialiased min-h-screen flex flex-col relative font-body-md">
    <!-- Decorative Overlay (fixed, tidak memengaruhi scroll) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 pattern-overlay"></div>
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-royal-blue/10 rounded-full blur-[120px] mix-blend-screen -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-500/10 rounded-full blur-[100px] mix-blend-screen translate-y-1/3 -translate-x-1/4"></div>
    </div>

    <div class="relative z-10 w-full max-w-5xl mx-auto px-4 md:px-8 flex-1 flex flex-col justify-center py-8">
        @if ($errors->any() || session('error'))
            <div class="w-full mb-4">
                <div class="glass-card rounded-2xl px-5 py-4 flex items-start gap-3 text-red-300">
                    <span class="material-symbols-outlined text-[20px] mt-0.5">error</span>
                    <div class="text-sm">
                        <strong>Gagal masuk:</strong>
                        <ul class="mt-1" style="list-style:disc;padding-left:1.1rem;">
                            @error('nip')<li>{{ $message }}</li>@enderror
                            @error('password')<li>{{ $message }}</li>@enderror
                            @if (session('error') && !$errors->any())<li>{{ session('error') }}</li>@endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="glass-card rounded-4xl overflow-hidden flex flex-col lg:flex-row w-full shadow-2xl">
            <!-- Left Side: Branding -->
            <div class="w-full lg:w-1/2 p-6 sm:p-10 md:p-14 lg:p-16 flex flex-col justify-between relative border-b lg:border-b-0 lg:border-r border-white/10">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <div class="mb-6 sm:mb-12 inline-flex items-center justify-center p-4 sm:p-5 bg-white/5 rounded-2xl border border-white/10 shadow-inner backdrop-blur-md">
                            <span class="material-symbols-outlined text-white/90" style="font-size:56px;line-height:1;">account_balance</span>
                        </div>
                        <h1 class="font-display-md text-display-md mb-6 text-white leading-tight">
                            Sistem Informasi <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-royal-blue font-extrabold">E-SPPD</span> <br>
                            Kabupaten Bima
                        </h1>
                        <p class="font-body-lg text-body-lg text-slate-300 leading-relaxed max-w-md font-light">
                            Platform digital terintegrasi untuk efisiensi administrasi, pengelolaan, dan pelaporan Surat Perintah Perjalanan Dinas.
                        </p>
                    </div>
                    <div class="hidden lg:block mt-16">
                        <div class="flex items-center gap-3 text-slate-400 text-sm">
                            <span class="material-symbols-outlined text-[18px]">security</span>
                            <span>Sistem Pemerintahan Terenkripsi &amp; Aman</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-1/2 p-6 sm:p-10 md:p-14 lg:p-16 flex flex-col justify-center relative bg-white/5 backdrop-blur-lg">
                <div class="w-full max-w-sm mx-auto relative z-10">
                    <div class="mb-8 sm:mb-10 text-center lg:text-left">
                        <h2 class="text-[26px] sm:text-[28px] font-bold text-white mb-2 tracking-tight">Selamat Datang</h2>
                        <p class="font-body-md text-body-md text-slate-400">Silakan masuk menggunakan NIP Anda.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <!-- NIP Input -->
                        <div>
                            <label class="block font-label-md text-label-md text-slate-300 mb-2" for="nip">NIP (Nomor Induk Pegawai)</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-royal-blue transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">badge</span>
                                </span>
                                <input class="glass-input block w-full pl-12 pr-4 py-3.5 rounded-xl text-white font-body-md text-body-md transition-all outline-none @error('nip') !border-red-400 @enderror"
                                       id="nip" name="nip" placeholder="Masukkan NIP Anda" value="{{ old('nip') }}" autocomplete="username" required autofocus>
                            </div>
                        </div>
                        <!-- Password Input -->
                        <div>
                            <label class="block font-label-md text-label-md text-slate-300 mb-2" for="password">Password</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-royal-blue transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">lock</span>
                                </span>
                                <input class="glass-input block w-full pl-12 pr-12 py-3.5 rounded-xl text-white font-body-md text-body-md transition-all outline-none @error('password') !border-red-400 @enderror"
                                       id="password" name="password" placeholder="Masukkan Password" autocomplete="current-password" required type="password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-white transition-colors focus:outline-none" id="togglePassword" aria-label="Tampilkan password">
                                    <span class="material-symbols-outlined text-[20px]" id="visibilityIcon">visibility</span>
                                </button>
                            </div>
                        </div>
                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-1">
                            <div class="flex items-center group cursor-pointer">
                                <div class="relative flex items-center justify-center">
                                    <input class="peer h-4 w-4 bg-white/10 border-white/20 rounded focus:ring-royal-blue focus:ring-offset-navy-900 transition-all cursor-pointer appearance-none border checked:border-royal-blue checked:bg-royal-blue" id="remember-me" name="remember" type="checkbox">
                                    <span class="material-symbols-outlined text-white text-[14px] absolute pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity">check</span>
                                </div>
                                <label class="ml-2 block font-body-md text-sm text-slate-300 cursor-pointer group-hover:text-white transition-colors" for="remember-me">Ingat saya</label>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl bg-royal-blue text-white font-label-md text-[15px] hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-royal-blue/40 transition-all shadow-lg hover:-translate-y-0.5 active:scale-[0.98] border border-blue-500/50">
                                <span>Masuk ke Sistem</span>
                                <span class="material-symbols-outlined text-[20px]">login</span>
                            </button>
                        </div>
                    </form>
                    <div class="mt-8 text-center text-xs text-slate-400/80">
                        Akun demo admin: <code class="text-blue-300">197001012000031001</code> &middot; sandi <code class="text-blue-300">password</code>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="mt-6 sm:mt-10 text-center w-full z-10 text-slate-400/60 font-body-md text-xs tracking-wide">
            <p>Copyright &copy; {{ date('Y') }} Pemerintah Kabupaten Bima. All rights reserved.</p>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const visibilityIcon = document.querySelector('#visibilityIcon');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            visibilityIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });
    </script>
</body>
</html>
