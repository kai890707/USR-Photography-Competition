<?php

namespace App\Imports;

use App\Models\Back;
use App\Models\Group;
use App\Models\Applicant;
use App\Models\Photo;
use App\Models\Score;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    protected $delTitle;
    public $group;
    public $applicant;
    public $photo;
    public $score;
    public $user;
    public function __construct($delTitle = 1)
    {
        $this->delTitle = $delTitle;
        $this->group = new Group();
        $this->applicant = new Applicant();
        $this->photo = new Photo();
        $this->score = new Score();
        $this->user = new User();
    }
    public function collection(Collection $rows)
    {
        //刪除表頭
        $this->delTitle($rows);
        //insert
        $this->addRecords($rows);
    }
    //刪除無用行
    public function delTitle(&$rows)
    {
        $rows = $rows->slice($this->delTitle)->values();
    }
    //insert to db
    public function addRecords($rows)
    {
        foreach ($rows as $row) {
            $aData = $row->toArray();
            $groupId = $this->group->getGroupId($aData[1])->id; //組別ID
            $allChair = $this->user->getAllChair();             //所有評審(Array)
            $groupName = $aData[1];                             //組別名稱
            $applicantName = $aData[9];                         //投稿人姓名
            $applicantCommunity = $aData[8];                    //投稿人社區
            $applicantPhone = $aData[10];                       //投稿人電話
            $applicantEmail = $aData[11];                       //投稿人Email
            /**insert Applicant start */
            $applicant = new Applicant();
            $applicant->name = $applicantName;
            $applicant->phone = $applicantPhone;
            $applicant->community = $applicantCommunity;
            $applicant->email = $applicantEmail;
            $result = $applicant->save();
            $applicantReturnId =  $applicant->id;         //投稿人ID
            /** insert end */
            /**歸納圖片資料 start*/
            if(!empty($row[12])){
                $photoData1 = array(
                    "photoName"=>$row[12],
                    "photoIllustrate"=>$row[3],
                    "photoPath"=>explode("https://drive.google.com/open?id=",$row[2])[1],
                );
            }else{
                $photoData1 = [];
            }
            if(!empty($row[13])&&!empty($row[5])&&!empty($row[4])){
                
                $photoData2 = array(
                    "photoName"=>$row[13],
                    "photoIllustrate"=>$row[5],
                    "photoPath"=>explode("https://drive.google.com/open?id=",$row[4])[1],
                );  
            }else{
                 $photoData2 = [];
            }
           if(!empty($row[14])&&!empty($row[7])&&!empty($row[6])){
                $photoData3 = array(
                    "photoName"=>$row[14],
                    "photoIllustrate"=>$row[7],
                    "photoPath"=>explode("https://drive.google.com/open?id=",$row[6])[1],
                ); 
            }else{
                $photoData3 =[];
            }
           /** end */
            $insertDataArray = array($photoData1,$photoData2,$photoData3);
            foreach($insertDataArray as $array){
                if(count($array)>0){
                    //photo ['group_id', 'applicant_id', 'name','path','illustrate','status'];
                    /**insert photo start */
                    $photo = new Photo();
                    $photo->group_id = $groupId;
                    $photo->applicant_id = $applicantReturnId;
                    $photo->name = $array['photoName'];
                    $photo->path = $array['photoPath'];
                    $photo->illustrate = $array['photoIllustrate'];
                    $photo->status = 1;
                    $photoIsSave =  $photo->save();
                    $photoId =  $photo->id;
                    /**insert photo end  */
                    if($photoIsSave){
                        //score ['photo_id', 'user_id','score_A','score_B','score_C','comments','status'];
                        for($i=0;$i<3;$i++){
                            $score = new Score();
                            $score->photo_id = $photoId ;
                            $score->user_id = $allChair[$i]->id;
                            $score->score_A = 0;
                            $score->score_B = 0;
                            $score->score_C = 0;
                            $score->status = 1 ;
                            $score->save();
                        }
                    }
                }
            }
        }
    }
}
//   0 => 44390.562427951
//   1 => "人像攝影"
//   2 => "https://drive.google.com/open?id=1eZDaeF40vgHPPo9wyuTdXPylVYgu3cp7"
//   3 => "圖片1說明"
//   4 => "https://drive.google.com/open?id=18aEq3Wv3ncOqExSBiRK-gVPLCoaubZ7u"
//   5 => "圖片2說明"
//   6 => "https://drive.google.com/open?id=15LbeKA84bVXAR6Cu_HmY6vp1E9ZJRZMR"
//   7 => "圖片3說明"
//   8 => "合群社區"
//   9 => "蔡銘凱"
//   10 => "0905197166"
//   11 => "s18113223@stu.edu.tw"
//   12 => "圖片1"
//   13 => "圖片2"
//   14 => "圖片3"