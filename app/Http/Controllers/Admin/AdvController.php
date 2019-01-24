<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adv;
use Illuminate\Http\Request;

class AdvController extends Controller
{
    public function index() {
        return view('admin/adv/list', ['advs' => Adv::orderBy('id', 'DESC')->get()]);
    }

    public function add()
    {
        return view('admin/adv/add');
    }

    public function save(Request $request)
    {
        $adv = new Adv();
        $adv->fill($request->all());
        $adv->save();

        session()->flash('success-message', 'Рекламный блок успешно добавлен');

        return redirect(route('admin-adv'));
    }

    public function edit($adv_id)
    {
        $adv = Adv::where('id', $adv_id)->first();

        if (empty($adv)) {
            abort(403, 'Рекламный блок не найден');
        }

        return view('admin/adv/edit', [
            'adv' => $adv
        ]);
    }

    public function update($adv_id, Request $request)
    {
        $adv = Adv::where('id', $adv_id)->first();

        if (empty($adv)) {
            abort(403, 'Рекламный блок не найден');
        }

        $adv->fill($request->all());
        $adv->save();

        session()->flash('success-message', 'Рекламный блок сохранен');

        return redirect(route('admin-adv'));
    }

    public function delete($adv_id)
    {
        $adv = Adv::where('id', $adv_id)->first();

        if (empty($adv)) {
            abort(403, 'Рекламный блок не найден');
        }

        $adv->delete();

        session()->flash('success-message', 'Рекламный блок удален');

        return redirect(route('admin-adv'));
    }
}
