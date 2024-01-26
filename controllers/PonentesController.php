<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
    public static function index(Router $router) {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 10;
        $total = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($pagina_actual > $paginacion->total_paginas()) {
            header('Location: /admin/ponentes?page=' . $paginacion->total_paginas());
        }

        $pomentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        if(!is_admin()) {
            header('Location: /login');
        }

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $pomentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
    
            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = __DIR__ . '/../public/img/speakers';

                // Crear la carpeta de imágenes en caso de que no exista
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                // Generar un nombre único
                $nombre_imagen = md5(uniqid(rand(), true));

                // Agregar al POST
                $_POST['imagen'] = $nombre_imagen;
            }
            
            // Convertir el arreglo de redes a un string
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el registro
            if(empty($alertas)) {
                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . "/{$nombre_imagen}.png");
                $imagen_webp->save($carpeta_imagenes . "/{$nombre_imagen}.webp");

                // Guardar en la base de datos
                $resultado = $ponente->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        
        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/ponentes');
        }

        // Obtener el ponente
        $ponente = Ponente::find($id);

        if(!$ponente) {
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
    
            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = __DIR__ . '/../public/img/speakers';

                // Crear la carpeta de imágenes en caso de que no exista
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                // Generar un nombre único
                $nombre_imagen = md5(uniqid(rand(), true));

                // Agregar al POST
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            // Convertir el arreglo de redes a un string
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            // Sinconizar
            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el registro
            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    // Guardar las imagenes
                    $imagen_png->save($carpeta_imagenes . "/{$nombre_imagen}.png");
                    $imagen_webp->save($carpeta_imagenes . "/{$nombre_imagen}.webp");
                }

                // Guardar en la base de datos
                $resultado = $ponente->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }
        
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
    
            // Validar el ID
            $id = $_POST['id'];

            // Obtener el ponente
            $ponente = Ponente::find($id);

            if(!$ponente) {
                header('Location: /admin/ponentes');
            }

            // Eliminar la imagen
            $carpeta_imagenes = __DIR__ . '/../public/img/speakers';

            unlink($carpeta_imagenes . "/{$ponente->imagen}.png");
            unlink($carpeta_imagenes . "/{$ponente->imagen}.webp");

            // Eliminar el registro
            $resultado = $ponente->eliminar();

            if($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}