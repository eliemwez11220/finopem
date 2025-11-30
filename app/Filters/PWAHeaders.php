<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PWAHeaders implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do nothing
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ajouter des en-têtes spécifiques pour PWA
        if(ENVIRONMENT == 'production'){
            $response->setHeader('Service-Worker-Allowed', '/');
            //$response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        }
        
    }
}