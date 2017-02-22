<?php
class ControllerPanelsUsers extends Controller {
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
        $content = $this->load->controller('editors/edusers', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }   
    
    public function edit() {

        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['user_id'])){
            $this->index();
        }

        $this->load->language('editors/users');
        $this->load->model('editors');        
        $this->request->post['isactive'] = $this->request->post['isactive'] === $this->language->get('yes') ? '1' : '0';
        $this->request->post['user_lang'] = $this->request->post['user_lang'] === $this->language->get('lang_not_selected') ? '' : $this->request->post['user_lang'];
        $res = $this->model_editors->postUser($this->request->post);
        $this->session->data['sacc_err'] = $res;
        $this->response->redirect($this->response->url('panels/users'));
    }
}
