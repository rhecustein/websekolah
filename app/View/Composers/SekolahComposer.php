<?php

namespace App\View\Composers;

use App\Models\Sekolah;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class SekolahComposer
{
    /**
     * The school instance.
     *
     * @var \App\Models\Sekolah
     */
    protected $sekolah;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Mengambil data sekolah dan menyimpannya di cache selamanya
        // Ini sangat efisien karena data sekolah jarang berubah.
        $this->sekolah = Cache::rememberForever('sekolah', function () {
            return Sekolah::first();
        });
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sekolah', $this->sekolah);
    }
}