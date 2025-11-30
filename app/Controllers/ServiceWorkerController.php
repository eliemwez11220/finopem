<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class ServiceWorkerController extends Controller
{
    public function index()
    {
        $response = service('response');

        // Si tu veux passer des données dynamiques, tu peux les calculer ici
        $cacheVersion = 'v1';
        $assetsToCache = [
            '/',
			'css/auth-styles.css',
			'css/custom-styles.css',
			'css/main-styles.css',
			'js/authscripts.js',
			'js/customscripts.js',
			'js/datatables.init.js',
			'js/library.js',
			'js/main.js',
			'manifest.json',
            '/offline.html'
        ];

        // Vue simple ou directement ici en PHP
        $js = view('service_worker', [
            'cacheVersion' => $cacheVersion,
            'assetsToCache' => $assetsToCache
        ]);

        return $response
            ->setHeader('Content-Type', 'application/javascript')
            ->setBody($js);
    }
    public function offline()
    {
        return view('offline');
    }
}
