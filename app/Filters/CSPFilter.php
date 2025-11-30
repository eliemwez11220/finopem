<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CSPFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Aucune action avant la requête
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ajouter l'en-tête CSP à la réponse
        $response->setHeader('Content-Security-Policy', "default-src 'self'; img-src 'self'");
        // Générer un nonce
        $nonce = base64_encode(random_bytes(16));

        // Ajouter le nonce à la politique CSP
        $response->setHeader('Content-Security-Policy', "style-src 'self' 'nonce-{$nonce}'");
        $response->setHeader('Content-Security-Policy', "script-src 'self' 'nonce-{$nonce}'");

        //$response->setHeader('Content-Security-Policy', "script-src 'self' https://translate.google.com");
        //frame-src, font-src, connect-src, etc.
        return $response;
    }
}
