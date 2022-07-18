<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tariffs = Tariff::all();
        return view('tariffs.index', compact('tariffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tariffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        function tariffCreate($title, $name, $content, $develop, $design, $context)
        {
            $tariff = new Tariff();
            $tariff->name = $name;
            $tariff->title = $title;
            $tariff->content = $content . ' часов';
            $tariff->develop = $develop . ' часов';
            $tariff->design = $design . ' часов';
            $tariff->context = $context;
            if ($tariff->save()) {
                return redirect()->route('tariff.index')->with('message', 'Запись была добавленна');
            }
        }

        switch ($request->tariff) {

            case 1:
                tariffCreate($request->title, 'Метеорит', '1', '0', '0', 'Нет');
                break;
            case 2:
                tariffCreate($request->title, 'Астероид', '4', '1', '0', 'Нет');
                break;
            case 3:
                tariffCreate($request->title, 'Комета', '8', '2', '0', 'Нет');
                break;
            case 4:
                tariffCreate($request->title, 'Спутник', '24', '6', '2', 'Нет');
                break;
            case 5:
                tariffCreate($request->title, 'Планета', '48', '12', '6', 'Да');
                break;
        }
        return redirect()->route('tariff.index')->with('message', 'Запись была добавленна');
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
        $tariff = Tariff::find($id);
        return view('tariffs.edit', compact('tariff'));
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

        function tariffUpdate($id, $title, $name, $content, $develop, $design, $context)
        {
            $tariff = Tariff::find($id);
            $tariff->name = $name;
            $tariff->title = $title;
            $tariff->content = $content . ' часов';
            $tariff->develop = $develop . ' часов';
            $tariff->design = $design . ' часов';
            $tariff->context = $context;
            if ($tariff->save()) {
                return redirect()->route('tariff.index')->with('message', 'Запись была добавленна');
            }
        }

        switch ($request->tariff) {

            case 1:
                tariffUpdate($id, $request->title, 'Метеорит', '1', '0', '0', 'Нет');
                break;
            case 2:
                tariffUpdate($id, $request->title, 'Астероид', '4', '1', '0', 'Нет');
                break;
            case 3:
                tariffUpdate($id, $request->title, 'Комета', '8', '2', '0', 'Нет');
                break;
            case 4:
                tariffUpdate($id, $request->title, 'Спутник', '24', '6', '2', 'Нет');
                break;
            case 5:
                tariffUpdate($id, $request->title, 'Планета', '48', '12', '6', 'Да');
                break;
        }
        return redirect()->route('tariff.index')->with('message', 'Запись была обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tariff::destroy($id);
        return redirect()->route('tariff.index')->with('message', 'Запись была удалена');
    }
}
