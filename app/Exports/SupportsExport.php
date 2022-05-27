<?php

namespace App\Exports;

use App\Models\Support;
// use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SupportsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.supports', [
            'supports' => Support::where('status', '1')->get()
        ]);
    }
}
