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
            ['id' => 1, 'name' => 'Тестовая категория',
                'ico' => 'img/header/news/logo_bitcoin.svg',
                'image' => 'img/houses/house_1.png',
                'image_small' => 'img/houses/house_1_icon.png',
                'max_money' => 1000, 'money_per_hour' => 110],
            ['id' => 2, 'name' => 'Bitcoin Cash',
                'ico' => 'img/header/news/logo_bitcoin.svg',
                'image' => 'img/houses/house_2.png',
                'image_small' => 'img/houses/house_2_icon.png',
                'max_money' => 2000, 'money_per_hour' => 120],
            ['id' => 3, 'name' => 'Microsoft',
                'ico' => 'img/header/news/logo_bitcoin.svg',
                'image' => 'img/houses/house_3.png',
                'image_small' => 'img/houses/house_3_icon.png',
                'max_money' => 3300, 'money_per_hour' => 130],
            ['id' => 4, 'name' => 'ICO Бомжкоин',
                'ico' => 'img/header/news/logo_bitcoin.svg',
                'image' => 'img/houses/house_4.png',
                'image_small' => 'img/houses/house_4_icon.png',
                'max_money' => 300, 'money_per_hour' => 140],
            ['id' => 5, 'name' => 'Скромная компания',
                'ico' => 'img/header/news/logo_bitcoin.svg',
                'image' => 'img/houses/house_5.png',
                'image_small' => 'img/houses/house_5_icon.png',
                'max_money' => 1000, 'money_per_hour' => 150]
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
            ['id' => 1,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => 'https://google.com',
                'alias' => null,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 2,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => null,
                'alias' => null,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 3,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => null,
                'alias' => 'test1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 4,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => null,
                'alias' => null,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 5,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => 'https://google.com',
                'alias' => null,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 6,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => null,
                'alias' => 'test1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             Etiam porttitor neque a turpis dignissim, vitae fringilla nisl sodales.
             Suspendisse pretium, lacus vitae posuere facilisis, tortor turpis condimentum magna,
             quis pellentesque mauris nunc quis tortor. Nullam ultricies arcu nec arcu finibus,
             nec egestas lorem lobortis. '],
            ['id' => 7,
                'title' => 'Тестовый заголовок h1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'link' => null,
                'alias' => null,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
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
            ['id' => 4, 'tweet_id' => 3, 'house_id' => 3],
            ['id' => 5, 'tweet_id' => 4, 'house_id' => 3],
            ['id' => 6, 'tweet_id' => 5, 'house_id' => 3],
            ['id' => 7, 'tweet_id' => 6, 'house_id' => 3],
            ['id' => 8, 'tweet_id' => 7, 'house_id' => 3]
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
            ['id' => 1, 'alias' => 'about', 'content' => '<h2>Lorem ipsum dolor sit amet, consectetur</h2>
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
            ['id' => 2, 'alias' => 'rules', 'content' => '<h2>Lorem ipsum dolor sit amet, consectetur</h2>
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
