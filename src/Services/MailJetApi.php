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
                        'Email' => "service@ficheweb.fr",
                        'Name' => "Service EcoService"
                    ],
                    'To' => [
                        [
                            'Email' => $user->getEmail(),
                            'Name' => $user->getLastName() . ' ' . $user->getFirstName()
                        ]
                    ],
                    'Subject' => $objet,
                    'TextPart' => "",
                    'HTMLPart' => `
                <head>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
                </head>
                <body>
                <style>
                    body{
                        padding-left: 10px;
                        padding-right: 10px;
                    }
                    .p{
                        text-align: justify;
                    }
                    .p::first-letter{
                        font-size: 250%;
                    }
                    .footer-basic {
                        padding:40px 0;
                        background-color:#ffffff;
                        color:#4b4c4d;
                    }
              
                    .footer-basic ul {
                        padding:0;
                        list-style:none;
                        text-align:center;
                        font-size:18px;
                        line-height:1.6;
                        margin-bottom:0;
                    }
              
                    .footer-basic li {
                        padding:0 10px;
                    }
              
                    .footer-basic ul a {
                        color:inherit;
                        text-decoration:none;
                        opacity:0.8;
                    }
              
                    .footer-basic ul a:hover {
                        opacity:1;
                    }
              
                    .footer-basic .social {
                        text-align:center;
                        padding-bottom:25px;
                    }
              
                    .footer-basic .social > a {
                        font-size:24px;
                        width:40px;
                        height:40px;
                        line-height:40px;
                        display:inline-block;
                        text-align:center;
                        border-radius:50%;
                        border:1px solid #ccc;
                        margin:0 8px;
                        color:inherit;
                        opacity:0.75;
                    }
              
                    .footer-basic .social > a:hover {
                        opacity:0.9;
                    }
              
                    .footer-basic .copyright {
                        margin-top:15px;
                        text-align:center;
                        font-size:100%;
                        color:#aaa;
                        margin-bottom:0;
                
                    }
        
                    img{
                        width: 150px;
                        height: 150px;
                    }
        
        
                </style>
        
        
                <h1 class="text-center mt-3 mb-3">` . $titre . `</h1>
                <h5>Notre chèr(e) ` . $user->getLastName() . ` ` . $user->getFirstName() . `,</h5>
                <p class="p">
                        ` . $message . `
                </p>
        <h6>Merci de votre compréhension.</h6>
        
            <div class="footer-basic">
                <footer>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#">Acceuil</a></li>
                        <li class="list-inline-item"><a href="#">Services</a></li>
                        <li class="list-inline-item"><a href="#">A propos</a></li>
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                    </ul>
                    <p class="copyright"><img src="assets/image/logoEcoService.png"></p>
                    <p class="copyright">@2022</p>
                </footer>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        </body>`,

                ]
            ]
        ];
        $response = MailJetApi::getClient()->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }
}
