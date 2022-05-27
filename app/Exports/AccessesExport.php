<?php

namespace App\Exports;

use App\Models\Access;
// use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AccessesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.accesses', [
            'accesses' => Access::where('status', '1')->get()
        ]);
    }
}
