<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adv;
use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\TweetAssignment;
use App\Models\TweetUpdate;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController extends Controller
{
    public function index() {
        return view('admin.loader');
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function update(Request $request) {

        if ($request['password'] != '123123') {
            abort('404');
        }

        if (!empty($request['datafile'])) {
            $path = $request->file('datafile')->storeAs('excel', 'admin.xlsx');

            $spreadsheet = IOFactory::load(base_path().'/storage/app/'.$path);

            // домики
            $this->loadHouses($spreadsheet);
            // твиты
            $this->loadTweets($spreadsheet);
            // категории твитов
            $this->loadTweetAssignments($spreadsheet);
            // апгрейды домиков
            $this->loadTweetUpdates($spreadsheet);
            // статичные странциы
            $this->loadStaticPages($spreadsheet);
            // реклама
            $this->loadAdv($spreadsheet);

            session()->flash('success-message', 'Data loaded successfully');
        }

        return redirect(route('admin'));
    }

    private function loadHouses($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'name' => $worksheet->getCell('C'.$i)->getValue(),
                'ico' => $worksheet->getCell('T'.$i)->getValue(),
                'image' => $worksheet->getCell('L'.$i)->getValue(),
                'image_small' => $worksheet->getCell('P'.$i)->getValue(),
                'max_money' => $worksheet->getCell('G'.$i)->getValue(),
                'money_per_hour' => $worksheet->getCell('I'.$i)->getValue(),
                'title' => $worksheet->getCell('X'.$i)->getValue(),
                'description' => $worksheet->getCell('Z'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $houses = collect($items);
        $houses->each(function ($item) {
            $row = House::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new House;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }

    private function loadTweets($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(1);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'title' => $worksheet->getCell('C'.$i)->getValue(),
                'description' => $worksheet->getCell('F'.$i)->getValue(),
                'link' => $worksheet->getCell('I'.$i)->getValue(),
                'alias' => $worksheet->getCell('L'.$i)->getValue(),
                'content' => $worksheet->getCell('N'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $tweets = collect($items);
        $tweets->each(function ($item) {
            $row = Tweet::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Tweet;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }

    private function loadTweetAssignments($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(2);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'tweet_id' => $worksheet->getCell('D'.$i)->getValue(),
                'house_id' => $worksheet->getCell('F'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $tw = collect($items);
        $tw->each(function ($item) {
            $row = TweetAssignment::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new TweetAssignment;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }

    private function loadTweetUpdates($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(3);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'tweet_id' => $worksheet->getCell('D'.$i)->getValue(),
                'update_type_id' => $worksheet->getCell('F'.$i)->getValue(),
                'value' => $worksheet->getCell('H'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $twu = collect($items);
        $twu->each(function ($item) {
            $row = TweetUpdate::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new TweetUpdate;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }

    private function loadStaticPages($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(4);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'alias' => $worksheet->getCell('D'.$i)->getValue(),
                'content' => $worksheet->getCell('F'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $page = collect($items);
        $page->each(function ($item) {
            $row = Page::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Page;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }

    private function loadAdv($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(5);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() == '') {
                break;
            }
            $items[] = [
                'id' => $worksheet->getCell('B'.$i)->getValue(),
                'content' => $worksheet->getCell('D'.$i)->getValue(),
                'overwrite' => $worksheet->getCell('A'.$i)->getValue()
            ];
            $i++;
        }
        $page = collect($items);
        $page->each(function ($item) {
            $row = Adv::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Adv;
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            } else if ($item['overwrite'] == 1) {
                $row->id = $item['id'];
                $row->fill($item);
                $row->save();
            }
        });
    }
}
