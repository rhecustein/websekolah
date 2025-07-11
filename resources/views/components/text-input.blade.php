@props(['disabled' => false])

{{-- 
    Komponen input teks ini telah disesuaikan untuk menggunakan tema warna terang.
    - Menghapus semua class 'dark:*' untuk menghilangkan gaya dark mode.
    - Mengganti 'border-gray-300' menjadi 'border-slate-300' agar konsisten.
    - Mengganti warna focus dari 'indigo' menjadi 'sky' agar sesuai dengan tema tombol dan elemen lainnya.
    - Menambahkan 'text-slate-900' untuk warna teks default.
--}}
<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-300 text-slate-900 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm']) }}>
