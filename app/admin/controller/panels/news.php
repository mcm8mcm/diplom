<?php
class ControllerPanelsNews extends Controller{
    public function index() {

        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }
        
        $sacc_err = array();
        if(isset($this->session->data['sacc_err'])){
            $sacc_err = $this->session->data['sacc_err'];
            unset($this->session->data['sacc_err']);
        }
        
        $this->load->language('controlpanel');
        
        $header = $this->load->controller('common/header');
        $sidebar = $this->load->controller('common/sidebar');        
        $content = $this->load->controller('editors/ednews', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }   
    
    public function edit() {
        ddd($this->request->post);
        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['lang_name'])){
            $this->index();
        }

        $this->load->language('editors/languages');
        $this->load->model('editors'); 
        $this->request->post['is_active'] = $this->request->post['is_active'] === $this->language->get('yes') ? '1' : '0';
        $flags = $this->model_editors->getFlags();
        $index = array_keys(array_column($flags, "name") , $this->request->post['flag'])[0];
        $this->request->post['flag'] = $flags[$index]['path'];
        $res = $this->model_editors->editLanguage($this->request->post);
        $this->session->data['sacc_err'] = $res;
        $this->response->redirect($this->response->url('panels/language'));
    }
    
    public function add_language() {
        ddd($this->request->post);
        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['lang_name'])){
            $this->index();
        }
        
        $this->load->model('editors'); 
        $this->request->post['is_active'] = $this->request->post['is_active'] === $this->language->get('yes') ? '1' : '0';
        $flags = $this->model_editors->getFlags();
        foreach ($flags as $value) {
            if($this->request->post['flag'] === $value['name']){
               $this->request->post['flag'] = $value['path'];
               break;
            }
        }
        $res = $this->model_editors->addLanguage($this->request->post);
        $this->session->data['sacc_err'] = $res;
        $this->response->redirect($this->response->url('panels/language'));    
    }
    
    public function del_language() {
        ddd($this->request->post);
        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['elem_id'])){
            $this->index();
        }
        
        $this->load->model('editors'); 
        $flags = $this->model_editors->getFlags();
        $res = $this->model_editors->delLanguage($this->request->post['elem_id']);
        $this->session->data['sacc_err'] = $res;
        $this->session->data['sacc_err']['del'] = TRUE;
        $this->response->redirect($this->response->url('panels/language'));    
    }

    public function act_dispatch() {
        ddd($this->request);
    }
}
