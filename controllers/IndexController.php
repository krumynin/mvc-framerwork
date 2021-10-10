<?php

class IndexController extends AbstractController
{
    public function indexAction()
    {
        if (empty($_SESSION['id'])) {
            header('Location: auth/login', true, 301);
        }

        $user = User::getById($_SESSION['id']);

        $this->template->renderView('index', ['user' => $user]);
    }
}
