<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp.</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form action="/registro" method="post" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text" 
                class="formulario__input" 
                placeholder="Tu Nombre"
                id="nombre"
                name="nombre"
                value="<?php echo s($usuario->nombre); ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text" 
                class="formulario__input" 
                placeholder="Tu Apellido"
                id="apellido"
                name="apellido"
                value="<?php echo s($usuario->apellido); ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email" 
                class="formulario__input" 
                placeholder="Tu Email"
                id="email"
                name="email"
                value="<?php echo s($usuario->email); ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
                type="password" 
                class="formulario__input" 
                placeholder="Tu Contraseña"
                id="password"
                name="password"
            />
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Confirmar Contraseña</label>
            <input 
                type="password" 
                class="formulario__input" 
                placeholder="Repite tu Contraseña"
                id="password2"
                name="password2"
            />
        </div>

        <input type="submit" value="Crear Cuenta" class="formulario__submit">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tenes cuenta? Inicia Sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>

</main>