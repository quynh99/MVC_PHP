<?php

namespace MVC\Models;

use MVC\Models\TaskModel;
use MVC\Core\ResourceModel;

class TaskResourceModel extends ResourceModel
{
    public function __construct()
    {
        parent::_init('tasks', 'id', new TaskModel);
    }
}
?>