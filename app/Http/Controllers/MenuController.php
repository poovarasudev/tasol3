<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public $baseViewDirectory = 'menus.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->baseViewDirectory . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->baseViewDirectory . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        try {
            $input = $request->only('name', 'for', 'order_type', 'bill_type', 'price');
            Menu::create($input);
            return redirect('/menus')->with('success', 'Menu Created Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/menus')->with('error', 'Unable to Create Menu!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view($this->baseViewDirectory . 'edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $input = $request->only('name', 'for', 'order_type', 'bill_type', 'price');
            $menu->update($input);
            return redirect('/menus')->with('success', 'Menu Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/menus')->with('error', 'Unable to Update Menu Details!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return response()->json(['action' => 'success', 'message' => 'Menu Deleted Successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete Menu'], 500);
        }
    }

    /**
     * Get Users list for Datatable
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getMenus(Request $request)
    {
        return DataTables::eloquent(Menu::orderBy('for'))
            ->addColumn('action', function ($menu) {
                $button = '';
                if (auth()->user()->can('menus.edit')) {
                    $button .= editButton(route("menus.edit", $menu->id));
                }
                if (auth()->user()->can('menus.delete')) {
                    $button .= deleteButton(route("menus.delete", $menu->id), $menu->name);
                }
                $button = ($button != '') ? $button : '-';
                return '<div class="form-inline justify-content-center">' . $button . '</div>';
            })
            ->make(true);
    }
}
