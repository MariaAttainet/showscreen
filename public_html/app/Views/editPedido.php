<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/amiga') ?>
<?php
        $estados_texto = [
            "0" => "Pendiente de material",
            "1" => "Falta Material",
            "2" => "Material recibido",
            "3" => "En Máquinas",
            "4" => "Terminado",
            "5" => "Entregado",
            "6" => "Anulado"
        ];
        ?>

<link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/pedido.css') ?>?v=<?= time() ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/libreria.css') ?>?v=<?= time() ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
    /* Aplica el z-index solo a los Select2 dentro del modal */
    #editarLineaModal .select2-container {
        z-index: 2050 !important;
        /* Asegura que el dropdown de Select2 se muestre sobre el modal */
    }
</style>
<div class="container mt-5 editpedido">

    <h2 class="titleditPedido">Editar Pedido</h2>
    <div class="mb-3">
    <span class="badge bg-secondary" style="font-size: 16px;">
        Estado actual: <strong><?= $estados_texto[$pedido->estado] ?? 'Desconocido' ?></strong>
    </span>
    <?php if ($pedido->bt_imprimir == 0): ?>
                <span class="badge bg-warning" style="font-size: 12px;">Pedido en Redacción</span>
    <?php endif; ?>  
    <?php if ($pedido->bt_imprimir == 1): ?>
                <span class="badge bg-warning" style="font-size: 12px;">Pendiente de imprimir</span>
    <?php endif; ?>
    <?php if ($pedido->bt_imprimir == 2): ?>
                <span class="badge bg-success" style="font-size: 12px;">Pedido impreso</span>
    <?php endif; ?>
