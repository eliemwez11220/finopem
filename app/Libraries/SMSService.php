<?php

namespace App\Libraries;

class SMSService
{
    // Paramètres d'authentification de l'API
    //"https://api2.dream-digital.info/api/SendSMS?api_id=API19926725443&api_password=LQ8Ha8hc5&sms_type=T&encoding=T&sender_id=$sender_name&phonenumber=$to&textmessage=$message";
                
    private $apiUrl = 'https://api2.dream-digital.info/api/SendSMS';
    private $apiId = 'API23247045131'; // Remplacez par votre identifiant API
    private $apiPassword = 'dutOpeEo1i'; // Remplacez par votre mot de passe API

    /**
     * Fonction pour envoyer un SMS via l'API de Dream Digital
     *
     * @param string $to Numéro de téléphone du destinataire (incluant l'indicatif international)
     * @param string $message Contenu du message à envoyer
     * @param string $sender_name Nom de l'expéditeur qui apparaîtra (11 caractères max)
     * @return bool|array Retourne `true` en cas de succès ou un tableau d'erreurs
     */
    public function sendSMS($to, $message, $sender_name)
    {
        // Paramètres de la requête
        $params = [
            'api_id' => $this->apiId,
            'api_password' => $this->apiPassword,
            'sms_type' => 'T', // Type du message : "T" pour texte
            'encoding' => 'T', // Encodage du message : "T" pour texte
            'sender_id' => $sender_name,
            'phonenumber' => $to,
            'textmessage' => $message
        ];

        // Initialiser cURL
        $curl = curl_init();

        // Construire l'URL avec les paramètres
        $url = $this->apiUrl . '?' . http_build_query($params);

        // Configurer les options de cURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false, // Désactive la vérification SSL (selon le besoin)
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        // Exécuter la requête
        $response = curl_exec($curl);
        $error = curl_error($curl);

        // Fermer la session cURL
        curl_close($curl);

        // Vérifier si une erreur s'est produite
        if ($error) {
            return ['error' => true, 'message' => 'Erreur cURL: ' . $error];
        }

        // Décoder la réponse si nécessaire (ex: JSON)
        // Ici on suppose que l'API renvoie une réponse en texte brut ou JSON (à adapter selon l'API)
        $decodedResponse = json_decode($response, true);

        // Si le décodage a échoué, retourner la réponse brute
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => false, 'response' => $response];
        }

        // Traiter la réponse en fonction des spécifications de l'API
        if (isset($decodedResponse['status']) && $decodedResponse['status'] == 'success') {
            return true; // Succès
        } else {
            return ['error' => true, 'message' => 'Échec de l\'envoi: ' . ($decodedResponse['message'] ?? 'Erreur inconnue')];
        }
    }
}
