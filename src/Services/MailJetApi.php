<?php

namespace App\Services;


use \Mailjet\Resources;
use \Mailjet\Client;
use App\Entity\User;
use App\Service\MailJetAp;


class MailJetApi
{

    static private function getClient()
    {
        return new Client('0843d33c52ad141defeeff5a94eb0081', '71bb0e7dddb6eec924f71afc00cad193', true, ['version' => 'v3.1']);
    }

    static public function envoie(User $user, string $objet, string $titre, string $message)
    {

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'service@ficheweb.fr',
                        'Name' => 'Service EcoService'
                    ],
                    'To' => [
                        [
                            'Email' => $user->getEmail(),
                            'Name' => $user->getLastName() . ' ' . $user->getFirstName()
                        ]
                    ],
                    'Subject' => $objet,
                    'TextPart' => '',
                    'HTMLPart' => "
                <body>
        
                <h1 class='text-center mt-3 mb-3'>" . $titre . "</h1>
                <h5>Notre chèr(e) " . $user->getLastName() . " " . $user->getFirstName() . ",</h5>
                <p class='p'>
                        " . $message . "
                </p>
        <h6>Merci de votre compréhension.</h6>
        </body>",

                ]
            ]
        ];
        $response = MailJetApi::getClient()->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }
}
