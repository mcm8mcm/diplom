<?php
class ModelPrices extends Model{
    public function getPrice($priceDescriptor) {
        $content = file($priceDescriptor['path'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if($priceDescriptor['codepage'] !== 'UTF-8'){
            foreach ($content as $key => $value) {
                $str = iconv($priceDescriptor['codepage'], 'UTF-8', $value);
                $content[$key] = $str;
            }         
        }
        
        $res = array();
        foreach ($content as $value){ 
            $res[] = explode(';', $value);
        }
        
        return count($res) ? $res : NULL;
    }

    private function getActualPrices() {
        $sql = "SELECT * FROM `".DB_PREFIX."prices` WHERE lang_id='".$this->session->data['language']."' AND actual = 1";
        $res = $this->db->sql($sql);
        if($res['rows_count'] == 0){
            return '';
        }
        
        $prices = array();
        $not_actual = array();
        
        foreach ($res['rows'] as $price) {
            $price_path = DIR_DOWNLOAD.$price['file_name'];
            if(! is_file($price_path)){
                $not_actual[] = $price['id'];
                continue;
            }
            
            $price_obj = array();
            $price_obj['price_name'] = $price['price_name'];
            $price_obj['price_desc'] = $price['price_desc'];
            $price_content = $this->getPrice(array('path'=>$price_path, 'codepage'=>$price['codepage']));
            if(!$price_content){
                $price_obj = NULL;
                continue;
            }
            
            $price_obj['content'] = $price_content;
            $prices[] = $price_obj;
        }
        
        return $prices;
    }
    
    private function getNotActualPrices() {
        $sql = "SELECT * FROM `".DB_PREFIX."prices` WHERE actual = 0";        
    }
    
    public function addPrice($lang_id, $file_name, $codepage) {
        
    }
    
    public function getPrices() {
        return $this->getActualPrices();
    }
    
}
