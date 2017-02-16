<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlPanel
 *
 * @author mcm
 */
class ControllerControlpanel extends Controller{
    public function index() {

        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }
        
        $this->load->language('controlpanel');
        
        $header = $this->load->controller('common/header');
        $sidebar = $this->load->controller('common/sidebar');        
        $content = $this->load->controller('common/content');
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }
}
