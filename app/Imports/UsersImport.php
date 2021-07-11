<?php

namespace App\Imports;

use App\Models\Back;
use App\Models\Group;
use App\Models\Applicant;
use App\Models\Photo;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

// class UsersImport implements ToModel, WithHeadingRow
// {
/**
 * @param array $row
 *
 * @return \Illuminate\Database\Eloquent\Model|null
 */
//     public function model(array $rows)
//     {
//         // foreach ($rows as $row) {

//         //     // $i+=1;
//         //     // if($i==1){
//         //     //     continue;
//         //     // }else{

//         //     // }
//         //     // Back::create([
//         //     //     'name' => $row[1],
//         //     // ]);

//         //     // Applicant::create([
//         //     //     'name' => $row[9],
//         //     //     'phone' => $row[10],
//         //     //     'community' => $row[8],
//         //     // ]);
//         // }
// dd($rows);

//         // return new Back([


//         // ]);
//     }
// }
class UsersImport implements ToCollection
{
    protected $delTitle;
    public $group;
    public $applicant;
    
    public function __construct($delTitle = 1)
    {
        $this->delTitle = $delTitle;
        $this->group = new Group();
        $this->applicant = new Applicant();
    }
    public function collection(Collection $rows)
    {
        //删除表头
        $this->delTitle($rows);
        //插入数据库操作
        $this->addRecords($rows);
    }
    //删除无用行
    public function delTitle(&$rows)
    {
        $rows = $rows->slice($this->delTitle)->values();
    }
    //添加记录数
    public function addRecords($rows)
    {
        foreach ($rows as $row) {
            $aData = $row->toArray();
            if (
                !empty($aData) && !empty($aData[0]) && !empty($aData[1]) && !empty($aData[2]) && !empty($aData[3])
                && !empty($aData[4]) && !empty($aData[5]) && !empty($aData[6]) && !empty($aData[7]) && !empty($aData[8])
                && !empty($aData[9]) && !empty($aData[10])
            ) {
                $groupId = $this->group->getGroupId($aData[1])->id;
        
               $applicant =  Applicant::create([
                    'name' => $aData[9],
                    'phone' => $aData[10],
                    'community' => $aData[8],
                ]);
                // $applicantId = $this->applicant->getApplicantId($aData[9]);
                Photo::create([
                    'group_id' => $groupId,
                    'applicant_id' => $applicant->id,
                    'name' => $aData[8],
                    'path'=>$aData[2],
                    "illustrate"=>$aData[3],
                    "status"=>1
                ],
                [
                    'group_id' => $groupId,
                    'applicant_id' => $applicant->id,
                    'name' => $aData[8],
                    'path'=>$aData[4],
                    "illustrate"=>$aData[5],
                    "status"=>1
                ],[
                    'group_id' => $groupId,
                    'applicant_id' => $applicant->id,
                    'name' => $aData[8],
                    'path'=>$aData[6],
                    "illustrate"=>$aData[7],
                    "status"=>1
                ]
            );
            }
        }
    }
}
class MyException extends Exception
{
}
// array:11 [
//     0 => 44385.842777778
//     1 => "人像攝影"
//     2 => "https://drive.google.com/open?id=13bNvWHhpt-8Jjc-aaMfKvsyfi2U8S9Y9"
//     3 => "社區之美"
//     4 => "https://drive.google.com/open?id=1wmuADUn2sqCHBXryWipG1SowByzTQXeh"
//     5 => "社區之美"
//     6 => "https://drive.google.com/open?id=1_0I_qbQjGDoAbDXZAChmpBoZgF_e_try"
//     7 => "社區之美"
//     8 => "合群社區"
//     9 => "王小明"
//     10 => 912345678
//   ]