</div>
    <div class="mb-3">
        <label for="acciones" class="form-label"></label>
        <div class="d-flex gap-2"> 
            <?php if (!empty($pedido->bt_imprimir)): ?>
                <a href="<?= base_url('pedidos/print/' . $pedido->id_pedido . '?volver=' . urlencode(current_url())) ?>"
                    class="boton btnImprimir" target="_blank">
                    Imprimir Pedido
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                        <path
                            d="M8.71593 4.72729C8.16741 4.72729 7.64136 4.95853 7.2535 5.37014C6.86564 5.78174 6.64774 6.34 6.64774 6.9221V9.11691H5.61365C5.06514 9.11691 4.53909 9.34814 4.15123 9.75975C3.76337 10.1714 3.54547 10.7296 3.54547 11.3117L3.54547 14.6039C3.54547 15.186 3.76337 15.7443 4.15123 16.1559C4.53909 16.5675 5.06514 16.7987 5.61365 16.7987H6.64774V17.8961C6.64774 18.4782 6.86564 19.0365 7.2535 19.4481C7.64136 19.8597 8.16741 20.0909 8.71593 20.0909H14.9205C15.469 20.0909 15.995 19.8597 16.3829 19.4481C16.7708 19.0365 16.9887 18.4782 16.9887 17.8961V16.7987H18.0227C18.5713 16.7987 19.0973 16.5675 19.4852 16.1559C19.873 15.7443 20.0909 15.186 20.0909 14.6039V11.3117C20.0909 10.7296 19.873 10.1714 19.4852 9.75975C19.0973 9.34814 18.5713 9.11691 18.0227 9.11691H16.9887V6.9221C16.9887 6.34 16.7708 5.78174 16.3829 5.37014C15.995 4.95853 15.469 4.72729 14.9205 4.72729H8.71593ZM7.68184 6.9221C7.68184 6.63105 7.79078 6.35192 7.98471 6.14612C8.17864 5.94032 8.44167 5.8247 8.71593 5.8247H14.9205C15.1947 5.8247 15.4578 5.94032 15.6517 6.14612C15.8456 6.35192 15.9546 6.63105 15.9546 6.9221V9.11691H7.68184V6.9221ZM8.71593 12.4091C8.16741 12.4091 7.64136 12.6404 7.2535 13.052C6.86564 13.4636 6.64774 14.0218 6.64774 14.6039V15.7013H5.61365C5.3394 15.7013 5.07637 15.5857 4.88244 15.3799C4.68851 15.1741 4.57956 14.895 4.57956 14.6039V11.3117C4.57956 11.0207 4.68851 10.7415 4.88244 10.5357C5.07637 10.3299 5.3394 10.2143 5.61365 10.2143H18.0227C18.297 10.2143 18.56 10.3299 18.754 10.5357C18.9479 10.7415 19.0568 11.0207 19.0568 11.3117V14.6039C19.0568 14.895 18.9479 15.1741 18.754 15.3799C18.56 15.5857 18.297 15.7013 18.0227 15.7013H16.9887V14.6039C16.9887 14.0218 16.7708 13.4636 16.3829 13.052C15.995 12.6404 15.469 12.4091 14.9205 12.4091H8.71593ZM15.9546 14.6039V17.8961C15.9546 18.1872 15.8456 18.4663 15.6517 18.6721C15.4578 18.8779 15.1947 18.9935 14.9205 18.9935H8.71593C8.44167 18.9935 8.17864 18.8779 7.98471 18.6721C7.79078 18.4663 7.68184 18.1872 7.68184 17.8961V14.6039C7.68184 14.3129 7.79078 14.0337 7.98471 13.8279C8.17864 13.6221 8.44167 13.5065 8.71593 13.5065H14.9205C15.1947 13.5065 15.4578 13.6221 15.6517 13.8279C15.8456 14.0337 15.9546 14.3129 15.9546 14.6039Z"
                            fill="black" fill-opacity="0.6" />
                    </svg>
                </a>
            
            <a href="<?= base_url('pedidos/parte_complejo/' . $pedido->id_pedido . '?volver=' . urlencode(current_url())) ?>"
                class="boton btnImprimir" target="_blank">
                Parte Complejo
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path
                        d="M9.86206 7.5C9.86206 6.96957 10.0962 6.46086 10.5129 6.08579C10.9297 5.71071 11.4949 5.5 12.0843 5.5H20.9732C21.5625 5.5 22.1278 5.71071 22.5445 6.08579C22.9613 6.46086 23.1954 6.96957 23.1954 7.5V19.5C23.1954 20.0304 22.9613 20.5391 22.5445 20.9142C22.1278 21.2893 21.5625 21.5 20.9732 21.5H12.0843C11.4949 21.5 10.9297 21.2893 10.5129 20.9142C10.0962 20.5391 9.86206 20.0304 9.86206 19.5V7.5ZM12.0843 6.5C11.7896 6.5 11.507 6.60536 11.2986 6.79289C11.0902 6.98043 10.9732 7.23478 10.9732 7.5V11.5H22.0843V7.5C22.0843 7.23478 21.9672 6.98043 21.7588 6.79289C21.5505 6.60536 21.2679 6.5 20.9732 6.5H12.0843ZM22.0843 12.5H14.3065V14.5H22.0843V12.5ZM22.0843 15.5H14.3065V17.5H22.0843V15.5ZM22.0843 18.5H14.3065V20.5H20.9732C21.2679 20.5 21.5505 20.3946 21.7588 20.2071C21.9672 20.0196 22.0843 19.7652 22.0843 19.5V18.5ZM13.1954 20.5V18.5H10.9732V19.5C10.9732 19.7652 11.0902 20.0196 11.2986 20.2071C11.507 20.3946 11.7896 20.5 12.0843 20.5H13.1954ZM10.9732 17.5H13.1954V15.5H10.9732V17.5ZM10.9732 14.5H13.1954V12.5H10.9732V14.5Z"
                        fill="black" fill-opacity="0.6" />
                </svg>
            </a>
            <?php endif; ?>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Rutas de transporte</h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="modalContent" style="padding: 0;">
                            <div class="text-center" id="loading">
                                <p>Cargando...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('pedidos/entregar/' . $pedido->id_pedido) ?>" class="boton btnTerminar">
                Entregar Pedido
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                    <path
                        d="M14.5763 8.57625C14.8052 8.35832 15.1098 8.23784 15.4258 8.24023C15.7419 8.24262 16.0446 8.3677 16.2702 8.58907C16.4958 8.81044 16.6266 9.11079 16.6349 9.42673C16.6433 9.74268 16.5286 10.0495 16.315 10.2825L9.83126 18.3913C9.71977 18.5113 9.58521 18.6077 9.43563 18.6746C9.28604 18.7415 9.1245 18.7775 8.96067 18.7806C8.79684 18.7836 8.63408 18.7536 8.48212 18.6923C8.33016 18.6309 8.19212 18.5396 8.07626 18.4238L3.77651 14.124C3.65677 14.0124 3.56073 13.8779 3.49412 13.7284C3.42751 13.5789 3.39169 13.4175 3.3888 13.2539C3.38591 13.0902 3.41602 12.9277 3.47731 12.7759C3.53861 12.6241 3.62984 12.4863 3.74557 12.3706C3.8613 12.2548 3.99916 12.1636 4.15092 12.1023C4.30267 12.041 4.46522 12.0109 4.62886 12.0138C4.7925 12.0167 4.95389 12.0525 5.10339 12.1191C5.25288 12.1857 5.38744 12.2818 5.49901 12.4015L8.90176 15.8026L14.5438 8.612L14.5763 8.57625ZM13.0813 16.9288L14.5763 18.4238C14.6921 18.5394 14.83 18.6305 14.9818 18.6916C15.1336 18.7528 15.2962 18.7828 15.4598 18.7797C15.6235 18.7767 15.7848 18.7407 15.9343 18.674C16.0837 18.6072 16.2182 18.5111 16.3296 18.3913L22.8166 10.2825C22.9332 10.1675 23.0253 10.0301 23.0876 9.87865C23.1499 9.7272 23.181 9.56475 23.1791 9.401C23.1771 9.23726 23.1423 9.07558 23.0765 8.92562C23.0107 8.77566 22.9154 8.6405 22.7962 8.5282C22.677 8.4159 22.5364 8.32877 22.3828 8.27201C22.2292 8.21525 22.0657 8.19003 21.9022 8.19786C21.7386 8.20568 21.5783 8.24638 21.4308 8.31754C21.2833 8.38869 21.1517 8.48884 21.0438 8.612L15.4001 15.8026L14.612 15.0129L13.0813 16.9288Z"
                        fill="white" />
                </svg>
            </a>
            <a href="<?= base_url('pedidos/anular/' . $pedido->id_pedido) ?>" class="boton btnEliminar">
                Anular Pedido
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                    <path
                        d="M7.66752 7.27601C7.41731 7.27601 7.17736 7.37594 7.00044 7.5538C6.82351 7.73167 6.72412 7.9729 6.72412 8.22444V9.17287C6.72412 9.42441 6.82351 9.66564 7.00044 9.84351C7.17736 10.0214 7.41731 10.1213 7.66752 10.1213H8.13922V18.6571C8.13922 19.1602 8.338 19.6427 8.69184 19.9984C9.04569 20.3542 9.5256 20.554 10.026 20.554H15.6864C16.1868 20.554 16.6667 20.3542 17.0205 19.9984C17.3744 19.6427 17.5732 19.1602 17.5732 18.6571V10.1213H18.0449C18.2951 10.1213 18.535 10.0214 18.712 9.84351C18.8889 9.66564 18.9883 9.42441 18.9883 9.17287V8.22444C18.9883 7.9729 18.8889 7.73167 18.712 7.5538C18.535 7.37594 18.2951 7.27601 18.0449 7.27601H14.743C14.743 7.02448 14.6436 6.78324 14.4667 6.60538C14.2898 6.42751 14.0498 6.32759 13.7996 6.32759H11.9128C11.6626 6.32759 11.4226 6.42751 11.2457 6.60538C11.0688 6.78324 10.9694 7.02448 10.9694 7.27601H7.66752ZM10.4977 11.0697C10.6228 11.0697 10.7428 11.1197 10.8312 11.2086C10.9197 11.2976 10.9694 11.4182 10.9694 11.5439V18.1829C10.9694 18.3087 10.9197 18.4293 10.8312 18.5183C10.7428 18.6072 10.6228 18.6571 10.4977 18.6571C10.3726 18.6571 10.2526 18.6072 10.1642 18.5183C10.0757 18.4293 10.026 18.3087 10.026 18.1829V11.5439C10.026 11.4182 10.0757 11.2976 10.1642 11.2086C10.2526 11.1197 10.3726 11.0697 10.4977 11.0697ZM12.8562 11.0697C12.9813 11.0697 13.1013 11.1197 13.1897 11.2086C13.2782 11.2976 13.3279 11.4182 13.3279 11.5439V18.1829C13.3279 18.3087 13.2782 18.4293 13.1897 18.5183C13.1013 18.6072 12.9813 18.6571 12.8562 18.6571C12.7311 18.6571 12.6111 18.6072 12.5227 18.5183C12.4342 18.4293 12.3845 18.3087 12.3845 18.1829V11.5439C12.3845 11.4182 12.4342 11.2976 12.5227 11.2086C12.6111 11.1197 12.7311 11.0697 12.8562 11.0697ZM15.6864 11.5439V18.1829C15.6864 18.3087 15.6367 18.4293 15.5482 18.5183C15.4598 18.6072 15.3398 18.6571 15.2147 18.6571C15.0896 18.6571 14.9696 18.6072 14.8811 18.5183C14.7927 18.4293 14.743 18.3087 14.743 18.1829V11.5439C14.743 11.4182 14.7927 11.2976 14.8811 11.2086C14.9696 11.1197 15.0896 11.0697 15.2147 11.0697C15.3398 11.0697 15.4598 11.1197 15.5482 11.2086C15.6367 11.2976 15.6864 11.4182 15.6864 11.5439Z"
                        fill="white" />
                </svg>
            </a>
            <?php
            $data = datos_user();
            $nivel_acceso = $data['nivel'];
            ?>
            <?php if ($nivel_acceso >= 7): ?>
                <button type="button" class="boton btnDuplicar" id="duplicarPedido">
                    Duplicar Pedido
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                    </svg>
                </button>
            <?php endif; ?>
            <?php if (empty($pedido->incidencia)): ?>
                <button type="button" class="boton btnAbrirIncidencia" id="abrirIncidencia" style="background-color: blue; color: white;" data-bs-toggle="modal" data-bs-target="#abrirIncidenciaModal">
                    Abrir Incidencia
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                        <path d="M13 7C13.2155 7 13.4222 7.0856 13.5745 7.23798C13.7269 7.39035 13.8125 7.59701 13.8125 7.8125V12.6875H18.6875C18.903 12.6875 19.1097 12.7731 19.262 12.9255C19.4144 13.0778 19.5 13.2845 19.5 13.5C19.5 13.7155 19.4144 13.9222 19.262 14.0745C19.1097 14.2269 18.903 14.3125 18.6875 14.3125H13.8125V19.1875C13.8125 19.403 13.7269 19.6097 13.5745 19.762C13.4222 19.9144 13.2155 20 13 20C12.7845 20 12.5778 19.9144 12.4255 19.762C12.2731 19.6097 12.1875 19.403 12.1875 19.1875V14.3125H7.3125C7.09701 14.3125 6.89035 14.2269 6.73798 14.0745C6.5856 13.9222 6.5 13.7155 6.5 13.5C6.5 13.2845 6.5856 13.0778 6.73798 12.9255C6.89035 12.7731 7.09701 12.6875 7.3125 12.6875H12.1875V7.8125C12.1875 7.59701 12.2731 7.39035 12.4255 7.23798C12.5778 7.0856 12.7845 7 13 7Z" fill="white" />
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
    <form action="<?= base_url('pedidos/update/' . $pedido->id_pedido) ?>" method="post" class="formeditPedido">
        <div class="form-group">
            <label for="id_cliente">Empresa:</label>
            <select id="id_cliente" name="id_cliente" class="form-control" required>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id_cliente'] ?>" <?= $pedido->id_cliente == $cliente['id_cliente'] ? 'selected' : '' ?>>
                        <?= $cliente['nombre_cliente'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="referencia">Referencia:</label>
            <input type="text" id="referencia" name="referencia" class="form-control"
                value="<?= esc($pedido->referencia) ?>">
        </div>
        <div class="form-group">
            <label for="referencia">Albarán:</label>
            <input type="text" id="albaran" name="albaran" class="form-control"
                value="<?= esc($pedido->albaran) ?>">
        </div>
        <div class="form-group">
            <label for="fecha_entrada">Fecha de Entrada:</label>
            <input type="date" id="fecha_entrada" name="fecha_entrada" class="form-control"
                value="<?= esc($pedido->fecha_entrada) ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega:</label>
            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control"
                value="<?= esc($pedido->fecha_entrega) ?>" required>
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" class="form-control"
                style="height: 60px;"><?= esc($pedido->observaciones) ?></textarea>
        </div>
        <?php if (!empty($pedido->incidencia)): ?>
    <div class="form-group col-12 d-flex" style="background-color: 
        <?= $pedido->estado_incidencia == 1 ? 'orange' : ($pedido->estado_incidencia == 2 ? '#00bfff' : '#ccffcc') ?>; 
        padding: 10px; border-radius: 5px;">
    <div class="form-group col-2 ps-2" style="margin-right:10px"
            <label for="estado_incidencia">Estado de la incidencia:</label>
            <select id="estado_incidencia" name="estado_incidencia" class="form-control" onchange="actualizarEstadoIncidencia(<?= $pedido->id_pedido ?>, this.value)">
                <option value="1" <?= $pedido->estado_incidencia == 1 ? 'selected' : '' ?>>Incidencia abierta</option>
                <option value="2" <?= $pedido->estado_incidencia == 2 ? 'selected' : '' ?>>En espera</option>
                <option value="3" <?= $pedido->estado_incidencia == 3 ? 'selected' : '' ?>>Cerrada</option>
            </select>
        </div>    
    <div class="form-group col-10 pe-2">
            <label for="incidencia">Incidencia:</label>
            <textarea id="incidencia" name="incidencia" class="form-control" rows="5"><?= esc($pedido->incidencia) ?></textarea>
        </div>
        
    </div>
<?php endif; ?>
      
        <div class="form-group" style="font-size:15px;">
            <label>ID del Pedido:</label>
            <strong><?= esc($pedido->id_pedido) ?></strong> <label>- pedido por:</label> <strong><?= esc($pedido->pedido_por) ?></strong>
        </div>
        <div class="btnsEditPedido">
            <a href="<?= base_url('/pedidos/enmarcha') ?>" class="boton volverButton">
                Volver
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M19.5 13C19.5 13.2155 19.4144 13.4221 19.262 13.5745C19.1096 13.7269 18.903 13.8125 18.6875 13.8125H9.27386L12.7627 17.2997C12.8383 17.3753 12.8982 17.465 12.9391 17.5637C12.98 17.6624 13.001 17.7682 13.001 17.875C13.001 17.9818 12.98 18.0876 12.9391 18.1863C12.8982 18.285 12.8383 18.3747 12.7627 18.4502C12.6872 18.5258 12.5975 18.5857 12.4988 18.6266C12.4001 18.6675 12.2943 18.6885 12.1875 18.6885C12.0807 18.6885 11.9749 18.6675 11.8762 18.6266C11.7775 18.5857 11.6878 18.5258 11.6122 18.4502L6.73724 13.5752C6.66157 13.4998 6.60154 13.4101 6.56058 13.3114C6.51962 13.2127 6.49854 13.1069 6.49854 13C6.49854 12.8931 6.51962 12.7873 6.56058 12.6886C6.60154 12.5899 6.66157 12.5002 6.73724 12.4247L11.6122 7.54974C11.7648 7.39717 11.9717 7.31146 12.1875 7.31146C12.4032 7.31146 12.6102 7.39717 12.7627 7.54974C12.9153 7.7023 13.001 7.90923 13.001 8.12499C13.001 8.34075 12.9153 8.54767 12.7627 8.70024L9.27386 12.1875H18.6875C18.903 12.1875 19.1096 12.2731 19.262 12.4255C19.4144 12.5778 19.5 12.7845 19.5 13Z"
                        fill="white" />
                </svg>
            </a>
            <button type="submit" class="boton btnGuardar">
                Guardar Cambios
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 27" fill="none">
                    <path
                        d="M7.11751 6.91875C6.86324 6.91875 6.61937 7.01976 6.43957 7.19956C6.25977 7.37936 6.15876 7.62322 6.15876 7.8775V19.3825C6.15876 19.6368 6.25977 19.8806 6.43957 20.0604C6.61937 20.2402 6.86324 20.3413 7.11751 20.3413H18.6225C18.8768 20.3413 19.1207 20.2402 19.3005 20.0604C19.4803 19.8806 19.5813 19.6368 19.5813 19.3825V7.8775C19.5813 7.62322 19.4803 7.37936 19.3005 7.19956C19.1207 7.01976 18.8768 6.91875 18.6225 6.91875H14.3081C14.0539 6.91875 13.81 7.01976 13.6302 7.19956C13.4504 7.37936 13.3494 7.62322 13.3494 7.8775V14.8697L15.8862 12.3319C15.9763 12.2418 16.0983 12.1913 16.2256 12.1913C16.3529 12.1913 16.475 12.2418 16.565 12.3319C16.655 12.4219 16.7056 12.544 16.7056 12.6712C16.7056 12.7985 16.655 12.9206 16.565 13.0106L13.2094 16.3663C13.1649 16.4109 13.112 16.4463 13.0537 16.4705C12.9955 16.4947 12.9331 16.5071 12.87 16.5071C12.807 16.5071 12.7445 16.4947 12.6863 16.4705C12.628 16.4463 12.5751 16.4109 12.5306 16.3663L9.17499 13.0106C9.13042 12.9661 9.09506 12.9132 9.07094 12.8549C9.04682 12.7967 9.03441 12.7343 9.03441 12.6712C9.03441 12.6082 9.04682 12.5458 9.07094 12.4876C9.09506 12.4293 9.13042 12.3764 9.17499 12.3319C9.21956 12.2873 9.27247 12.2519 9.33071 12.2278C9.38894 12.2037 9.45136 12.1913 9.51439 12.1913C9.57742 12.1913 9.63983 12.2037 9.69807 12.2278C9.7563 12.2519 9.80921 12.2873 9.85379 12.3319L12.3906 14.8697V7.8775C12.3906 7.36895 12.5927 6.88122 12.9523 6.52162C13.3119 6.16202 13.7996 5.96 14.3081 5.96H18.6225C19.1311 5.96 19.6188 6.16202 19.9784 6.52162C20.338 6.88122 20.54 7.36895 20.54 7.8775V19.3825C20.54 19.8911 20.338 20.3788 19.9784 20.7384C19.6188 21.098 19.1311 21.3 18.6225 21.3H7.11751C6.60896 21.3 6.12124 21.098 5.76164 20.7384C5.40203 20.3788 5.20001 19.8911 5.20001 19.3825V7.8775C5.20001 7.36895 5.40203 6.88122 5.76164 6.52162C6.12124 6.16202 6.60896 5.96 7.11751 5.96H9.51439C9.64153 5.96 9.76346 6.0105 9.85336 6.1004C9.94326 6.19031 9.99376 6.31224 9.99376 6.43937C9.99376 6.56651 9.94326 6.68844 9.85336 6.77834C9.76346 6.86824 9.64153 6.91875 9.51439 6.91875H7.11751Z"
                        fill="white" />
                </svg>
            </button>
        </div>
    </form>
    <div class="contenedor-tabla-boton" style="width: 100%;">
        <!-- Cargo las rutas de transporte de este pedido -->
        <div class="row">
            <div class="col-12">
                <h3>Rutas de Transporte</h3>
            
            <div class="col-12">
            <button type="button" class="boton btnEditar" id="openModal" data-bs-toggle="modal" data-bs-target="#myModal">
                Rutas de transporte
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                    <path d="M4.43903 9.69455C4.43903 9.27424 4.60814 8.87114 4.90917 8.57393C5.2102 8.27673 5.61849 8.10976 6.04421 8.10976H15.6753C16.101 8.10976 16.5093 8.27673 16.8103 8.57393C17.1114 8.87114 17.2805 9.27424 17.2805 9.69455V11.2793H18.372C18.6125 11.2796 18.8499 11.3331 19.0666 11.4361C19.2833 11.539 19.4738 11.6888 19.6241 11.8742L21.2089 13.8288C21.4369 14.11 21.5611 14.4595 21.561 14.8198V17.0903C21.561 17.5106 21.3919 17.9137 21.0908 18.2109C20.7898 18.5081 20.3815 18.6751 19.9558 18.6751H19.4207C19.4207 19.2355 19.1952 19.7729 18.7939 20.1692C18.3925 20.5655 17.8481 20.7881 17.2805 20.7881C16.7129 20.7881 16.1685 20.5655 15.7671 20.1692C15.3657 19.7729 15.1402 19.2355 15.1402 18.6751H9.78964C9.79025 18.9567 9.73383 19.2357 9.62368 19.4955C9.51354 19.7553 9.3519 19.9907 9.14826 20.188C8.94462 20.3852 8.70309 20.5403 8.43788 20.6441C8.17267 20.7478 7.88912 20.7982 7.6039 20.7922C7.31869 20.7862 7.03757 20.724 6.77706 20.6092C6.51655 20.4944 6.28192 20.3293 6.08696 20.1237C5.89199 19.9181 5.74063 19.6761 5.64177 19.4119C5.54291 19.1477 5.49855 18.8666 5.51129 18.5853C5.19779 18.4763 4.92628 18.274 4.73421 18.0062C4.54215 17.7384 4.43901 17.4184 4.43903 17.0903V9.69455ZM5.82376 17.572C6.01745 17.2596 6.29009 17.0022 6.61493 16.8251C6.93978 16.6481 7.30567 16.5574 7.6767 16.5621C8.04772 16.5668 8.41114 16.6667 8.73129 16.8519C9.05144 17.0371 9.31732 17.3013 9.50284 17.6185H15.427C15.6149 17.2973 15.885 17.0306 16.2104 16.8452V9.69455C16.2104 9.55445 16.154 9.42008 16.0537 9.32101C15.9533 9.22194 15.8172 9.16629 15.6753 9.16629H6.04421C5.9023 9.16629 5.76621 9.22194 5.66586 9.32101C5.56552 9.42008 5.50915 9.55445 5.50915 9.69455V17.0903C5.50906 17.1919 5.5387 17.2915 5.59451 17.377C5.65032 17.4624 5.72992 17.5302 5.82376 17.572ZM17.2805 16.562C17.6562 16.562 18.0252 16.6597 18.3506 16.8451C18.6759 17.0306 18.9461 17.2973 19.1339 17.6185H19.9558C20.0977 17.6185 20.2338 17.5629 20.3341 17.4638C20.4345 17.3647 20.4909 17.2304 20.4909 17.0903V14.8187C20.4906 14.6988 20.4491 14.5826 20.3731 14.4891L18.7894 12.5345C18.7393 12.4726 18.6758 12.4227 18.6036 12.3883C18.5314 12.3539 18.4522 12.336 18.372 12.3359H17.2805V16.562ZM7.64939 17.6185C7.36558 17.6185 7.09339 17.7298 6.8927 17.928C6.69201 18.1261 6.57927 18.3949 6.57927 18.6751C6.57927 18.9553 6.69201 19.224 6.8927 19.4221C7.09339 19.6203 7.36558 19.7316 7.64939 19.7316C7.93321 19.7316 8.2054 19.6203 8.40608 19.4221C8.60677 19.224 8.71951 18.9553 8.71951 18.6751C8.71951 18.3949 8.60677 18.1261 8.40608 17.928C8.2054 17.7298 7.93321 17.6185 7.64939 17.6185ZM17.2805 17.6185C16.9967 17.6185 16.7245 17.7298 16.5238 17.928C16.3231 18.1261 16.2104 18.3949 16.2104 18.6751C16.2104 18.9553 16.3231 19.224 16.5238 19.4221C16.7245 19.6203 16.9967 19.7316 17.2805 19.7316C17.5643 19.7316 17.8365 19.6203 18.0372 19.4221C18.2379 19.224 18.3506 18.9553 18.3506 18.6751C18.3506 18.3949 18.2379 18.1261 18.0372 17.928C17.8365 17.7298 17.5643 17.6185 17.2805 17.6185Z" fill="white" />
                </svg>
            </button>
            </div><br>
        </div>
        <?php if (!empty($rutas)) : ?>
            <div class="ag-root-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Transportista</th>
                            <th>Observaciones</th>
                            <th>Población</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rutas as $ruta) : ?>
                            <tr style="--bs-table-bg: <?= esc($ruta['estado_ruta']) == 2 ? '#e0efd8' : (esc($ruta['estado_ruta']) == 1 ? '#ffc107' : 'inherit') ?>;">
                                <td><?= date('d/m/Y', strtotime($ruta['fecha_ruta'])) ?></td>
                                <td><?= esc($ruta['nombre_transportista']) ?></td>
                                <td><?= esc($ruta['observaciones']) ?></td>
                                <td><?= esc($ruta['nombre_poblacion']) ?></td>
                                <td>
                                    <?php
                                    if (esc($ruta['estado_ruta']) == 0 || esc($ruta['estado_ruta']) == "") {
                                        echo "Pendiente";
                                    } elseif (esc($ruta['estado_ruta']) == 1) {
                                        echo "No preparado";
                                    } elseif (esc($ruta['estado_ruta']) == 2) {
                                        echo "Terminado";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-muted">No hay rutas de transporte asignadas a este pedido.</p>
        <?php endif; ?>
    </div>

    
    <div class="form-group">

        <h3 style="margin-left:5px; margin-top:-5px;">Líneas del Pedido</h3>
        
        <br>
        <div class="botonSeparados">
            <button type="button" class="boton btnAdd" id="openAddLineaPedidoModal" style="margin-left:20px;"
                data-id-pedido="<?= $pedido->id_pedido ?>">
                Añadir Línea de Pedido
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                    <path
                        d="M13 7C13.2155 7 13.4222 7.0856 13.5745 7.23798C13.7269 7.39035 13.8125 7.59701 13.8125 7.8125V12.6875H18.6875C18.903 12.6875 19.1097 12.7731 19.262 12.9255C19.4144 13.0778 19.5 13.2845 19.5 13.5C19.5 13.7155 19.4144 13.9222 19.262 14.0745C19.1097 14.2269 18.903 14.3125 18.6875 14.3125H13.8125V19.1875C13.8125 19.403 13.7269 19.6097 13.5745 19.762C13.4222 19.9144 13.2155 20 13 20C12.7845 20 12.5778 19.9144 12.4255 19.762C12.2731 19.6097 12.1875 19.403 12.1875 19.1875V14.3125H7.3125C7.09701 14.3125 6.89035 14.2269 6.73798 14.0745C6.5856 13.9222 6.5 13.7155 6.5 13.5C6.5 13.2845 6.5856 13.0778 6.73798 12.9255C6.89035 12.7731 7.09701 12.6875 7.3125 12.6875H12.1875V7.8125C12.1875 7.59701 12.2731 7.39035 12.4255 7.23798C12.5778 7.0856 12.7845 7 13 7Z"
                        fill="white" />
                </svg>
            </button>
            <button id="clear-filters" class="boton btnEliminarfiltros">
                    Quitar Filtros
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                        <path
                            d="M7.54974 8.04975C7.62521 7.97408 7.71487 7.91405 7.81358 7.87309C7.91229 7.83213 8.01812 7.81105 8.12499 7.81105C8.23186 7.81105 8.33768 7.83213 8.43639 7.87309C8.5351 7.91405 8.62476 7.97408 8.70024 8.04975L13 12.3511L17.2997 8.04975C17.3753 7.97421 17.465 7.91428 17.5637 7.8734C17.6624 7.83251 17.7682 7.81147 17.875 7.81147C17.9818 7.81147 18.0876 7.83251 18.1863 7.8734C18.285 7.91428 18.3747 7.97421 18.4502 8.04975C18.5258 8.12529 18.5857 8.21497 18.6266 8.31368C18.6675 8.41238 18.6885 8.51816 18.6885 8.625C18.6885 8.73183 18.6675 8.83762 18.6266 8.93632C18.5857 9.03502 18.5258 9.12471 18.4502 9.20025L14.1489 13.5L18.4502 17.7997C18.5258 17.8753 18.5857 17.965 18.6266 18.0637C18.6675 18.1624 18.6885 18.2682 18.6885 18.375C18.6885 18.4818 18.6675 18.5876 18.6266 18.6863C18.5857 18.785 18.5258 18.8747 18.4502 18.9502C18.3747 19.0258 18.285 19.0857 18.1863 19.1266C18.0876 19.1675 17.9818 19.1885 17.875 19.1885C17.7682 19.1885 17.6624 19.1675 17.5637 19.1266C17.465 19.0857 17.3753 19.0258 17.2997 18.9502L13 14.6489L8.70024 18.9502C8.62469 19.0258 8.53501 19.0857 8.43631 19.1266C8.33761 19.1675 8.23182 19.1885 8.12499 19.1885C8.01815 19.1885 7.91237 19.1675 7.81366 19.1266C7.71496 19.0857 7.62528 19.0258 7.54974 18.9502C7.47419 18.8747 7.41427 18.785 7.37339 18.6863C7.3325 18.5876 7.31146 18.4818 7.31146 18.375C7.31146 18.2682 7.3325 18.1624 7.37339 18.0637C7.41427 17.965 7.47419 17.8753 7.54974 17.7997L11.8511 13.5L7.54974 9.20025C7.47407 9.12477 7.41404 9.03511 7.37308 8.9364C7.33212 8.83769 7.31104 8.73187 7.31104 8.625C7.31104 8.51813 7.33212 8.4123 7.37308 8.31359C7.41404 8.21488 7.47407 8.12522 7.54974 8.04975Z"
                            fill="white" />
                    </svg>
                </button>
            <?php if (empty($pedido->bt_imprimir)): ?>
                <button type="button" class="boton btnAdd" style="margin-left:20px; background-color: #90EE90; color: #000!Important;" id="finalizarRedaccion" onclick="updateBtImprimir(1)">
    Finalizar redacción
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
        <path
            d="M15.5 20.5L10.5 15.5L11.9142 14.0858L15.5 17.6716L24.0858 9.08579L25.5 10.5L15.5 20.5Z"
            fill="#000" />
    </svg>
</button>
            <?php endif; ?>
        </div>
        <!-- Modal para añadir una nueva línea de pedido -->
        <div class="modal fade" id="addLineaPedidoModal" tabindex="-1" aria-labelledby="addLineaPedidoLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLineaPedidoLabel">Añadir Línea de Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyAddLineaPedido">
                    </div>
                </div>
            </div>
        </div>
        <br>
        
            </div>
            <!-- Grid para mostrar las líneas de pedido -->
            <div id="lineasPedidoGrid" class="ag-theme-alpine">
            <br>
        </div>
        <div style="text-align: right; margin-top:10px;">
                <a href="<?= base_url('/pedidos/enmarcha') ?>" class="boton volverButton">
                    Volver
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M19.5 13C19.5 13.2155 19.4144 13.4221 19.262 13.5745C19.1096 13.7269 18.903 13.8125 18.6875 13.8125H9.27386L12.7627 17.2997C12.8383 17.3753 12.8982 17.465 12.9391 17.5637C12.98 17.6624 13.001 17.7682 13.001 17.875C13.001 17.9818 12.98 18.0876 12.9391 18.1863C12.8982 18.285 12.8383 18.3747 12.7627 18.4502C12.6872 18.5258 12.5975 18.5857 12.4988 18.6266C12.4001 18.6675 12.2943 18.6885 12.1875 18.6885C12.0807 18.6885 11.9749 18.6675 11.8762 18.6266C11.7775 18.5857 11.6878 18.5258 11.6122 18.4502L6.73724 13.5752C6.66157 13.4998 6.60154 13.4101 6.56058 13.3114C6.51962 13.2127 6.49854 13.1069 6.49854 13C6.49854 12.8931 6.51962 12.7873 6.56058 12.6886C6.60154 12.5899 6.66157 12.5002 6.73724 12.4247L11.6122 7.54974C11.7648 7.39717 11.9717 7.31146 12.1875 7.31146C12.4032 7.31146 12.6102 7.39717 12.7627 7.54974C12.9153 7.7023 13.001 7.90923 13.001 8.12499C13.001 8.34075 12.9153 8.54767 12.7627 8.70024L9.27386 12.1875H18.6875C18.903 12.1875 19.1096 12.2731 19.262 12.4255C19.4144 12.5778 19.5 12.7845 19.5 13Z"
                            fill="white" />
                    </svg>
                </a>
            </div>
        <script>
            // Función para copiar al portapapeles
            function copyToClipboard(value) {
                const textArea = document.createElement('textarea');
                textArea.value = value;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
            }
            $(document).ready(function () {
                $('#id_cliente').select2({
                    placeholder: "Selecciona una empresa",
                    allowClear: true,
                    width: '100%'
                });

                // Mantener el cliente seleccionado en la inicialización
                $('#id_cliente').val('<?= $pedido->id_cliente ?>').trigger('change');
            });

            document.addEventListener('DOMContentLoaded', function () {
                const estadosTexto = <?= json_encode($estados_texto) ?>;
                const columnDefs = [{
                    headerName: 'Acciones',
                    field: 'acciones',
                    cellRenderer: renderActions,
                    cellClass: 'acciones-col',
                    minWidth: 250,
                    filter: false,
                },
                {
                    headerName: 'ID Línea',
                    field: 'id_lineapedido',
                    flex: 1,
                    minWidth: 130,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                    cellRenderer: function (params) {
                        const copyBtn = `<button class="copy-btn botonTabla btnCopiar" onclick="copyToClipboard('${params.value}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                    </svg></button>`;
                        return `${params.value} ${copyBtn}`;
                    }
                },
                {
                headerName: "Pzas",
                field: "n_piezas",
                filter: 'agTextColumnFilter',
                minWidth: 10,
                cellRenderer: function (params) {
                    const nPzas = params.value || '';
                    const ultimoFichaje = params.data.ultimo_fichaje && params.data.ultimo_fichaje != 0 
                        ? `<a href="#" title="${params.data.proceso}" style="text-decoration: none; color: #007bff;">${params.data.ultimo_fichaje}</a>` 
                        : '';
                    return `${nPzas}${ultimoFichaje ? ` / ${ultimoFichaje}` : ''}`;
                    }
                },
                {
                    headerName: 'Base',
                    field: 'nom_base',
                    flex: 1,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                },
                {
                    headerName: 'Producto',
                    field: 'nombre_producto',
                    flex: 1,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                },
                {
                    headerName: 'Estado',
                    field: 'estado',
                    flex: 1,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                    valueGetter: function (params) {
                        return estadosTexto[params.data.estado] || 'Estado desconocido';
                    },
                    valueFormatter: function (params) {
                        return estadosTexto[params.data.estado] || 'Estado desconocido';
                    }
                },
                {
                    headerName: 'Med. Inicial',
                    field: 'med_inicial',
                    flex: 1,
                    maxWidth: 130,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                },
                {
                    headerName: 'Med. Final',
                    field: 'med_final',
                    flex: 1,
                    maxWidth: 130,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                },
                {
                    headerName: 'Total',
                    field: 'total_linea',
                    flex: 1,
                    filter: 'agTextColumnFilter',
                    floatingFilter: true,
                    valueFormatter: params => `${params.value} €`,
                },
                ];
                const rowData = <?= json_encode($lineas_pedido) ?>;

                var userLevel = parseInt(<?= json_encode(session()->get('logged_in')['nivel'] ?? 0) ?>, 10);

                function renderActions(params) {
                    const id = params.data.id_lineapedido;
                    
                    const confirmMessage = '¿Estás seguro de que deseas anular esta línea?';

                    return `
                    <button class="btn botonTabla btnEditarTabla btnEditarTablaLinea" data-id="${id}" data-bs-toggle="modal" data-bs-target="#editarLineaModal">
                        Editar
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                        <path d="M14.7513 1.98301C14.8352 2.07186 14.8823 2.19218 14.8823 2.31763C14.8823 2.44307 14.8352 2.5634 14.7513 2.65224L13.8145 3.64186L12.0182 1.74604L12.955 0.756413C13.0392 0.66756 13.1534 0.617645 13.2725 0.617645C13.3916 0.617645 13.5058 0.66756 13.59 0.756413L14.7513 1.98207V1.98301ZM13.1795 4.31109L11.3833 2.41526L5.26424 8.87435C5.21481 8.92651 5.1776 8.99013 5.15557 9.06014L4.43256 11.3484C4.41945 11.3901 4.41759 11.4349 4.42719 11.4776C4.43678 11.5204 4.45746 11.5595 4.48691 11.5906C4.51635 11.6217 4.55341 11.6435 4.59393 11.6536C4.63446 11.6637 4.67685 11.6618 4.71638 11.6479L6.88448 10.8849C6.95073 10.8619 7.011 10.823 7.06052 10.7711L13.1795 4.31109Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.352905 13.6526C0.352905 14.049 0.510356 14.4291 0.790621 14.7093C1.07089 14.9896 1.45101 15.1471 1.84736 15.1471H12.8067C13.203 15.1471 13.5832 14.9896 13.8634 14.7093C14.1437 14.4291 14.3011 14.049 14.3011 13.6526V7.67479C14.3011 7.54267 14.2487 7.41596 14.1552 7.32254C14.0618 7.22912 13.9351 7.17664 13.803 7.17664C13.6709 7.17664 13.5442 7.22912 13.4507 7.32254C13.3573 7.41596 13.3048 7.54267 13.3048 7.67479V13.6526C13.3048 13.7847 13.2524 13.9114 13.1589 14.0048C13.0655 14.0983 12.9388 14.1508 12.8067 14.1508H1.84736C1.71524 14.1508 1.58853 14.0983 1.49511 14.0048C1.40169 13.9114 1.34921 13.7847 1.34921 13.6526V2.69328C1.34921 2.56116 1.40169 2.43445 1.49511 2.34103C1.58853 2.24761 1.71524 2.19512 1.84736 2.19512H8.32333C8.45544 2.19512 8.58215 2.14264 8.67557 2.04922C8.76899 1.9558 8.82148 1.82909 8.82148 1.69697C8.82148 1.56486 8.76899 1.43815 8.67557 1.34473C8.58215 1.25131 8.45544 1.19882 8.32333 1.19882H1.84736C1.45101 1.19882 1.07089 1.35627 0.790621 1.63654C0.510356 1.9168 0.352905 2.29692 0.352905 2.69328V13.6526Z" fill="white"/>
                        </svg> 
                        </button>
                        <button class="btn botonTabla btnImprimirTabla" onclick="mostrarParte(${id})">
                        Parte
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                        <path d="M8.71593 4.72729C8.16741 4.72729 7.64136 4.95853 7.2535 5.37014C6.86564 5.78174 6.64774 6.34 6.64774 6.9221V9.11691H5.61365C5.06514 9.11691 4.53909 9.34814 4.15123 9.75975C3.76337 10.1714 3.54547 10.7296 3.54547 11.3117L3.54547 14.6039C3.54547 15.186 3.76337 15.7443 4.15123 16.1559C4.53909 16.5675 5.06514 16.7987 5.61365 16.7987H6.64774V17.8961C6.64774 18.4782 6.86564 19.0365 7.2535 19.4481C7.64136 19.8597 8.16741 20.0909 8.71593 20.0909H14.9205C15.469 20.0909 15.995 19.8597 16.3829 19.4481C16.7708 19.0365 16.9887 18.4782 16.9887 17.8961V16.7987H18.0227C18.5713 16.7987 19.0973 16.5675 19.4852 16.1559C19.873 15.7443 20.0909 15.186 20.0909 14.6039V11.3117C20.0909 10.7296 19.873 10.1714 19.4852 9.75975C19.0973 9.34814 18.5713 9.11691 18.0227 9.11691H16.9887V6.9221C16.9887 6.34 16.7708 5.78174 16.3829 5.37014C15.995 4.95853 15.469 4.72729 14.9205 4.72729H8.71593ZM7.68184 6.9221C7.68184 6.63105 7.79078 6.35192 7.98471 6.14612C8.17864 5.94032 8.44167 5.8247 8.71593 5.8247H14.9205C15.1947 5.8247 15.4578 5.94032 15.6517 6.14612C15.8456 6.35192 15.9546 6.63105 15.9546 6.9221V9.11691H7.68184V6.9221ZM8.71593 12.4091C8.16741 12.4091 7.64136 12.6404 7.2535 13.052C6.86564 13.4636 6.64774 14.0218 6.64774 14.6039V15.7013H5.61365C5.3394 15.7013 5.07637 15.5857 4.88244 15.3799C4.68851 15.1741 4.57956 14.895 4.57956 14.6039V11.3117C4.57956 11.0207 4.68851 10.7415 4.88244 10.5357C5.07637 10.3299 5.3394 10.2143 5.61365 10.2143H18.0227C18.297 10.2143 18.56 10.3299 18.754 10.5357C18.9479 10.7415 19.0568 11.0207 19.0568 11.3117V14.6039C19.0568 14.895 18.9479 15.1741 18.754 15.3799C18.56 15.5857 18.297 15.7013 18.0227 15.7013H16.9887V14.6039C16.9887 14.0218 16.7708 13.4636 16.3829 13.052C15.995 12.6404 15.469 12.4091 14.9205 12.4091H8.71593ZM15.9546 14.6039V17.8961C15.9546 18.1872 15.8456 18.4663 15.6517 18.6721C15.4578 18.8779 15.1947 18.9935 14.9205 18.9935H8.71593C8.44167 18.9935 8.17864 18.8779 7.98471 18.6721C7.79078 18.4663 7.68184 18.1872 7.68184 17.8961V14.6039C7.68184 14.3129 7.79078 14.0337 7.98471 13.8279C8.17864 13.6221 8.44167 13.5065 8.71593 13.5065H14.9205C15.1947 13.5065 15.4578 13.6221 15.6517 13.8279C15.8456 14.0337 15.9546 14.3129 15.9546 14.6039Z" fill="black" fill-opacity="0.6"/>
                        </svg>
                        </button>
                       <a href="<?= base_url('pedidos/deleteLinea/') ?>${id}" class="btn botonTabla btnEliminarTabla" onclick="return confirm('${confirmMessage}');">
                        Anular
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                        <path d="M7.66753 6.776C7.41733 6.776 7.17737 6.87593 7.00045 7.05379C6.82353 7.23166 6.72414 7.47289 6.72414 7.72443V8.67286C6.72414 8.9244 6.82353 9.16563 7.00045 9.3435C7.17737 9.52136 7.41733 9.62129 7.66753 9.62129H8.13923V18.1571C8.13923 18.6602 8.33802 19.1427 8.69186 19.4984C9.0457 19.8541 9.52561 20.054 10.026 20.054H15.6864C16.1868 20.054 16.6667 19.8541 17.0206 19.4984C17.3744 19.1427 17.5732 18.6602 17.5732 18.1571V9.62129H18.0449C18.2951 9.62129 18.5351 9.52136 18.712 9.3435C18.8889 9.16563 18.9883 8.9244 18.9883 8.67286V7.72443C18.9883 7.47289 18.8889 7.23166 18.712 7.05379C18.5351 6.87593 18.2951 6.776 18.0449 6.776H14.743C14.743 6.52446 14.6436 6.28323 14.4667 6.10536C14.2898 5.9275 14.0498 5.82758 13.7996 5.82758H11.9128C11.6626 5.82758 11.4227 5.9275 11.2457 6.10536C11.0688 6.28323 10.9694 6.52446 10.9694 6.776H7.66753ZM10.4977 10.5697C10.6228 10.5697 10.7428 10.6197 10.8313 10.7086C10.9197 10.7975 10.9694 10.9182 10.9694 11.0439V17.6829C10.9694 17.8087 10.9197 17.9293 10.8313 18.0182C10.7428 18.1072 10.6228 18.1571 10.4977 18.1571C10.3726 18.1571 10.2526 18.1072 10.1642 18.0182C10.0757 17.9293 10.026 17.8087 10.026 17.6829V11.0439C10.026 10.9182 10.0757 10.7975 10.1642 10.7086C10.2526 10.6197 10.3726 10.5697 10.4977 10.5697ZM12.8562 10.5697C12.9813 10.5697 13.1013 10.6197 13.1898 10.7086C13.2782 10.7975 13.3279 10.9182 13.3279 11.0439V17.6829C13.3279 17.8087 13.2782 17.9293 13.1898 18.0182C13.1013 18.1072 12.9813 18.1571 12.8562 18.1571C12.7311 18.1571 12.6111 18.1072 12.5227 18.0182C12.4342 17.9293 12.3845 17.8087 12.3845 17.6829V11.0439C12.3845 10.9182 12.4342 10.7975 12.5227 10.7086C12.6111 10.6197 12.7311 10.5697 12.8562 10.5697ZM15.6864 11.0439V17.6829C15.6864 17.8087 15.6367 17.9293 15.5482 18.0182C15.4598 18.1072 15.3398 18.1571 15.2147 18.1571C15.0896 18.1571 14.9696 18.1072 14.8812 18.0182C14.7927 17.9293 14.743 17.8087 14.743 17.6829V11.0439C14.743 10.9182 14.7927 10.7975 14.8812 10.7086C14.9696 10.6197 15.0896 10.5697 15.2147 10.5697C15.3398 10.5697 15.4598 10.6197 15.5482 10.7086C15.6367 10.7975 15.6864 10.9182 15.6864 11.0439Z" fill="white"/>
                        </svg>
                        </a>
                `;
                }

                const gridOptions = {
                    columnDefs: columnDefs,
                    rowData: rowData,
                    pagination: true,
                    paginationPageSize: 10,
                    headerHeight: 50,
                    floatingFiltersHeight: 40,
                    defaultColDef: {
                        sortable: true,
                        filter: true,
                        floatingFilter: true,
                        resizable: true,
                    },
                    domLayout: 'autoHeight',
                    rowHeight: 60,
                    localeText: {
                        noRowsToShow: 'No hay registros disponibles.'
                    },
                    onGridReady: function (params) {
                        params.api.sizeColumnsToFit();
                        window.gridApi = params.api;
                    },
                    getRowClass: function (params) {
                        const estadoTexto = estadosTexto[params.data.estado] || 'Estado desconocido';
                        switch (estadoTexto) {
                            case "Pendiente de material":
                                return 'estado0';
                            case "Falta Material":
                                return 'estado1';
                            case "Material recibido":
                                return 'estado2';
                            case "En Máquinas":
                                return 'estado3';
                            case "Terminado":
                                return 'estado4';
                            case "Entregado":
                                return 'estado5';
                            case "Anulado":
                                return 'estado6';
                            default:
                                return '';
                        }
                    }

                };
                const eGridDiv = document.querySelector('#lineasPedidoGrid');
                new agGrid.Grid(eGridDiv, gridOptions);
                document.querySelector('#clear-filters').addEventListener('click', function () {
                    if (window.gridApi) {
                        window.gridApi.setFilterModel(null);
                        window.gridApi.onFilterChanged();
                    }
                });
                document.querySelector('#reload-page').addEventListener('click', function () {
                    location.reload();
                });
                window.addEventListener('resize', function () {
                    if (window.gridApi) {
                        window.gridApi.sizeColumnsToFit();
                    }
                });
            });
            // Función para mostrar el modal del parte
            function mostrarParte(id_lineapedido) {
                $.ajax({
                    url: '<?= base_url("partes/print/") ?>' + id_lineapedido,
                    type: 'GET',
                    success: function (data) {
                        $('#modalParteContent').html(data);
                        $('#parteModal').modal('show');
                        // Almacenar en sessionStorage que el modal está abierto y el ID
                        sessionStorage.setItem('modalParteAbierto', 'true');
                        sessionStorage.setItem('modalParteId', id_lineapedido);
                    },
                    error: function () {
                        $('#modalParteContent').html('<p class="text-danger">Error al cargar el parte.</p>');
                        $('#parteModal').modal('show');
                        sessionStorage.setItem('modalParteAbierto', 'true');
                        sessionStorage.setItem('modalParteId', id_lineapedido);
                    }
                });
            }

            function printDiv(divId) {
                var printContents = document.getElementById(divId).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
        <!-- Modal para mostrar el Parte -->
        <div class="modal fade" id="parteModal" tabindex="-1" aria-labelledby="parteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="parteModalLabel">Parte de Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalParteContent">
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#parteModal').on('hidden.bs.modal', function () {
                location.reload();
            });
        </script>
        <div class="modal fade" id="editarLineaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="overflow-y: hidden !important;">
                    <div class="modal-body" id="modalBodyEditarLineaPedido" style="overflow-y: auto !important;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#openModal').on('click', function () {
                var pedidoId = '<?= $pedido->id_pedido ?>';
                var clienteId = '<?= $pedido->id_cliente ?>';
                $('#modalContent').html('<div class="text-center"><p>Cargando...</p></div>');
                $.ajax({
                    url: '<?= base_url('Ruta_pedido/rutas') ?>/' + pedidoId + '/' + clienteId,
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            $('#modalContent').html('<div class="alert alert-danger">' + response.error + '</div>');
                            return;
                        }
                        $('#modalContent').html(`
                    <div id="rutasContainer">
                        <div id="botonesRuta" class="d-flex justify-content-between align-items-center botoneseditRuta botonesRuta">
                            <button type="button" class="boton btnAdd" id="openAddRuta" style="margin-left:20px;">
                            Añadir Ruta
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                            <path d="M13 7C13.2155 7 13.4222 7.0856 13.5745 7.23798C13.7269 7.39035 13.8125 7.59701 13.8125 7.8125V12.6875H18.6875C18.903 12.6875 19.1097 12.7731 19.262 12.9255C19.4144 13.0778 19.5 13.2845 19.5 13.5C19.5 13.7155 19.4144 13.9222 19.262 14.0745C19.1097 14.2269 18.903 14.3125 18.6875 14.3125H13.8125V19.1875C13.8125 19.403 13.7269 19.6097 13.5745 19.762C13.4222 19.9144 13.2155 20 13 20C12.7845 20 12.5778 19.9144 12.4255 19.762C12.2731 19.6097 12.1875 19.403 12.1875 19.1875V14.3125H7.3125C7.09701 14.3125 6.89035 14.2269 6.73798 14.0745C6.5856 13.9222 6.5 13.7155 6.5 13.5C6.5 13.2845 6.5856 13.0778 6.73798 12.9255C6.89035 12.7731 7.09701 12.6875 7.3125 12.6875H12.1875V7.8125C12.1875 7.59701 12.2731 7.39035 12.4255 7.23798C12.5778 7.0856 12.7845 7 13 7Z" fill="white" />
                        </svg>
                        </button>
                <button id="clear-filters-rutas" class="boton btnEliminarfiltros" style="flex-grow: 0;">
                Quitar Filtros
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
            <path d="M7.54974 8.04975C7.62521 7.97408 7.71487 7.91405 7.81358 7.87309C7.91229 7.83213 8.01812 7.81105 8.12499 7.81105C8.23186 7.81105 8.33768 7.83213 8.43639 7.87309C8.5351 7.91405 8.62476 7.97408 8.70024 8.04975L13 12.3511L17.2997 8.04975C17.3753 7.97421 17.465 7.91428 17.5637 7.8734C17.6624 7.83251 17.7682 7.81147 17.875 7.81147C17.9818 7.81147 18.0876 7.83251 18.1863 7.8734C18.285 7.91428 18.3747 7.97421 18.4502 8.04975C18.5258 8.12529 18.5857 8.21497 18.6266 8.31368C18.6675 8.41238 18.6885 8.51816 18.6885 8.625C18.6885 8.73183 18.6675 8.83762 18.6266 8.93632C18.5857 9.03502 18.5258 9.12471 18.4502 9.20025L14.1489 13.5L18.4502 17.7997C18.5258 17.8753 18.5857 17.965 18.6266 18.0637C18.6675 18.1624 18.6885 18.2682 18.6885 18.375C18.6885 18.4818 18.6675 18.5876 18.6266 18.6863C18.5857 18.785 18.5258 18.8747 18.4502 18.9502C18.3747 19.0258 18.285 19.0857 18.1863 19.1266C18.0876 19.1675 17.9818 19.1885 17.875 19.1885C17.7682 19.1885 17.6624 19.1675 17.5637 19.1266C17.465 19.0857 17.3753 19.0258 17.2997 18.9502L13 14.6489L8.70024 18.9502C8.62469 19.0258 8.53501 19.0857 8.43631 19.1266C8.33761 19.1675 8.23182 19.1885 8.12499 19.1885C8.01815 19.1885 7.91237 19.1675 7.81366 19.1266C7.71496 19.0857 7.62528 19.0258 7.54974 18.9502C7.47419 18.8747 7.41427 18.785 7.37339 18.6863C7.3325 18.5876 7.31146 18.4818 7.31146 18.375C7.31146 18.2682 7.3325 18.1624 7.37339 18.0637C7.41427 17.965 7.47419 17.8753 7.54974 17.7997L11.8511 13.5L7.54974 9.20025C7.47407 9.12477 7.41404 9.03511 7.37308 8.9364C7.33212 8.83769 7.31104 8.73187 7.31104 8.625C7.31104 8.51813 7.33212 8.4123 7.37308 8.31359C7.41404 8.21488 7.47407 8.12522 7.54974 8.04975Z" fill="white" />
        </svg>
                </button>
                        </div>
                        <br>
                        <div id="gridRutas" class="ag-theme-alpine"  style="width: 100%;"></div>
                    </div>
                    <div id="addRutaForm" style="display:none;"></div>
                `);
                        initializeAgGrid(response.rutas, response.poblacionesMap, response.transportistas);
                        setupEventHandlers();
                    },
                    error: function () {
                        $('#modalContent').html('<div class="alert alert-danger">Error al cargar las rutas.</div>');
                    }
                });
            });

            // Función para inicializar ag-Grid
            function initializeAgGrid(rutas, poblacionesMap, transportistasMap) {
                var estadoMap = {
                    1: 'No preparado',
                    2: 'Recogido',
                    0: 'Pendiente'
                };
                var columnDefs = [{
                    headerName: "Acciones",
                    field: "acciones",
                    cellRenderer: function (params) {
                        var editBtn = `<button class="btn botonTabla btnEditarTabla" data-id="${params.data.id_ruta}" onclick="editarRuta(${params.data.id_ruta})">
                            Editar
                           <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M14.7513 1.98301C14.8352 2.07186 14.8823 2.19218 14.8823 2.31763C14.8823 2.44307 14.8352 2.5634 14.7513 2.65224L13.8145 3.64186L12.0182 1.74604L12.955 0.756413C13.0392 0.66756 13.1534 0.617645 13.2725 0.617645C13.3916 0.617645 13.5058 0.66756 13.59 0.756413L14.7513 1.98207V1.98301ZM13.1795 4.31109L11.3833 2.41526L5.26424 8.87435C5.21481 8.92651 5.1776 8.99013 5.15557 9.06014L4.43256 11.3484C4.41945 11.3901 4.41759 11.4349 4.42719 11.4776C4.43678 11.5204 4.45746 11.5595 4.48691 11.5906C4.51635 11.6217 4.55341 11.6435 4.59393 11.6536C4.63446 11.6637 4.67685 11.6618 4.71638 11.6479L6.88448 10.8849C6.95073 10.8619 7.011 10.823 7.06052 10.7711L13.1795 4.31109Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.352905 13.6526C0.352905 14.049 0.510356 14.4291 0.790621 14.7093C1.07089 14.9896 1.45101 15.1471 1.84736 15.1471H12.8067C13.203 15.1471 13.5832 14.9896 13.8634 14.7093C14.1437 14.4291 14.3011 14.049 14.3011 13.6526V7.67479C14.3011 7.54267 14.2487 7.41596 14.1552 7.32254C14.0618 7.22912 13.9351 7.17664 13.803 7.17664C13.6709 7.17664 13.5442 7.22912 13.4507 7.32254C13.3573 7.41596 13.3048 7.54267 13.3048 7.67479V13.6526C13.3048 13.7847 13.2524 13.9114 13.1589 14.0048C13.0655 14.0983 12.9388 14.1508 12.8067 14.1508H1.84736C1.71524 14.1508 1.58853 14.0983 1.49511 14.0048C1.40169 13.9114 1.34921 13.7847 1.34921 13.6526V2.69328C1.34921 2.56116 1.40169 2.43445 1.49511 2.34103C1.58853 2.24761 1.71524 2.19512 1.84736 2.19512H8.32333C8.45544 2.19512 8.58215 2.14264 8.67557 2.04922C8.76899 1.9558 8.82148 1.82909 8.82148 1.69697C8.82148 1.56486 8.76899 1.43815 8.67557 1.34473C8.58215 1.25131 8.45544 1.19882 8.32333 1.19882H1.84736C1.45101 1.19882 1.07089 1.35627 0.790621 1.63654C0.510356 1.9168 0.352905 2.29692 0.352905 2.69328V13.6526Z" fill="white"/>
                            </svg>
                              </button>`;
                        var deleteBtn = `<button class="btn botonTabla btnEliminarTabla" data-id="${params.data.id_ruta}" onclick="eliminarRuta(${params.data.id_ruta})">
                            Eliminar
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                            <path d="M7.66753 6.776C7.41733 6.776 7.17737 6.87593 7.00045 7.05379C6.82353 7.23166 6.72414 7.47289 6.72414 7.72443V8.67286C6.72414 8.9244 6.82353 9.16563 7.00045 9.3435C7.17737 9.52136 7.41733 9.62129 7.66753 9.62129H8.13923V18.1571C8.13923 18.6602 8.33802 19.1427 8.69186 19.4984C9.0457 19.8541 9.52561 20.054 10.026 20.054H15.6864C16.1868 20.054 16.6667 19.8541 17.0206 19.4984C17.3744 19.1427 17.5732 18.6602 17.5732 18.1571V9.62129H18.0449C18.2951 9.62129 18.5351 9.52136 18.712 9.3435C18.8889 9.16563 18.9883 8.9244 18.9883 8.67286V7.72443C18.9883 7.47289 18.8889 7.23166 18.712 7.05379C18.5351 6.87593 18.2951 6.776 18.0449 6.776H14.743C14.743 6.52446 14.6436 6.28323 14.4667 6.10536C14.2898 5.9275 14.0498 5.82758 13.7996 5.82758H11.9128C11.6626 5.82758 11.4227 5.9275 11.2457 6.10536C11.0688 6.28323 10.9694 6.52446 10.9694 6.776H7.66753ZM10.4977 10.5697C10.6228 10.5697 10.7428 10.6197 10.8313 10.7086C10.9197 10.7975 10.9694 10.9182 10.9694 11.0439V17.6829C10.9694 17.8087 10.9197 17.9293 10.8313 18.0182C10.7428 18.1072 10.6228 18.1571 10.4977 18.1571C10.3726 18.1571 10.2526 18.1072 10.1642 18.0182C10.0757 17.9293 10.026 17.8087 10.026 17.6829V11.0439C10.026 10.9182 10.0757 10.7975 10.1642 10.7086C10.2526 10.6197 10.3726 10.5697 10.4977 10.5697ZM12.8562 10.5697C12.9813 10.5697 13.1013 10.6197 13.1898 10.7086C13.2782 10.7975 13.3279 10.9182 13.3279 11.0439V17.6829C13.3279 17.8087 13.2782 17.9293 13.1898 18.0182C13.1013 18.1072 12.9813 18.1571 12.8562 18.1571C12.7311 18.1571 12.6111 18.1072 12.5227 18.0182C12.4342 17.9293 12.3845 17.8087 12.3845 17.6829V11.0439C12.3845 10.9182 12.4342 10.7975 12.5227 10.7086C12.6111 10.6197 12.7311 10.5697 12.8562 10.5697ZM15.6864 11.0439V17.6829C15.6864 17.8087 15.6367 17.9293 15.5482 18.0182C15.4598 18.1072 15.3398 18.1571 15.2147 18.1571C15.0896 18.1571 14.9696 18.1072 14.8812 18.0182C14.7927 17.9293 14.743 17.8087 14.743 17.6829V11.0439C14.743 10.9182 14.7927 10.7975 14.8812 10.7086C14.9696 10.6197 15.0896 10.5697 15.2147 10.5697C15.3398 10.5697 15.4598 10.6197 15.5482 10.7086C15.6367 10.7975 15.6864 10.9182 15.6864 11.0439Z" fill="white"/>
                            </svg>
                            </button>`;
                        return `${editBtn} ${deleteBtn}`;
                    },
                    cellClass: 'acciones-col',
                    minWidth: 190,
                    filter: false
                },
                {
                    headerName: "Población",
                    field: "poblacion",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Lugar",
                    field: "lugar",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Recogida/Entrega",
                    field: "recogida_entrega",
                    minWidth: 190,
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Transportista",
                    field: "transportista",
                    minWidth: 150,
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Fecha",
                    field: "fecha_ruta",
                    flex: 1,
                    filter: 'agDateColumnFilter'
                },
                {
                    headerName: "Estado",
                    field: "estado_ruta",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                }
                ];

                var rowData = rutas.map(function (ruta) {
                    return {
                        id_ruta: ruta.id_ruta,
                        poblacion: poblacionesMap[ruta.poblacion] || 'Desconocido',
                        lugar: ruta.lugar,
                        recogida_entrega: ruta.recogida_entrega == 1 ? 'Recogida' : 'Entrega',
                        transportista: transportistasMap[ruta.transportista] || 'No asignado',
                        fecha_ruta: ruta.fecha_ruta,
                        estado_ruta: estadoMap[ruta.estado_ruta] || 'Desconocido'
                    };
                });

                var gridDiv = document.querySelector('#gridRutas');
                var gridOptions = {
                    columnDefs: columnDefs,
                    rowData: rowData,
                    pagination: true,
                    paginationPageSize: 10,
                    defaultColDef: {
                        sortable: true,
                        filter: true,
                        floatingFilter: true,
                        resizable: true
                    },
                    getRowStyle: function (params) {
                        if (params.data && params.data.estado_ruta === 'Recogido') {
                            return {
                                backgroundColor: '#dff0d8',
                                color: 'black'
                            };
                        }
                        return null;
                    },
                    onGridReady: function (params) {
                        params.api.sizeColumnsToFit();
                        $('#botonesRuta').show();
                        window.gridApiRutas = params.api;
                    },
                    rowHeight: 60,
                    domLayout: 'autoHeight',
                    localeText: {
                        noRowsToShow: 'No hay registros disponibles.'
                    }
                };

                new agGrid.Grid(gridDiv, gridOptions);
                $('#clear-filters-rutas').on('click', function () {
                    if (window.gridApiRutas) {
                        window.gridApiRutas.setFilterModel(null);
                        window.gridApiRutas.onFilterChanged();
                    }
                });
            }

            function setupEventHandlers() {
                $('#formNuevaRuta').on('submit', function (event) {
                    event.preventDefault();
                    $(this).unbind('submit').submit();
                });
                $('#openAddRuta').on('click', function () {
                    var pedidoId = '<?= $pedido->id_pedido ?>';
                    var clienteId = '<?= $pedido->id_cliente ?>';

                    $.ajax({
                        url: '<?= base_url('Ruta_pedido/mostrarFormulario') ?>/' + pedidoId + '/' + clienteId,
                        method: 'GET',
                        success: function (response) {
                            $('#addRutaForm').html(response);
                            $('#addRutaForm').show();
                            $('#gridRutas, #botonesRuta').hide();
                            $('#rutasModalLabel').text('Añadir Ruta');
                        },
                        error: function () {
                            alert('Error al cargar el formulario de ruta.');
                        }
                    });
                });

                window.editarRuta = function (id_ruta) {
                    var pedidoId = '<?= $pedido->id_pedido ?>';
                    var clienteId = '<?= $pedido->id_cliente ?>';

                    $.ajax({
                        url: '<?= base_url('Ruta_pedido/mostrarFormulario') ?>/' + pedidoId + '/' + clienteId,
                        method: 'GET',
                        success: function (response) {
                            $('#addRutaForm').html(response);
                            $('#gridRutas, #botonesRuta').hide();
                            $('#addRutaForm').show();
                            $('#rutasModalLabel').text('Editar Ruta');

                            $.ajax({
                                url: '<?= base_url('Ruta_pedido/obtenerRuta') ?>/' + id_ruta,
                                method: 'GET',
                                success: function (rutaResponse) {
                                    $('#poblacion').val(rutaResponse.poblacion);
                                    $('#lugar').val(rutaResponse.lugar);
                                    $('#recogida_entrega').val(rutaResponse.recogida_entrega);
                                    $('#transportista').val(rutaResponse.transportista);
                                    $('#fecha_ruta').val(rutaResponse.fecha_ruta);
                                    $('#observaciones').val(rutaResponse.observaciones);
                                    $('#id_ruta').val(rutaResponse.id_ruta);
                                    $('#estadoRutaDiv').show();
                                    $('#estado_ruta').val(rutaResponse.estado_ruta);
                                },
                                error: function () {
                                    alert('Error al cargar los datos de la ruta.');
                                }
                            });
                        },
                        error: function () {
                            alert('Error al cargar el formulario de ruta.');
                        }
                    });
                };
                $('#volverTabla').on('click', function () {
                    $('#addRutaForm').hide();
                    $('#gridRutas').show();
                    $('#rutasModalLabel').text('Rutas del Pedido');
                });
            }

            window.eliminarRuta = function (id_ruta) {
                if (confirm('¿Estás seguro de que deseas eliminar esta ruta?')) {
                    $.ajax({
                        url: '<?= base_url('Ruta_pedido/delete') ?>/' + id_ruta,
                        method: 'DELETE',
                        success: function (response) {
                            if (response.success) {
                                alert(response.message);
                                cargarRutasModal();
                            } else {
                                cargarRutasModal();
                            }
                        },
                        error: function (xhr) {
                            alert('Error al eliminar la ruta: ' + xhr.responseText);
                        }
                    });
                }
            };

            function cargarRutasModal() {
                var pedidoId = '<?= $pedido->id_pedido ?>';
                var clienteId = '<?= $pedido->id_cliente ?>';

                $.ajax({
                    url: '<?= base_url('Ruta_pedido/rutas') ?>/' + pedidoId + '/' + clienteId,
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            $('#modalContent').html('<div class="alert alert-danger">' + response.error + '</div>');
                            return;
                        }
                        $('#modalContent').html(`
                    <div id="rutasContainer">
                    <div id="botonesRuta"  class="d-flex justify-content-between align-items-center botoneseditRuta botonesRuta">
                    <button type="button" class="boton btnAdd" id="openAddRuta" style=";">
                    Añadir Ruta
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                        <path d="M13 7C13.2155 7 13.4222 7.0856 13.5745 7.23798C13.7269 7.39035 13.8125 7.59701 13.8125 7.8125V12.6875H18.6875C18.903 12.6875 19.1097 12.7731 19.262 12.9255C19.4144 13.0778 19.5 13.2845 19.5 13.5C19.5 13.7155 19.4144 13.9222 19.262 14.0745C19.1097 14.2269 18.903 14.3125 18.6875 14.3125H13.8125V19.1875C13.8125 19.403 13.7269 19.6097 13.5745 19.762C13.4222 19.9144 13.2155 20 13 20C12.7845 20 12.5778 19.9144 12.4255 19.762C12.2731 19.6097 12.1875 19.403 12.1875 19.1875V14.3125H7.3125C7.09701 14.3125 6.89035 14.2269 6.73798 14.0745C6.5856 13.9222 6.5 13.7155 6.5 13.5C6.5 13.2845 6.5856 13.0778 6.73798 12.9255C6.89035 12.7731 7.09701 12.6875 7.3125 12.6875H12.1875V7.8125C12.1875 7.59701 12.2731 7.39035 12.4255 7.23798C12.5778 7.0856 12.7845 7 13 7Z" fill="white" />
                    </svg>
                    </button>
                    <button id="clear-filters-rutas" class="boton btnEliminarfiltros" style="flex-grow: 0;">Eliminar Filtros</button>
                    </div>
                    <br>
                    <div id="gridRutas" class="ag-theme-alpine"  style="width: 100%;"></div>
                    </div>
                    <div id="addRutaForm" style="display:none;"></div>
                    `);

                        initializeAgGrid(response.rutas, response.poblacionesMap, response.transportistas);
                        setupEventHandlers();
                    },
                    error: function () {
                        $('#modalContent').html('<div class="alert alert-danger">Error al cargar las rutas.</div>');
                    }
                });
            }

        });
        $(document).ready(function () {
            function abrirModalSiEsNecesario() {
                const urlParams = new URLSearchParams(window.location.search);

                if (urlParams.has('openModal')) {
                    $('#openModal').click();
                    urlParams.delete('openModal');
                    const newUrl = window.location.pathname + '?' + urlParams.toString();
                    window.history.replaceState({}, '', newUrl);
                }
            }
            abrirModalSiEsNecesario();

            function initializeAgGrid(rutas, poblacionesMap, transportistasMap) {
                var estadoMap = {
                    1: 'No preparado',
                    2: 'Recogido',
                    0: 'Pendiente'
                };

                var columnDefs = [{
                    headerName: "Acciones",
                    field: "acciones",
                    cellRenderer: function (params) {
                        var editBtn = `<button class="btn btnEditarRuta" data-id="${params.data.id_ruta}" onclick="editarRuta(${params.data.id_ruta})">
                    <span class="material-symbols-outlined icono">edit</span>Editar</button>`;
                        var deleteBtn = `<button class="btn btnEliminarRuta" data-id="${params.data.id_ruta}" onclick="eliminarRuta(${params.data.id_ruta})">
                    <span class="material-symbols-outlined icono">delete</span>Eliminar</button>`;
                        return `${editBtn} ${deleteBtn}`;
                    },
                    cellClass: 'acciones-col',
                    minWidth: 190,
                    filter: false
                },
                {
                    headerName: "Población",
                    field: "poblacion",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Lugar",
                    field: "lugar",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Recogida/Entrega",
                    field: "recogida_entrega",
                    minWidth: 190,
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Transportista",
                    field: "transportista",
                    minWidth: 150,
                    flex: 1,
                    filter: 'agTextColumnFilter'
                },
                {
                    headerName: "Fecha",
                    field: "fecha_ruta",
                    flex: 1,
                    filter: 'agDateColumnFilter'
                },
                {
                    headerName: "Estado",
                    field: "estado_ruta",
                    flex: 1,
                    filter: 'agTextColumnFilter'
                }
                ];

                var rowData = rutas.map(function (ruta) {
                    return {
                        id_ruta: ruta.id_ruta,
                        poblacion: poblacionesMap[ruta.poblacion] || 'Desconocido',
                        lugar: ruta.lugar,
                        recogida_entrega: ruta.recogida_entrega == 1 ? 'Recogida' : 'Entrega',
                        transportista: transportistasMap[ruta.transportista] || 'No asignado',
                        fecha_ruta: ruta.fecha_ruta,
                        estado_ruta: estadoMap[ruta.estado_ruta] || 'Desconocido'
                    };
                });

                var gridDiv = document.querySelector('#gridRutas');
                var gridOptions = {
                    columnDefs: columnDefs,
                    rowData: rowData,
                    pagination: true,
                    paginationPageSize: 10,
                    defaultColDef: {
                        sortable: true,
                        filter: true,
                        floatingFilter: true,
                        resizable: true
                    },
                    onGridReady: function (params) {
                        params.api.sizeColumnsToFit();
                        $('#botonesRuta').show();
                    },
                    rowHeight: 60,
                    domLayout: 'normal',
                    onGridReady: function (params) {
                        params.api.sizeColumnsToFit();
                        window.gridApi = params.api;
                    },
                    localeText: {
                        noRowsToShow: 'No hay registros disponibles.'
                    }
                };

                var gridDiv = document.querySelector('#gridRutas');
                new agGrid.Grid(gridDiv, gridOptions);
                $('#clear-filters-rutas').on('click', function () {
                    if (window.gridApiRutas) {
                        window.gridApiRutas.setFilterModel(null);
                        window.gridApiRutas.onFilterChanged();
                    }
                });
            }

        });
        $(document).on('click', '.btnEditarTablaLinea', function () {
            var lineaId = $(this).data('id');

            $.ajax({
                url: '<?= base_url("pedidos/mostrarFormularioEditarLineaPedido") ?>/' + lineaId,
                method: 'GET',
                success: function (response) {
                    $('#modalBodyEditarLineaPedido').html(response);
                    $('#editarLineaModal').modal('show');
                },
                error: function () {
                    alert('Hubo un error al cargar el formulario. Por favor, intenta de nuevo.');
                }
            });
        });
        $(document).ready(function () {
            $('#openAddLineaPedidoModal').click(function () {
                var idPedido = $(this).data('id-pedido');
                $.ajax({
                    url: '<?= base_url("pedidos/mostrarFormularioAddLineaPedido") ?>/' + idPedido,
                    method: 'GET',
                    success: function (response) {
                        $('#modalBodyAddLineaPedido').html(response);
                        $('#addLineaPedidoModal').modal('show');
                    },
                    error: function () {
                        alert('Hubo un error al cargar el formulario. Por favor, intenta de nuevo.');
                    }
                });
            });
            $(document).on('submit', '#addLineaPedidoForm', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        location.reload();
                    },
                    error: function () {
                        alert('No se pudo guardar la línea de pedido.');
                    }
                });
            });
        });

        document.getElementById('duplicarPedido').addEventListener('click', function () {
            if (confirm('¿Estás seguro de duplicar este pedido?')) {
                window.location.href = "<?= base_url('pedidos/duplicar/' . $pedido->id_pedido) ?>";
            }
        });

        function updateBtImprimir(bt_imprimir) {
            const idPedido = <?= $pedido->id_pedido ?>; // Obtén el ID del pedido desde PHP

            // Realiza la llamada AJAX
            fetch(`<?= base_url('pedidos/updateBtImprimir/') ?>${idPedido}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ bt_imprimir: bt_imprimir }), // Envía el valor de bt_imprimir
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message); // Muestra un mensaje de éxito
                        location.reload(); // Recarga la página para reflejar los cambios
                    } else {
                        alert(data.message); // Muestra un mensaje de error
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al actualizar el estado de impresión.');
                });
        }
    </script>
    <!-- Modal para abrir incidencia -->
    <div class="modal fade" id="abrirIncidenciaModal" tabindex="-1" aria-labelledby="abrirIncidenciaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formAbrirIncidencia" action="<?= base_url('pedidos/abrirIncidencia/' . $pedido->id_pedido) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="abrirIncidenciaLabel">Abrir Incidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="incidencia">Descripción de la incidencia:</label>
                            <textarea id="incidencia" name="incidencia" class="form-control" rows="4" required></textarea>
                        </div>
                        <input type="hidden" name="estado_incidencia" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>
