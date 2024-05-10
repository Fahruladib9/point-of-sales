<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function allert($title, $text, $icon)
    {
        session()->setFlashdata('title', $title);
        session()->setFlashdata('text', $text);
        session()->setFlashdata('icon', $icon);
    }
}
