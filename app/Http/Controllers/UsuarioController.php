<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    public function indexApi(){
        $usuario = Usuario::all();
        return $usuario;
    }

    public function storeApi(Request $request){
        Log::info('Cabeçalhos da requisição: ', $request->headers->all());

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            Log::info('Arquivo recebido: ' . $image->getClientOriginalName());  
            $path = $image->store('imagesPicture', 'public');  
        } else {
            Log::info('Nenhum arquivo foi enviado.');
            $path = '';  
        }

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'dataNasc' => $request->dataNasc,
            'genero' => $request->genero,
            'altura' => $request->altura,
            'peso' => $request->peso,
            'foto' => $path
        ]);

        return response()->json([
            'status'=> 'success',
            'usuario' => $usuario
        ], 200);
    }

    // Atualizar um usuário pelo ID
    public function updateApi(Request $request, $id) {
        Log::info('Entrou no updateApi', ['id' => $id, 'request' => $request->all()]);

        $usuario = Usuario::find($id);
    
        if (!$usuario) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrado'], 404);
        }
    
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            Log::info('Arquivo recebido no update: ' . $image->getClientOriginalName());  
            $path = $image->store('imagesPicture', 'public');
            $usuario->foto = $path;
        }
    
        // Atualizar somente campos que vieram no request
        $usuario->nome = $request->nome ?? $usuario->nome;
        $usuario->email = $request->email ?? $usuario->email;
        $usuario->senha = $request->senha ?? $usuario->senha;
        $usuario->dataNasc = $request->dataNasc ?? $usuario->dataNasc;
        $usuario->genero = $request->genero ?? $usuario->genero;
        $usuario->altura = $request->altura ?? $usuario->altura;
        $usuario->peso = $request->peso ?? $usuario->peso;
    
        $usuario->save();
    
        return response()->json([
            'status' => 'success',
            'usuario' => $usuario
        ], 200);
    }
    

    // Deletar um usuário pelo ID
    public function destroyApi($id) {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Usuário deletado com sucesso'
        ], 200);
    }
}

