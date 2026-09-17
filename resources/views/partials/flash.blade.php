@if (session('success'))
    <div class="alert bg-secondary/10 border border-secondary/30 text-[#005236] rounded-xl px-5 py-4 flex items-start gap-3" role="alert">
        <span class="material-symbols-outlined text-[20px] mt-0.5">check_circle</span>
        <span class="text-sm flex-1">{{ session('success') }}</span>
        <button type="button" class="x opacity-60 hover:opacity-100 text-lg leading-none bg-transparent border-0 cursor-pointer" aria-label="Tutup">&times;</button>
    </div>
@endif
@if (session('error'))
    <div class="alert bg-error-container border border-error/30 text-on-error-container rounded-xl px-5 py-4 flex items-start gap-3" role="alert">
        <span class="material-symbols-outlined text-[20px] mt-0.5">error</span>
        <span class="text-sm flex-1">{{ session('error') }}</span>
        <button type="button" class="x opacity-60 hover:opacity-100 text-lg leading-none bg-transparent border-0 cursor-pointer" aria-label="Tutup">&times;</button>
    </div>
@endif
@if ($errors->any())
    <div class="alert bg-error-container border border-error/30 text-on-error-container rounded-xl px-5 py-4 flex items-start gap-3" role="alert">
        <span class="material-symbols-outlined text-[20px] mt-0.5">warning</span>
        <div class="text-sm flex-1">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-1" style="list-style:disc;padding-left:1.1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="x opacity-60 hover:opacity-100 text-lg leading-none bg-transparent border-0 cursor-pointer" aria-label="Tutup">&times;</button>
    </div>
@endif
