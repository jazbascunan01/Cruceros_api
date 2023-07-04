<?php
require_once("Models/Usuarios.Model.php");
require_once("Views/Api.View.php");
require_once("Api.Controller.php");
require_once './helpers/AuthHelper.php';

class UsuariosController extends ApiController
{
    public function login(){
        $datos = $this->getData();
        //hacer comprobaciones del get data
        $usuario = $datos->nombre_usuario;
        $password = $datos->password;
        if (empty($usuario) || empty($password))
            $this->view->response("Debe indicar el nombre de usuario y/o password", 400);
        else{
            $usuarioModel = $this->usuariosmodel->getUserByUserName($usuario);
            if($usuarioModel && password_verify($password, $usuarioModel->password)){
                $helper = new usuariosHelper();
                $token = $helper->obtenerToken($usuarioModel);
                $this->view->response($token, 200);
            }
            else
                $this->view->response("usuario o contraseña incorrecto/s", 400);    
        }    
    }
}