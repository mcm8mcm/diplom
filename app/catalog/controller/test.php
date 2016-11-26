<?php
class ControllerTest extends Controller{
    public function index() {
        $this->document->setTitle('Preved');
        $this->response->setOutput($this->document->render());
        $this->response->flush();
        $this->load->language('/test');
        echo $this->language->get('title');
        echo $this->language->get('test_string');
        
        $sql = 'SELECT * FROM `user_group`';
        $res = $this->db->sql($sql);
        var_dump($res);
    }
}