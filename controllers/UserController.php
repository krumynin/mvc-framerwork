<?php

class UserController extends AbstractController
{
    public function getAction(array $args): void
    {
        if (!isset($args['id'])) {
            die ('404 Not Found');
        }

        $user = User::getById($args['id']);

        if (!isset($user)) {
            die ('404 Not Found');
        }

        $this->template->renderView('user-info', ['user' => $user]);
    }

    public function listAction(): void
    {
        $users = User::getAll();
        $this->template->renderView('user-list', ['users' => $users]);
    }

    public function createAction(): void
    {
        if (!empty($_POST)) {
            $user = User::getModelByData($_POST);
            $user->save();

            header('Location: list', true, 301);
        }
        else {
            $this->template->renderView('user-create');
        }
    }
}
