<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach($eventos['conferencias_v'] as $evento): ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach($eventos['conferencias_s'] as $evento): ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php endforeach; ?>
        </div>

        <h3 class="eventos-registro__heading--workshops">&lt;Workshops /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos['workshops_v'] as $evento): ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos['workshops_s'] as $evento): ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php endforeach; ?>
        </div>
    </main>

    <aside class="tu-registro">
        <h2 class="tu-registro__heading">Tu Registro</h2>

        <div id="tu-registro-resumen" class="tu-registro__resumen"></div>

        <div class="tu-registro__regalo">
            <label for="regalo" class="tu-registro__label">Selecciona un regalo</label>
            <select id="regalo" class="tu-registro__select">
                <option value="" >- Selecciona un regalo -</option>
                <?php foreach($regalos as $regalo): ?>
                    <option value="<?php echo s($regalo->id); ?>"><?php echo s($regalo->nombre); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <form id="registro" class="formulario">
            <div class="formulario__campo">
                <input type="submit" value="Registrarme" class="formulario__submit formulario__submit--full">
            </div>
        </form>
    </aside>
</div>