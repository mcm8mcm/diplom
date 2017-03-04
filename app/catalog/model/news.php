<?php
class ModelNews extends Model{
    public function getNews() {
        $sql = "SELECT * FROM `".DB_PREFIX."news` WHERE NOW() <= ADDTIME(`added`, '480:00:00') AND `archive` = 0";
        $res = $this->db->sql($sql);
        
        $toRet = array();
        if($res['rows_count']){
            foreach ($res['rows'] as $value) {
                $art_date = new DateTime($value['added']);
                $date = date_format($art_date, 'd.m.Y H:i:s');
                $row = array('title'=>$value['title'],
                    'content'=>$value['article'],
                    'date'=>$date);
                $toRet[] = $row;
            }
        }
        return $toRet;
    }
}