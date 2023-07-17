<?php

$sandboxCredentials = [
    "api_auth_url" => "https://sandbox-authservice.priaid.ch",
    "api_health_url" => "https://sandbox-healthservice.priaid.ch",
    "username" => "leandro.sanchezzarfino@gmail.com",
    "password" => "k8E6AnPo39KwJs27T"
];

$productionCredentials =  [
    "api_auth_url" => "https://authservice.priaid.ch",
    "api_health_url" => "https://healthservice.priaid.ch",
    "username" => "Kq98J_GMAIL_COM_AUT",
    "password" => "Nf7e5Q2YbGa3j8EDi"
];

return [
    "api" => [
        "credentials" => env('API_MODE') === 'sandbox' ? $sandboxCredentials : $productionCredentials,
        "routes" => [
            "login" => "login",
            "symptoms" => "symptoms",
            "diagnosis" => "diagnosis"
        ]
    ]
];
