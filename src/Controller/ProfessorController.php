<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Professor;
use App\Notification\WebNotification;
use App\Security\UserSecurity;
use App\Repository\ProfessorRepository;
use Exception;

class ProfessorController extends AbstractController
{
    private ProfessorRepository $repository;

    public function __construct()
    {
        $this->repository = new ProfessorRepository();
    }


    public function listar(): void
    {
        $rep = new ProfessorRepository();
        $professores = $rep->buscarTodos();

        $this->render("professor/listar", [
            'professores' => $professores,
        ]);
    }

    public function cadastrar(): void
    {
        if(true === empty($_POST)){
            $this->render("professor/cadastrar");
        }

        $professor = new Professor;
        $professor->nome=$_POST['nome'];
        $professor->cpf=$_POST['cpf'];
        $professor->endereco=$_POST['endereco'];
        $professor->formacao=$_POST['formacao'];

        try {
            $this->repository->inserir($professor);
        } catch (Exception $exception) {
            if (true === str_contains($exception->getMessage(), 'cpf')) {
                WebNotification::add('Professor já cadastrado', 'danger');
                $this->redirect('/professores/novo');
                return;
            }

            die('Vish, aconteceu um erro');
        }
        WebNotification::add('Novo professor cadastrado', 'success');
        $this->redirect('/professores/listar');
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $rep = new ProfessorRepository();
        $rep->excluir($id);
        $this->redirect("/professores/listar");
    }

    public function editar(): void
    {
        $this->checkLogin();
        $id = $_GET['id'];
        $rep = new ProfessorRepository();
        $professor = $rep->buscarUm($id);
        $this->render('professor/editar', [$professor]);
        if (false === empty($_POST)) {
            $professor->nome = $_POST['nome'];
            $professor->formacao = $_POST['formacao'];
            $professor->cpf = $_POST['cpf'];
            $professor->endereco = $_POST['endereco'];

            try {
                $this->repository->atualizar($professor,$id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    WebNotification::add('Professor já cadastrado', 'danger');
                    return;
                }
    
                die('Vish, aconteceu um erro');
            }
            WebNotification::add('Cadastro Atualizado', 'success');
            $this->redirect('/professores/listar');
        };
        
    
          
        
    }
}