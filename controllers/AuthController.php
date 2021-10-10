<?php

class AuthController extends AbstractController
{
    public function loginAction(): void
    {
        if (!empty($_POST) && empty($_SESSION)) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
            } else {
                $this->template->renderView('login', [
                    'error' => "Логин или пароль введены неверно!"
                ]);

                exit();
            }

            $user = User::getByLogin($login);

            if ($user !== null && $user->getPassword() === $password) {
                $_SESSION['id'] = $user->getId();

                header('Location: /index', true, 301);
            } else {
                $this->template->renderView('login', [
                    'error' => "Логин или пароль введены неверно!"
                ]);

                exit();
            }
        } elseif (!empty($_SESSION)) {
            header('Location: /index', true, 301);
        } else {
            $this->template->renderView('login');
        }
    }

    public function logoutAction()
    {
        session_start();
        session_destroy();

        header( 'Location: login', true, 301);
    }
}
