<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está logado E se a coluna 'role' dele é 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Deixa passar
        }

        // Se não for admin, redireciona de volta para o dashboard comum (ou outra página)
        abort(403, 'Acesso negado. Apenas administradores podem acessar esta página.');
    }
}
