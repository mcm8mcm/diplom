<?php
class ControllerAuthLogout extends Controller{
    public function index() {
        if($this->user->isLoggedIn()){
            $this->user->logout();
        }
        
        $this->response->redirect($this->request->post['redirect']);
    }
}