<?php

use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\TweetAssignment;
use App\Models\TweetUpdate;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // houses - categories
        $houses = collect([
            ['id' => 1, 'name' => 'Тестовая категория', 'max_money' => 1000, 'money_per_hour' => 110],
            ['id' => 2, 'name' => 'Bitcoin Cash', 'max_money' => 2000, 'money_per_hour' => 120],
            ['id' => 3, 'name' => 'Microsoft', 'max_money' => 3300, 'money_per_hour' => 130],
            ['id' => 4, 'name' => 'ICO Бомжкоин', 'max_money' => 300, 'money_per_hour' => 140],
            ['id' => 5, 'name' => 'Скромная компания', 'max_money' => 1000, 'money_per_hour' => 150]
        ]);
        $houses->each(function ($item) {
            $row = House::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new House;
            }
            $row->fill($item);
            $row->save();
        });

        // tweets
        $tweets = collect([
            ['id' => 1, 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 2, 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 3, 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. ']
        ]);
        $tweets->each(function ($item) {
            $row = Tweet::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Tweet;
            }
            $row->fill($item);
            $row->save();
        });

        // tweet assignments to categories
        $tweetAssignments = collect([
            ['id' => 1, 'tweet_id' => 1, 'house_id' => 1],
            ['id' => 2, 'tweet_id' => 1, 'house_id' => 2],
            ['id' => 3, 'tweet_id' => 2, 'house_id' => 2],
            ['id' => 4, 'tweet_id' => 3, 'house_id' => 3]
        ]);
        $tweetAssignments->each(function ($item) {
            $row = TweetAssignment::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new TweetAssignment;
            }
            $row->fill($item);
            $row->save();
        });

        // tweet updates
        $tweetUpdates = collect([
            ['id' => 1, 'tweet_id' => 1, 'update_type_id' => 1, 'value' => 100],
            ['id' => 2, 'tweet_id' => 2, 'update_type_id' => 2, 'value' => 500],
            ['id' => 3, 'tweet_id' => 3, 'update_type_id' => 1, 'value' => 150]
        ]);
        $tweetUpdates->each(function ($item) {
            $row = TweetUpdate::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new TweetUpdate;
            }
            $row->fill($item);
            $row->save();
        });

        // static pages
        $pages = collect([
            ['id' => 1, 'alias' => 'about', 'content' => '<h1>Lorem ipsum dolor sit amet, consectetur</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
            Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
            quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
            nec egestas lorem lobortis.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
            Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
            quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
            nec egestas lorem lobortis.</p>
            <h2>Lorem ipsum dolor sit amet, consectetur</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
            Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
            quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
            nec egestas lorem lobortis.</p>'],
            ['id' => 2, 'alias' => 'rules', 'content' => '<h1>Lorem ipsum dolor sit amet, consectetur</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
            Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
            quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
            nec egestas lorem lobortis.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
            Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
            quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
            nec egestas lorem lobortis.</p>']
        ]);
        $pages->each(function ($item) {
            $row = Page::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Page;
            }
            $row->fill($item);
            $row->save();
        });
    }
}
