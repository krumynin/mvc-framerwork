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
}
