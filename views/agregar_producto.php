<?php
/**
 * Modal flotante para agregar un producto/servicio en UTP-Market.
 * Inclúyelo una sola vez desde views/user-profile.php.
 * Nota: empresa_id debe asignarse desde la sesión/controlador; no se pide al usuario.
 * El campo categoria requiere que el proyecto tenga una columna/relación para guardarlo.
 */
?>
<div class="ap-overlay" id="apProductModal" aria-hidden="true">
  <section class="ap-modal" role="dialog" aria-modal="true" aria-labelledby="apModalTitle">
    <div class="ap-topline"><span class="ap-mark">UTP</span><span class="ap-toplabel">MARKET / NUEVA PUBLICACIÓN</span></div>
    <button class="ap-close" type="button" aria-label="Cerrar ventana" data-ap-close>&times;</button>

    <header class="ap-heading">
      <span class="ap-eyebrow">HAZ VISIBLE LO QUE OFRECES</span>
      <h2 id="apModalTitle">Publica algo <em>genial.</em></h2>
      <p>Agrega los detalles para que las personas conozcan tu producto o servicio.</p>
    </header>

    <form class="ap-form" id="apProductForm" method="post" enctype="multipart/form-data">
      <div class="ap-section-title"><span>01</span><div><strong>Información básica</strong><small>Cuéntanos lo esencial</small></div></div>
      <div class="ap-grid">
        <label class="ap-field ap-full">
          <span>Nombre de la publicación <b>*</b></span>
          <input type="text" name="nombre" placeholder="Ej. Diseño de página web" maxlength="150" required>
        </label>

        <label class="ap-field">
          <span>Tipo de publicación <b>*</b></span>
          <select name="categoria" required>
            <option value="" disabled selected>Selecciona una categoría</option>
            <option value="tecnologia">Tecnología y desarrollo</option>
            <option value="diseno">Diseño y creatividad</option>
            <option value="productos">Productos físicos</option>
            <option value="servicios">Servicios profesionales</option>
            <option value="educacion">Educación y asesorías</option>
            <option value="otros">Otros</option>
          </select>
          <small>La categoría debe estar contemplada en tu base de datos para guardarse.</small>
        </label>

        <label class="ap-field">
          <span>Precio (MXN) <b>*</b></span>
          <div class="ap-price"><span>$</span><input type="number" name="precio" placeholder="0.00" min="0" step="0.01" required></div>
        </label>

        <label class="ap-field ap-full">
          <span>Descripción <b>*</b></span>
          <textarea name="descripcion" rows="4" maxlength="2000" placeholder="¿Qué ofreces? Describe sus características, beneficios y detalles importantes..." required></textarea>
          <small class="ap-help">Una descripción clara ayuda a que tu publicación se entienda mejor.</small>
        </label>
      </div>

      <div class="ap-section-title ap-section-media"><span>02</span><div><strong>Contenido visual</strong><small>Opcional, pero recomendado</small></div></div>
      <div class="ap-grid">
        <label class="ap-field ap-full">
          <span>Imagen principal</span>
          <input class="ap-file" type="file" name="imagen" accept="image/png,image/jpeg,image/webp">
          <small>Formatos permitidos sugeridos: PNG, JPG o WEBP. El servidor debe validar el archivo.</small>
        </label>
        <label class="ap-field ap-full">
          <span>Enlace de video</span>
          <input type="url" name="url_video" placeholder="https://...">
          <small>Pega un enlace público si tienes un video que muestre tu producto o servicio.</small>
        </label>
      </div>

      <div class="ap-actions">
        <p class="ap-secure"><span class="ap-secure-dot"></span>Tu publicación se asociará con tu cuenta.</p>
        <div class="ap-action-buttons">
          <button class="ap-btn ap-btn-quiet" type="button" data-ap-close>Cancelar</button>
          <button class="ap-btn ap-btn-primary" type="submit">Guardar publicación <span aria-hidden="true">↗</span></button>
        </div>
      </div>
      <p class="ap-note">El formulario es visual; conecta el envío con tu controlador PHP para guardar los datos.</p>
    </form>
  </section>
