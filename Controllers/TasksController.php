<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $taskRepository= new TaskRepository();
        $tasks = new TaskModel();
        $d['tasks'] = $taskRepository->getAll($tasks);
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        {
            if (isset($_POST["title"])) {
                $task = new TaskRepository();
                $model = new TaskModel();
                $model->setTitle($_POST["title"]);
                $model->setDescription($_POST["description"]);
                $model->setCreated_at(date("Y-m-d H:i:s"));
                if ($task->add($model)) {
                    header("Location: " . WEBROOT . "tasks/index");
                }
            }
            $this->render("create");
        }
    }

    function edit($id)
    {
        $task = new TaskRepository();
        $d['task'] = $task->get($id);
        $model = new TaskModel();
        if (isset($_POST["title"]))
        {   
            $model->setId($id);
            $model->setTitle($_POST["title"]);
            $model->setDescription($_POST["description"]);
            $model->setUpdated_at(date("Y-m-d H:i:s"));
            if ($task->edit($model))
            {
                echo "update";
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $task = new TaskRepository();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>