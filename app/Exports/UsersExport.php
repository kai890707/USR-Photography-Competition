<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Items;
class UsersExport implements FromCollection,WithHeadings
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function headings():array
    {
        # code...
        return [
            "組別名稱",
            "投稿人姓名",
            "圖片編號",
            "構圖技巧平均分數",
            "攝影技巧平均分數",
            "主題內容平均分數",
            "總分",
            "圖片位置"
        ];

    }
    /**
     * 
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $item = new Items();
        return collect($item->getAllItemsRankExport($this->id));
    }
}
// use Maatwebsite\Excel\Concerns\FromView;
 
// class UsersExport implements FromView
// {
//     public $items;
//     public function __construct(){
//         $this->items = new Items();
//     }
//     public function view(): View
//     {
//         // return view('export.form', [
//         //     'dataOfGroup1' => $this->items->getAllItemsRankDataTable(1),
//         //     'dataOfGroup2' => $this->items->getAllItemsRankDataTable(2)
//         // ]);
//         // return view('export.form');
//     }
// }