<?php

namespace App\Controllers;

class PlaceholderController extends BaseController
{
    public function add()
    {
        return view('pages/placeholder', [
            'title' => 'Добавить сервер',
            'message' => 'Форма добавления появится в PR3. Пока можно посмотреть демо-данные.',
        ]);
    }

    public function admin()
    {
        return view('pages/placeholder', [
            'title' => 'Админка',
            'message' => 'Модерация и вход по паролю из env будут реализованы в PR3.',
        ]);
    }
}
