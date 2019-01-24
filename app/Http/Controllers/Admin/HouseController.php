<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index() {
        return view('admin/house/list', ['houses' => House::orderBy('id', 'DESC')->get()]);
    }

    public function add()
    {
        return view('admin/house/add');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'money_per_hour' => 'required|integer',
            'max_money' => 'required|integer'
        ]);

        $house = new House();
        $house->fill($request->all());
        $house->save();

        session()->flash('success-message', 'Домик успешно добавлен');

        return redirect(route('admin-house'));
    }

    public function edit($house_id)
    {
        $house = House::where('id', $house_id)->first();

        if (empty($house)) {
            abort(403, 'Домик не найден');
        }

        return view('admin/house/edit', [
            'house' => $house
        ]);
    }

    public function update($house_id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'money_per_hour' => 'required|integer',
            'max_money' => 'required|integer'
        ]);

        $house = House::where('id', $house_id)->first();

        if (empty($house)) {
            abort(403, 'Домик не найден');
        }

        $house->fill($request->all());
        $house->save();

        session()->flash('success-message', 'Домик сохранен');

        return redirect(route('admin-house'));
    }

    public function delete($house_id)
    {
        $house = House::where('id', $house_id)->first();

        if (empty($house)) {
            abort(403, 'Домик не найден');
        }

        $house->delete();

        session()->flash('success-message', 'Домик удален');

        return redirect(route('admin-house'));
    }
}
