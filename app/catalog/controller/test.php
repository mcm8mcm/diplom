<?php
class ControllerTest extends Controller{
    public function index() {
        $this->load->language('/test');
        $this->document->setTitle($this->language->get('title'));
        $this->language->get('test_string');
        
        $this->load->model('user');
        $user = $this->model_user->getUser('mCm','784512');
        $data = array();
        $data['preved'] = $user['row']['email'];
        $res = $this->load->view('user', $data);
        $res .= '<i class="fa fa-key">Preved</i>';
        $this->document->addBody($res);
        $this->response->setOutput($this->document->render());
        $this->response->flush();
    }
}