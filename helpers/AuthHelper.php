<?php

require_once './Models/Usuarios.Model.php';

class usuariosHelper
{

    private $secretKey = 'cruises';
    private $usuario;
    private $model;

    public function __construct()
    {
        $this->model = new usuariosModel();
        $this->usuario = null;
    }

    public function validarPermisos()
    {
        $header = apache_request_headers();
        if (!isset($header['Authorization']))
            return null;
        $authorization = $header['Authorization'];
        $params = explode(' ', $authorization);
        $token = $params[1];
        $usuario = $this->comprobarToken($token);
        if ($usuario) {
            $this->usuario = $this->model->getUserByUserName($usuario);
            return true;
        } else
            return null;
    }

    function obtenerToken($usuario)
    {
        $tokenData = [
            'sub' => $usuario->id,
            // Identificador del usuario
            'iat' => time(),
            // Fecha de emisión del token
            'exp' => time() + 1800,
            // Fecha de vencimiento del token (1/2 hora)
            'data' => $usuario->nombre_usuario
            // Datos adicionales del usuario
        ];
        // Genera el token JWT
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $header = base64_encode($header);

        $payload = json_encode($tokenData);
        $payload = base64_encode($payload);

        $signature = hash_hmac('sha256', "$header.$payload", $this->secretKey, true);
        $signature = base64_encode($signature);

        $token = "$header.$payload.$signature";
        return ['token' => $token];
    }

    private function comprobarToken($token)
    {
        // Divide el token en sus componentes: encabezado, payload y firma
        $tokenParts = explode('.', $token);

        // Verifica que el token tenga los tres componentes necesarios
        if (count($tokenParts) !== 3) {
            return null;
        }

        [$header, $payload, $signature] = $tokenParts;

        // Decodifica el encabezado y el payload
        $payloadData = json_decode(base64_decode($payload), true);

        // Verifica la firma del token
        $hash = hash_hmac('sha256', "$header.$payload", $this->secretKey, true);
        $signatureData = base64_decode($signature);
        $isSignatureValid = hash_equals($hash, $signatureData);
        if ($isSignatureValid) {
            // Verifica la fecha de vencimiento
            $currentTimestamp = time();
            $expirationTimestamp = $payloadData['exp'];
            if ($currentTimestamp <= $expirationTimestamp) {
                // El token no ha expirado
                return $payloadData['sub']; // identificador del usuario del payload
            } else {
                return null;
            }
        } else {
            return null;
        }
    }



}