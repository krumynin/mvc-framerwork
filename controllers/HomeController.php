<?php

class HomeController extends AbstractController
{
    public function somethingAction(array $args)
    {
        $this->template->renderView('something', $args);
    }
}
