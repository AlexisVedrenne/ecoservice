<?php

namespace App\Services;


use \Mailjet\Resources;
use \Mailjet\Client;
use App\Entity\User;
use App\Service\Mailjet;


class MailJetApi
{

    static private function getClient()
    {
        return new Client('0843d33c52ad141defeeff5a94eb0081', '71bb0e7dddb6eec924f71afc00cad193', true, ['version' => 'v3.1']);
    }

    static public function envoieContact(string $mail, string $nom, string $tel, string $objet, string $msg)
  {

    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => "service@ficheweb.fr",
              'Name' => "Service Fiche Web"
            ]
          ],
          'Subject' => "Nouveau message",
          'TextPart' => "",

          'HTMLPart' => "<h1>Bonjour  vous venez de recevoir un nouveau message de la part de " . $nom . "</h1>
          <h3>Ses données personelles</h3>
          <h5>Email: " . $mail . " </h5>
          <h5>Tel: " . $tel . "</h5>
          <h5>Nom Complet:" . $nom . " </h5>
          <h3>Le message</h3>
          <h5>Objet: " . $objet . " </h5>
          <p>Le message: " . $msg . " </p>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest",

        ]
      ]
    ];
    $response = MailJetApi::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }


    static public function envoie(User $user,string $name, string $objet, string $message,string $titre)
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

    // Send a contact email 
    static public function send(string $mail,string $name, string $objet, string $message)
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
                            'Email' => $mail,
                            'Name' => $name 
                            
                            
                        ]
                    ],
                    'Subject' => $objet,
                    'TextPart' => '',
                    'HTMLPart' => "
                <body>
        
    
                <h5>Notre chèr(e) " . $name . "</h5>
                <p class='p'>
                        " . $message . "
                </p>

                <h6>Merci de votre compréhension.</h6>
                 </body>",

                ]
            ]
        ];

        $reponse = MailJetApi::getClient()->post(Ressources::$Email,['body'=>$body]);
        return $reponse->succes();
    }
    static public function mdpOublier(string $mail, int $code)
  {
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Eco Service "
          ],
          'To' => [
            [
              'Email' => $mail,
              'Name' => $mail
            ]
          ],
          'Subject' => "[FicheWeb Suppot] Mot de passe oublier",
          'TextPart' => "Support",
          'HTMLPart' => "<h1>Demande de nouveau mot de passe</h1>
          <p>Si vous n'etes pas à l'origne de cette demande ignorer ce mail.<br> Voici votre code générer automatiquement<br>
            <h1>" . $code . "</h1>
          </p>
          <h4>L'équipe FicheWeb</h4>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = MailJetApi::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }
}
