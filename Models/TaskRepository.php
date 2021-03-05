<?php

namespace MVC\Models;

use MVC\Models\TaskResourceModel;

class TaskRepository
{
    private $taskRM;

    public function __construct()
    {
        $this->taskRM = new TaskResourceModel();
    }

    public function add($model)
    {
        return $this->taskRM->save($model);
    }

    public function edit($model)
    {
        return $this->taskRM->save($model);
    }

    public function get($id)
    {
        return $this->taskRM->find($id);
    }

    public function delete($id)
    {
        return $this->taskRM->delete($id);
    }

    public function getAll($model)
    {
        return $this->taskRM->all($model);
    }

}

?>
