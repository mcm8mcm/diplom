<?php
class ControllerPanelsLanguage extends Controller {
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
        $content = $this->load->controller('editors/edlanguages', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }   
    
    public function edit() {
        ddd($this);
        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['user_id'])){
            $this->index();
        }

        $this->load->language('editors/languages');
        $this->load->model('editors'); 
        $this->request->post['isactive'] = $this->request->post['isactive'] === $this->language->get('yes') ? '1' : '0';
        $this->request->post['user_lang'] = $this->request->post['user_lang'] === $this->language->get('lang_not_selected') ? '' : $this->request->post['user_lang'];
        $res = $this->model_editors->postUser($this->request->post);
        $this->session->data['sacc_err'] = $res;
        $this->response->redirect($this->response->url('panels/language'));
    }
    
    public function add_language() {

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
}
