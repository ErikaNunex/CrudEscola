<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use App\Notification\WebNotification;
use App\Repository\UserRepository;

use Exception;

class UserController extends AbstractController
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function list(): void
    {
        $users = $this->repository->findAll();

        $this->render('user/list', [
            'users' => $users,
        ]);
    }

    public function add(): void
    {
        if (true === empty($_POST)) {
            $this->render('user/add');
            return;
        }

        //encriptação
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $password;
        $user->profile = $_POST['profile'];

        $this->repository->insert($user);

        $this->redirect('/usuarios/listar');
    }
    public function toEdit():void
    {
        $this->checkLogin();
        $id = $_GET['id'];
        $rep = new UserRepository;
        $user = $this->repository->findOne($id);
        $this->render('user/edit', [$user]);
        if (false === empty($_POST)) {
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $password;
            $user->profile = $_POST['profile'];
    
            try {
                $rep->update($user, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'email')) {
                    WebNotification::add('Usuario já cadastrado', 'danger');
                    return;
                }
    
                die('Vish, aconteceu um erro');
            }
            WebNotification::add('Cadastro Atualizado', 'success');
            $this->redirect('/usuarios/listar');
        };
        
    }
    public function delete():void
    {
         $id= $_GET['id'];
         $this->repository->delete($id);
         $this->redirect('/usuarios/listar');
    }

}