<?php
class ModelNews extends Model{
    public function getNews() {
        $sql = "SELECT * FROM `".DB_PREFIX."` WHERE `added` <= ADDTIME(`added`, '72:00:00')";
        $res = $this->db->sql($sql);
        $toRet = array();
        if($res['num_rows']){
            foreach ($res['rows'] as $value) {
                $art_date = new DateTime($res['added']);
                $date = date_format($art_date, 'd.m.Y H:i:s');
                $row = array('title'=>$res['title'],
                    'content'=>$res['article'],
                    'date'=>$date);
            }
        }
        return $toRet;
    }
}