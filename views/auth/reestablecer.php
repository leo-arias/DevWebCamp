<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">
        Ingresa tu nueva contraseña
    </p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php
        if($token_valido) :
    ?>

    <form method="POST" action="/reestablecer" class="formulario">
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

        <input type="submit" value="Cambiar Contraseña" class="formulario__submit">
    </form>

    <?php
        endif;
    ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tenes cuenta? Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿No tenes cuenta? Registrate</a>
    </div>

</main>