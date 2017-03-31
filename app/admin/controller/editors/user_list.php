<?php
class ControllerEditorsUserList extends Controller {
    public function index() {       
        $data = array();
        $this->load->model('editors');
        $data['user_list'] = $this->model_editors->getUsers();
        $data['base_link'] = $this->response->url("panels/tasks");
        $data['active_id'] = '';

        if(isset($this->request->get['user_id']) || isset($this->request->post['user_id'])){         
            $data['active_id'] = isset($this->request->post['user_id']) ? $this->request->post['user_id'] : $this->request->get['user_id'];
        } else {
            if(count($data['user_list'])){
                $data['active_id'] = $data['user_list']['user'][0]['id'];
                $this->request->get['user_id'] = $data['active_id'];
            } else {
                $this->request->get['user_id'] = "-1";
            }
        }
        
        return $this->load->view('editors/users_list', $data);
    }
}
