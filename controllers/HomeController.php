<?php

class HomeController
{
    public function somethingAction(array $args)
    {
        $argsString = implode(',', $args);

        echo "Hello worlds this HomeController->somethingAction args = {$argsString}";
    }
}
