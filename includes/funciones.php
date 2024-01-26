<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

function is_auth() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function is_admin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() : void {
    $efectos = [
        "fade-up",
        "fade-down",
        "fade-left",
        "fade-right",
        "fade-up-right",
        "fade-up-left",
        "fade-down-right",
        "fade-down-left",
        "flip-up",
        "flip-down",
        "flip-left",
        "flip-right",
        "zoom-in",
        "zoom-in-up",
        "zoom-in-down",
        "zoom-in-left",
        "zoom-in-right",
        "zoom-out",
        "zoom-out-up",
        "zoom-out-down",
        "zoom-out-left",
        "zoom-out-right"
    ];

    $efecto = $efectos[array_rand($efectos)];

    echo ' data-aos="' . $efecto . '" ';
}