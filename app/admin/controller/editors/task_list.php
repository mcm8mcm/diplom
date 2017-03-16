<?php
class ControllerEditorsTaskList extends Controller {
    public function index() {
        $data = array();
        $this->load->model("editors");
        $data['user_tasks'] = $this->model_editors->getTasks($this->request->get['user_id']); 
        foreach ($data['user_tasks'] as $key => $task) {
            $data['user_tasks'][$key]['view'] = $this->load->controller('taskrender/the_task', $task);
        }
        return $this->load->view("editors/tasks_list", $data);
    }
}