</div>

<style>
  #apProductModal, #apProductModal *{box-sizing:border-box}
  .ap-overlay{position:fixed;inset:0;z-index:99999;display:none;align-items:center;justify-content:center;padding:22px;background:rgba(25,18,18,.68);backdrop-filter:blur(9px);-webkit-backdrop-filter:blur(9px)}
  .ap-overlay.ap-visible{display:flex;animation:apFade .2s ease-out}
  .ap-modal{position:relative;width:min(760px,100%);max-height:calc(100vh - 44px);overflow-y:auto;background:#fffdfa;border:1px solid rgba(255,255,255,.7);border-radius:26px;box-shadow:0 35px 100px rgba(14,8,8,.35);padding:30px 38px 27px;color:#2f2524;animation:apRise .24s cubic-bezier(.2,.8,.2,1)}
  .ap-topline{display:flex;align-items:center;gap:10px;margin-bottom:27px}.ap-mark{display:grid;place-items:center;width:35px;height:35px;border-radius:11px;background:#7a2e34;color:#fff;font-size:11px;font-weight:900;letter-spacing:-.5px;box-shadow:0 5px 13px #7a2e3430}.ap-toplabel{color:#9a8984;font-size:9px;font-weight:850;letter-spacing:1.65px}
  .ap-close{position:absolute;top:27px;right:29px;display:grid;place-items:center;width:39px;height:39px;border:1px solid #eee4df;border-radius:13px;background:#fff;color:#72544e;font-size:26px;line-height:1;cursor:pointer;transition:all .2s}.ap-close:hover{background:#f7ece8;color:#7a2e34;transform:rotate(90deg)}
  .ap-heading{padding-right:35px;margin-bottom:28px}.ap-eyebrow{display:block;margin-bottom:9px;color:#a14a4f;font-size:9px;font-weight:900;letter-spacing:2px}.ap-heading h2{margin:0;color:#302322;font-size:clamp(27px,4vw,36px);font-weight:850;letter-spacing:-1.25px;line-height:1.12}.ap-heading h2 em{color:#9b4147;font-style:normal}.ap-heading p{max-width:500px;margin:11px 0 0;color:#8a7b76;font-size:13px;line-height:1.65}
  .ap-section-title{display:flex;align-items:center;gap:12px;margin:0 0 17px;padding-bottom:13px;border-bottom:1px solid #f0e7e2}.ap-section-title>span{display:grid;place-items:center;width:31px;height:31px;border-radius:10px;background:#f5e9e6;color:#8e383e;font-size:10px;font-weight:900}.ap-section-title div{display:flex;flex-direction:column;gap:3px}.ap-section-title strong{color:#45312e;font-size:12px;font-weight:850}.ap-section-title small{color:#a18e87;font-size:10px}.ap-section-media{margin-top:25px}
  .ap-grid{display:grid;grid-template-columns:1fr 1fr;gap:17px}.ap-field{display:flex;min-width:0;flex-direction:column;gap:8px}.ap-full{grid-column:1/-1}.ap-field>span{color:#4b3935;font-size:11px;font-weight:800}.ap-field b{color:#a13b42}.ap-field input,.ap-field textarea,.ap-field select{width:100%;min-width:0;border:1px solid #e9ded8;border-radius:13px;background:#fff;padding:12px 14px;color:#352724;font:inherit;font-size:12px;outline:none;transition:border-color .2s,box-shadow .2s,background .2s}.ap-field input,.ap-field select{height:46px}.ap-field textarea{min-height:103px;resize:vertical;line-height:1.6}.ap-field input:focus,.ap-field textarea:focus,.ap-field select:focus{border-color:#a13b42;background:#fff;box-shadow:0 0 0 4px rgba(161,59,66,.09)}.ap-field input::placeholder,.ap-field textarea::placeholder{color:#b5a7a1}.ap-field select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238b7771' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:38px}.ap-field small{color:#a08f89;font-size:10px;line-height:1.5}.ap-help{text-align:right}
  .ap-price{position:relative}.ap-price>span{position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#927b74;font-size:13px}.ap-price input{padding-left:30px}.ap-field .ap-file{height:auto;padding:9px;background:#fcf8f5;font-size:11px}.ap-field input[type=file]::file-selector-button{margin-right:12px;padding:7px 10px;border:0;border-radius:8px;background:#f0e3de;color:#77433f;font-size:10px;font-weight:800;cursor:pointer}
  .ap-actions{display:flex;align-items:center;justify-content:space-between;gap:18px;margin-top:25px;padding-top:20px;border-top:1px solid #f0e7e2}.ap-secure{display:flex;align-items:center;gap:7px;margin:0;color:#93817b;font-size:10px}.ap-secure-dot{width:7px;height:7px;border-radius:50%;background:#6b9b78;box-shadow:0 0 0 4px #6b9b781c}.ap-action-buttons{display:flex;gap:9px}.ap-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;min-height:43px;padding:0 17px;border:1px solid transparent;border-radius:12px;font-size:11px;font-weight:850;cursor:pointer;transition:transform .2s,background .2s,box-shadow .2s}.ap-btn:hover{transform:translateY(-2px)}.ap-btn-quiet{background:#f5efeb;color:#735852}.ap-btn-quiet:hover{background:#eee2dc}.ap-btn-primary{background:#7a2e34;color:#fff;box-shadow:0 7px 18px rgba(122,46,52,.2)}.ap-btn-primary:hover{background:#61232a;box-shadow:0 10px 24px rgba(122,46,52,.27)}.ap-btn-primary span{font-size:16px}.ap-note{margin:12px 0 0;color:#b0a19b;font-size:9px;line-height:1.5;text-align:right}
  body.ap-lock{overflow:hidden}@keyframes apFade{from{opacity:0}to{opacity:1}}@keyframes apRise{from{opacity:0;transform:translateY(12px) scale(.985)}to{opacity:1;transform:translateY(0) scale(1)}}
  @media(max-width:620px){.ap-overlay{padding:9px}.ap-modal{max-height:calc(100vh - 18px);padding:23px 19px 20px;border-radius:20px}.ap-topline{margin-bottom:23px}.ap-close{top:20px;right:19px;width:35px;height:35px}.ap-heading{margin-bottom:24px}.ap-grid{grid-template-columns:1fr;gap:14px}.ap-full{grid-column:auto}.ap-actions{align-items:stretch;flex-direction:column;gap:14px}.ap-action-buttons{flex-direction:column-reverse}.ap-btn{width:100%}.ap-note{text-align:left}.ap-help{text-align:left}}
  @media(prefers-reduced-motion:reduce){.ap-overlay.ap-visible,.ap-modal{animation:none}.ap-close,.ap-btn{transition:none}}
</style>

<script>
(function () {
  const modal = document.getElementById('apProductModal');
  if (!modal || modal.dataset.apReady === '1') return;
  modal.dataset.apReady = '1';
  const closeButtons = modal.querySelectorAll('[data-ap-close]');
  let previousFocus = null;

  function openProductModal(event) {
    if (event) event.preventDefault();
    previousFocus = document.activeElement;
    modal.classList.add('ap-visible');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('ap-lock');
    const firstField = modal.querySelector('input:not([type="file"]), select, textarea');
    if (firstField) firstField.focus();
  }
  function closeProductModal() {
    modal.classList.remove('ap-visible');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('ap-lock');
    if (previousFocus && typeof previousFocus.focus === 'function') previousFocus.focus();
  }

  document.addEventListener('click', function (event) {
    const target = event.target;
    const trigger = target && typeof target.closest === 'function' ? target.closest('[data-ap-open]') : null;
    if (trigger) openProductModal(event);
  });
  closeButtons.forEach(button => button.addEventListener('click', closeProductModal));
  modal.addEventListener('click', function (event) {
    if (event.target === modal) closeProductModal();
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && modal.classList.contains('ap-visible')) closeProductModal();
  });
})();
</script>
