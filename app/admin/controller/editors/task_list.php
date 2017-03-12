<?php
class ControllerEditorsTaskList extends Controller {
    public function index() {
        $data = array();
        $this->load->model("editors");
        $data['user_tasks'] = $this->model_editors->getTasks($this->request->get['user_id']);
        return $this->load->view("editors/task_list");
    }
}
