<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\View\View; //Charge la classe View pour utiliser les vues HTML

class TimeAccessFilter implements FilterInterface
{
    protected $startHour;
    protected $endHour;

    public function __construct()
    {
        $this->startHour = (int) getenv('ACCESS_START_HOUR') ?: 7;
        $this->endHour = (int) getenv('ACCESS_END_HOUR') ?: 23;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $now = new \DateTime('now', new \DateTimeZone('Africa/Lubumbashi')); // fuseau serveur
        $hour = (int) $now->format('G');
        $day  = (int) $now->format('w');

        $accessDenied = false;

        if ($day === 0 || $hour < $this->startHour || $hour >= $this->endHour) {
            $accessDenied = true;
        }

        if ($accessDenied) {
            // Calcule prochaine ouverture
            $nextOpen = clone $now;

            if ($day === 0) {
                // dimanche → lundi à 7h
                $nextOpen->modify('next monday')->setTime($this->startHour, 0);
            } elseif ($hour >= $this->endHour) {
                // après fermeture → demain à 7h (sauf si dimanche)
                $nextOpen->modify('+1 day')->setTime($this->startHour, 0);

                if ((int)$nextOpen->format('w') === 0) {
                    // Si demain c'est dimanche, passe à lundi
                    $nextOpen->modify('next monday');
                }
            } else {
                // Avant l'ouverture aujourd’hui → aujourd’hui à 7h
                $nextOpen->setTime($this->startHour, 0);
            }

            // Passe la date serveur à la vue
            $data = [
                'next_open_iso' => $nextOpen->format('c') // ISO 8601
            ];

            $html = view('errors/access_restricted', $data);
            return service('response')
                ->setStatusCode(403)
                ->setBody($html);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
