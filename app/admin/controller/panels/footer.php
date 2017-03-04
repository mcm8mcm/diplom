<?php
class ControllerPanelsFooter extends Controller {
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
        $content = $this->load->controller('editors/edfooter', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }   
    
    public function act_dispatch() {
        //ddd($this->request->post);
        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }

        if(!isset($this->request->post) || !isset($this->request->post['curr_action'])){
            $this->index();
        }
              
        $allowed_tags = "<p><h1><h2><h3><h4><h5><b><i><u>";
        
        $this->load->model('editors'); 
        $this->request->post['is_archive'] = $this->request->post['is_archive'] === $this->language->get('yes') ? '1' : '0';
        $this->request->post['article_content'] = $this->db->escape(strip_tags(html_entity_decode($this->request->post['article_content']), $allowed_tags));
        $this->request->post['article_title'] = $this->db->escape(strip_tags(html_entity_decode($this->request->post['article_title']), $allowed_tags));
                
        if($this->request->post['curr_action'] === 'add_new'){
            $res = $this->model_editors->addArticle($this->request->post);
        }elseif ($this->request->post['curr_action'] === 'edit') {
            $res = $this->model_editors->editArticle($this->request->post);
        }else{
           $res = $this->model_editors->delArticle($this->request->post); 
           $this->session->data['sacc_err']['del'] = TRUE;
        }
       
        $this->session->data['sacc_err'] = $res;
        $this->response->redirect($this->response->url('panels/news'));                    
    }        
}
