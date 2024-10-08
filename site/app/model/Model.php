<?php

namespace app\model;

abstract class Model
{
    public function redirectToPageWithError(string $url, string $message)
    {
        $_SESSION['message'] = $message;
        header('Location: ' . $url);
        exit;
    }
}
