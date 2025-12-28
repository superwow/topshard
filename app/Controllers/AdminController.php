<?php

namespace App\Controllers;

use App\Models\ServerModel;
use Config\App;

class AdminController extends BaseController
{
    public function index()
    {
        $session = session();

        if (! $session->get('is_admin')) {
            return view('pages/admin_login', [
                'title' => 'Админка',
            ]);
        }

        $serverModel = new ServerModel();

        return view('pages/admin', [
            'title' => 'Админка',
            'pendingServers' => $serverModel->where('status', 'pending')->orderBy('created_at', 'DESC')->findAll(),
            'activeCount' => (new ServerModel())->where('status', 'active')->countAllResults(),
            'pendingCount' => (new ServerModel())->where('status', 'pending')->countAllResults(),
            'disabledCount' => (new ServerModel())->where('status', 'disabled')->countAllResults(),
        ]);
    }

    public function login()
    {
        $password = (string) $this->request->getPost('password');
        $expected = (new App())->adminPassword;

        if ($password !== $expected) {
            return redirect()->back()->withInput()->with('error', 'Неверный пароль. Проверьте .env');
        }

        session()->set('is_admin', true);

        return redirect()->to('/admin')->with('success', 'Добро пожаловать!');
    }

    public function logout()
    {
        session()->remove('is_admin');

        return redirect()->to('/admin')->with('success', 'Вы вышли из админки.');
    }

    public function moderate(int $id)
    {
        $session = session();
        if (! $session->get('is_admin')) {
            return redirect()->to('/admin')->with('error', 'Нужна авторизация.');
        }

        $status = $this->request->getPost('status');
        if (! in_array($status, ['active', 'disabled', 'pending'], true)) {
            return redirect()->back()->with('error', 'Недопустимый статус.');
        }

        $serverModel = new ServerModel();
        $server = $serverModel->find($id);

        if (! $server) {
            return redirect()->back()->with('error', 'Сервер не найден.');
        }

        $serverModel->update($id, ['status' => $status]);

        return redirect()->to('/admin')->with('success', "Статус {$server['name']} обновлён на {$status}.");
    }
}
