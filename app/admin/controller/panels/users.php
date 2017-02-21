<?php
class ControllerPanelsUsers extends Controller {
    public function index($sacc_err = array()) {

        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }
        
        $this->load->language('controlpanel');
        
        $header = $this->load->controller('common/header');
        $sidebar = $this->load->controller('common/sidebar');        
        $content = $this->load->controller('editors/edusers', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }   
    
    public function edit() {
        if(!isset($this->request->post) || !isset($this->request->post['user_id'])){
            $this->index();
        }

        $this->load->language('editors/users');
        $this->load->model('editors');        
        $this->request->post['isactive'] = $this->request->post['isactive'] === $this->language->get('yes') ? '1' : '0';
        $this->request->post['user_lang'] = $this->request->post['user_lang'] === $this->language->get('lang_not_selected') ? '' : $this->request->post['user_lang'];
        $res = $this->model_editors->postUser($this->request->post);
        $this->index($res);
    }
}
