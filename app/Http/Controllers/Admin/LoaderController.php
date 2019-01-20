<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adv;
use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\TweetAssignment;
use App\Models\TweetUpdate;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LoaderController extends Controller
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
            abort('403');
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

            session()->flash('success-message', 'Данные успешно загружены');
        } else {
            session()->flash('message', 'Файл не найден');
        }

        return redirect(route('admin_loader'));
    }

    private function loadHouses($spreadsheet) {
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $items = [];
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'name' => $worksheet->getCell('C'.$i)->getValue(),
                    'icon' => $worksheet->getCell('Q'.$i)->getValue(),
                    'image' => $worksheet->getCell('J'.$i)->getValue(),
                    'image_small' => $worksheet->getCell('M'.$i)->getValue(),
                    'max_money' => $worksheet->getCell('F'.$i)->getValue(),
                    'money_per_hour' => $worksheet->getCell('H'.$i)->getValue(),
                    'title' => $worksheet->getCell('U'.$i)->getValue(),
                    'description' => $worksheet->getCell('W'.$i)->getValue(),
                    'content' => $worksheet->getCell('Y'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'title' => $worksheet->getCell('T'.$i)->getValue(),
                    'description' => $worksheet->getCell('W'.$i)->getValue(),
                    'link' => $worksheet->getCell('O'.$i)->getValue(),
                    'alias' => $worksheet->getCell('R'.$i)->getValue(),
                    'introtext' => $worksheet->getCell('E'.$i)->getValue(),
                    'content' => $worksheet->getCell('H'.$i)->getValue(),
                    'pub_date' => $worksheet->getCell('C'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'tweet_id' => $worksheet->getCell('D'.$i)->getValue(),
                    'house_id' => $worksheet->getCell('F'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'tweet_id' => $worksheet->getCell('D'.$i)->getValue(),
                    'update_type_id' => $worksheet->getCell('F'.$i)->getValue(),
                    'value' => $worksheet->getCell('H'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'alias' => $worksheet->getCell('D'.$i)->getValue(),
                    'content' => $worksheet->getCell('F'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
        $emptyCounter = 0;
        while (true) {
            if ($worksheet->getCell('B'.$i)->getValue() != '') {
                $emptyCounter = 0;
                $items[] = [
                    'id' => $worksheet->getCell('B'.$i)->getValue(),
                    'content' => $worksheet->getCell('D'.$i)->getValue(),
                    'overwrite' => $worksheet->getCell('A'.$i)->getValue()
                ];
            } else {
                $emptyCounter++;
            }
            $i++;
            if ($emptyCounter >= 5) {
                break;
            }
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
