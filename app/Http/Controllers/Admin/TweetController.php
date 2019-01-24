<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Tweet;
use App\Models\TweetUpdate;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        return view('admin/tweet/list', ['tweets' => Tweet::orderBy('pub_date', 'DESC')->take(40)->get()]);
    }

    public function add()
    {
        return view('admin/tweet/add', [
            'houses' => House::orderBy('id', 'ASC')->get()
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'pub_date' => 'required',
            'alias' => 'nullable|alpha_dash',
            'link' => 'nullable|alpha_dash',

            'update_type_id.*' => 'nullable|in:1,2',
            'value.*' => 'nullable|integer'
        ]);

        $tweet = new Tweet();
        $tweet->fill($request->all());
        $tweet->save();

        // houses
        $tweet->houses()->sync($request->house);

        // updates
        for ($i = 0; $i < 3; $i++) {
            if (!empty($request['update_type_id'][$i]) && !empty($request['value'][$i])) {
                // create
                $newUpdate = new TweetUpdate();
                $newUpdate->tweet_id = $tweet->id;
                $newUpdate->update_type_id = $request['update_type_id'][$i];
                $newUpdate->value = $request['value'][$i];
                $newUpdate->save();
            }
        }

        session()->flash('success-message', 'Твит успешно добавлен');

        return redirect(route('admin-tweet'));
    }

    public function edit($tweet_id)
    {
        $tweet = Tweet::where('id', $tweet_id)->first();

        if (empty($tweet)) {
            abort(403, 'Твит не найден');
        }

        return view('admin/tweet/edit', [
            'tweet' => $tweet,
            'houses' => House::orderBy('id', 'ASC')->get(),
            'updates' => $tweet->tweet_updates()->get()->toArray()
        ]);
    }

    public function update($tweet_id, Request $request)
    {
        $request->validate([
            'pub_date' => 'required',
            'alias' => 'nullable|alpha_dash',
            'link' => 'nullable|alpha_dash',

            'update_type_id.*' => 'nullable|in:1,2',
            'value.*' => 'nullable|integer'
        ]);

        $tweet = Tweet::where('id', $tweet_id)->first();

        if (empty($tweet)) {
            abort(403, 'Твит не найден');
        }

        $tweet->fill($request->all());
        $tweet->save();

        // houses
        $tweet->houses()->sync($request->house);

        // updates
        $updates = $tweet->tweet_updates;
        for ($i = 0; $i < 3; $i++) {
            $el = $updates->slice($i, 1);
            if (!empty($request['update_type_id'][$i]) && !empty($request['value'][$i])) {
                if (count($el)) {
                    // update
                    $update = $el->first();
                    $update->update_type_id = $request['update_type_id'][$i];
                    $update->value = $request['value'][$i];
                    $update->save();

                } else {
                    // create
                    $newUpdate = new TweetUpdate();
                    $newUpdate->tweet_id = $tweet->id;
                    $newUpdate->update_type_id = $request['update_type_id'][$i];
                    $newUpdate->value = $request['value'][$i];
                    $newUpdate->save();
                }
            } else {
                // delete
                if (count($el)) {
                    $update = $el->first();
                    $update->delete();
                }
            }
        }

        session()->flash('success-message', 'Твит сохранен');

        return redirect(route('admin-tweet'));
    }

    public function delete($tweet_id)
    {
        $tweet = Tweet::where('id', $tweet_id)->first();

        if (empty($tweet)) {
            abort(403, 'Твит не найден');
        }

        $tweet->delete();

        session()->flash('success-message', 'Твит удален');

        return redirect(route('admin-tweet'));
    }
}
