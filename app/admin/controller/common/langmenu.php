<?php
class ControllerCommonLangmenu extends Controller{
    public function index() {
        $languages = $this->session->data['languages'];
        $actlang = array();
        foreach ($languages as $index=>$lang){
            if($lang['active'] === '1'){
                $actlang = $lang;
            }
            
            $languages[$index]['action'] = $this->session->data['link'].'?set_lang='.$lang['name'];
        }
        
        $data = array('languages'=>$languages, 'actlang'=>$actlang);
        return $this->load->view('common/langmenu', $data);
    }
}
