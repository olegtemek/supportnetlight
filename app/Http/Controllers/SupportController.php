<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Exports\SupportsExport;
use Maatwebsite\Excel\Facades\Excel;




class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supports = Support::where('status', '1')->get();
        if (!empty($supports)) {
            $supportArrayEnds = [];
            foreach ($supports as $support) {
                $date = $support->support_end;
                $d1 = strtotime($date); // переводит из строки в дату
                $date2 = date("d-m-Y", $d1); // переводит в новый формат

                $now = date("d-m-Y", strtotime('+3 days')); // Прибавляем к сегодняшней дате +3


                if (strtotime($now) > strtotime($date2)) { // Если совпало то в массив, из него всплывашка
                    array_push($supportArrayEnds, $support);
                }
            }

            return view('supports.index', ['supports' => $supports, 'supportsEnds' => $supportArrayEnds]);
        }
        return view('supports.index', ['supports' => $supports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|',
            'name' => 'required',
            'number' => 'required',
            'support_end' => 'required',
        ]);
        $support = new Support();
        $support->name = $request->name;
        $support->title = $request->title;
        $support->number = $request->number;
        $support->support_end = $request->support_end;
        $support->completed = $request->completed;
        $support->status = 1;
        if ($support->save()) {
            return redirect()->route('support.index')->with('message', 'Запись была добавленна');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $support = Support::where('id', $id)->first();
        return view('supports.edit', ['support' => $support]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|',
            'name' => 'required',
            'number' => 'required',
            'support_end' => 'required',
        ]);
        $support = Support::where('id', $id)->first();
        $support->name = $request->name;
        $support->title = $request->title;
        $support->number = $request->number;
        $support->support_end = $request->support_end;
        $support->completed = $request->completed;
        if ($support->save()) {
            return redirect()->route('support.index')->with('message', 'Запись была изменена');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $support = Support::where('id', $id)->first();
        $support->status = 0;
        $support->save();
        return redirect()->route('support.index')->with('message', 'Запись была изменена');
    }

    public function deleted()
    {
        $supports = Support::where('status', 0)->get();
        return view('supports.deleted', ['supports' => $supports]);
    }
    public function restore($id)
    {
        $support = Support::where('id', $id)->first();
        $support->status = 1;
        $support->save();
        return redirect()->route('support.deleted')->with('message', 'Тех. поддержка на этот сайт была восстановлена');
    }
    public function search(Request $request)
    {
        $search = Support::where('status', '1')->get();

        if ($request->search != '') {
            $search = Support::where('title', 'Like', '%' . $request->search . '%')->where('status', '1')->get();
            $outSupports = '';

            foreach ($search as $searches) {
                $outSupports .=
                    '<tr>
                    <td>' . $searches->id . '</td>
                    <td>' . $searches->title . '</td>
                    <td>' . $searches->name . '</td>
                    <td>' . $searches->number . '</td>
                    <td style="word-wrap: break-word;max-width: 160px;" >' . $searches->completed . '</td>
                    <td>' . $searches->support_end . '</td>
                    <td>
                    ' . '
                         <a class="btn btn-success" href=" ' . route('support.edit', $searches->id) . '"><i class="fas fa-pen"></i></a>
                         ' . '
                         <form  style="display: inline" action="' . route('support.destroy', $searches->id) . '"method="POST">
                         ' . method_field('delete') . csrf_field() . '
                         <button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button>
                         </form>
                     ' . '
                    </td>
                    </tr>';
            }

            return response($outSupports);
        } else {

            $search = Support::where('status', '1')->get();
            $outSupports = '';

            foreach ($search as $searches) {
                $outSupports .=
                    '<tr>
                    <td>' . $searches->id . '</td>
                    <td>' . $searches->title . '</td>
                    <td>' . $searches->name . '</td>
                    <td>' . $searches->number . '</td>
                    <td style="word-wrap: break-word;max-width: 160px;" >' . $searches->completed . '</td>
                    <td>' . $searches->support_end . '</td>
                    <td>
                    ' . '
                         <a class="btn btn-success" href=" ' . route('support.edit', $searches->id) . '"><i class="fas fa-pen"></i></a>
                         ' . '
                         <form  style="display: inline" action="' . route('support.destroy', $searches->id) . '"method="POST">
                         ' . method_field('delete') . csrf_field() . '
                         <button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button>
                         </form>
                     ' . '
                    </td>
                    </tr>';
            }

            return response($outSupports);
        }
    }

    public function export()
    {
        return Excel::download(new SupportsExport, 'supports.xlsx');
    }
}
