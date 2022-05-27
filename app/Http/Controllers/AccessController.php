<?php

namespace App\Http\Controllers;

use App\Exports\AccessesExport;
use App\Models\Access;

use Illuminate\Http\Request;
use App\Exports\SupportsExport;
use Maatwebsite\Excel\Facades\Excel;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesses = Access::where('status', '1')->get();
        return view('access.index', ['accesses' => $accesses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('access.create');
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
            'link' => 'required',
            'login' => 'required',
            'pass' => 'required',
        ]);
        $access = new Access();
        $access->link = $request->link;
        $access->title = $request->title;
        $access->login = $request->login;
        $access->pass = $request->pass;
        $access->description = $request->description;
        $access->status = 1;
        if ($access->save()) {
            return redirect()->route('access.index')->with('message', 'Запись была добавленна');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access = Access::where('id', $id)->first();
        return view('access.edit', ['access' => $access]);
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
            'link' => 'required',
            'login' => 'required',
            'pass' => 'required',
        ]);
        $access = Access::where('id', $id)->first();
        $access->link = $request->link;
        $access->title = $request->title;
        $access->login = $request->login;
        $access->pass = $request->pass;
        $access->description = $request->description;
        $access->status = 1;
        if ($access->save()) {
            return redirect()->route('access.index')->with('message', 'Запись была добавленна');
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
        $access = Access::where('id', $id)->first();
        $access->status = 0;
        $access->save();
        return redirect()->route('access.index')->with('message', 'Запись была удалена');
    }


    public function deleted()
    {
        $accesses = Access::where('status', 0)->get();
        return view('access.deleted', ['accesses' => $accesses]);
    }
    public function restore($id)
    {
        $access = Access::where('id', $id)->first();
        $access->status = 1;
        $access->save();
        return redirect()->route('access.deleted')->with('message', 'Запись была восстановлена');
    }
    public function search(Request $request)
    {
        $search = Access::where('status', '1')->get();

        if ($request->search != '') {
            $search = Access::where('title', 'Like', '%' . $request->search . '%')->where('status', '1')->get();
            $outSupports = '';

            foreach ($search as $searches) {
                $outSupports .=
                    '<tr>
                    <td>' . $searches->id . '</td>
                    <td>' . $searches->title . '</td>
                    <td><a href="' . $searches->link . '" />' . $searches->link . '</td>
                    <td>' . $searches->login . '</td>
                    <td>' . $searches->pass . '</td>
                    <td>' . $searches->description . '</td>
                    <td>
                    ' . '
                         <a class="btn btn-success" href=" ' . route('access.edit', $searches->id) . '"><i class="fas fa-pen"></i></a>
                         ' . '
                         <form  style="display: inline" action="' . route('access.destroy', $searches->id) . '"method="POST">
                         ' . method_field('delete') . csrf_field() . '
                         <button type="submit" class="btn btn-danger btn-delete"><i class="far fa-trash-alt"></i></button>
                         </form>
                     ' . '
                    </td>
                    </tr>';
            }

            return response($outSupports);
        } else {

            $search = Access::where('status', '1')->get();
            $outSupports = '';

            foreach ($search as $searches) {
                $outSupports .=
                    '<tr>
                    <td>' . $searches->id . '</td>
                    <td>' . $searches->title . '</td>
                    <td><a href="' . $searches->link . '" />' . $searches->link . '</td>
                    <td>' . $searches->login . '</td>
                    <td>' . $searches->pass . '</td>
                    <td>' . $searches->description . '</td>
                    <td>
                    ' . '
                         <a class="btn btn-success" href=" ' . route('access.edit', $searches->id) . '"><i class="fas fa-pen"></i></a>
                         ' . '
                         <form  style="display: inline" action="' . route('access.destroy', $searches->id) . '"method="POST">
                         ' . method_field('delete') . csrf_field() . '
                         <button type="submit" class="btn btn-danger btn-delete"><i class="far fa-trash-alt"></i></button>
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
        return Excel::download(new AccessesExport, 'accesses.xlsx');
    }
}
