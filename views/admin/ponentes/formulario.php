<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre" 
            placeholder="Nombre del ponente" 
            value="<?php echo s($ponente->nombre); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input 
            type="text" 
            class="formulario__input"
            name="apellido" 
            id="apellido" 
            placeholder="Apellido del ponente" 
            value="<?php echo s($ponente->apellido); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="ciudad" class="formulario__label">Ciudad</label>
        <input 
            type="text" 
            class="formulario__input"
            name="ciudad" 
            id="ciudad" 
            placeholder="Ciudad del ponente" 
            value="<?php echo s($ponente->ciudad); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="pais" class="formulario__label">País</label>
        <input 
            type="text" 
            class="formulario__input"
            name="pais" 
            id="pais" 
            placeholder="País del ponente" 
            value="<?php echo s($ponente->pais); ?>"
        />
    </div>

    
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input 
            type="file" 
            class="formulario__input formulario__input--file"
            name="imagen" 
            id="imagen"
        />
    </div>

    <?php if(isset($ponente->imagen_actual)) : ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.png" alt="Imagen del ponente">
            </picture>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="tags_input" class="formulario__label">Áreas de Experiencía (separadas por coma)</label>
        <input 
            type="text" 
            class="formulario__input"
            name="tags_input" 
            id="tags_input" 
            placeholder="Ej: Node.js, React, PHP, etc."
        />

        <div id="tags"  class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo s($ponente->tags) ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[facebook]"
                placeholder="Facebook del ponente" 
                value="<?php echo $redes->facebook ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[twitter]"
                placeholder="Twitter del ponente" 
                value="<?php echo $redes->twitter ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[youtube]"
                placeholder="Youtube del ponente" 
                value="<?php echo $redes->youtube ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[instagram]"
                placeholder="Instagram del ponente" 
                value="<?php echo $redes->instagram ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[tiktok]"
                placeholder="TikTok del ponente" 
                value="<?php echo $redes->tiktok ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text" 
                class="formulario__input--sociales"
                name="redes[github]"
                placeholder="Github del ponente"
                value="<?php echo $redes->github ?? ''; ?>"
            />
        </div>
    </div>
</fieldset>

