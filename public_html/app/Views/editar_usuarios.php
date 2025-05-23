<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/amiga') ?>
<div class="container mt-4">
    <h2>Editar Usuario</h2>
    <div class="btnsEditPedido">
        <a href="<?= base_url('usuarios/datosAcceso/' . $usuario['id']) ?>" class="btn boton btnEditar">
            Datos de Acceso
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-workspace" viewBox="0 0 16 16">
                <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                <path
                    d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-11h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
            </svg>
        </a>
    </div>
    <form action="<?= base_url('usuarios/actualizarUsuario') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

        <div class="form-group">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                value="<?= esc($usuario['nombre_usuario']) ?>" required>
        </div>
        <div class="form-group">
            <label for="apellidos_usuario">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos_usuario" name="apellidos_usuario"
                value="<?= esc($usuario['apellidos_usuario']) ?>">
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni"
                value="<?= esc($usuario['dni']) ?>">
        </div>
        <div class="form-group">
            <label for="seguridad_social">Seguridad Social</label>
            <input type="text" class="form-control" id="seguridad_social" name="seguridad_social"
                value="<?= esc($usuario['seguridad_social']) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= esc($usuario['email']) ?>">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono"
                value="<?= esc($usuario['telefono']) ?>">
        </div>
        <div class="form-group">
            <label for="user_activo">Activo:</label>
            <select class="form-control" id="user_activo" name="user_activo">
                <option value="1" <?= $usuario['user_activo'] == 1 ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= $usuario['user_activo'] == 0 ? 'selected' : '' ?>>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_ficha">Fichaje:</label>
            <select class="form-control" id="user_ficha" name="user_ficha">
                <option value="1" <?= $usuario['user_ficha'] == 1 ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= $usuario['user_ficha'] == 0 ? 'selected' : '' ?>>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="userfoto">Foto de Usuario:</label>
            <input type="file" class="form-control" id="userfoto" name="userfoto" accept="image/*">
            <?php if (!empty($usuario['userfoto'])): ?>
                <div class="mt-2">
                    <img src="<?= base_url("public/assets/uploads/files/" . $id_empresa . "/usuarios/" . $usuario['userfoto']) ?>"
                        alt="Foto de usuario" height="100">
                    <button type="button" class="btn boton btnEliminar" onclick="confirmarEliminacion()"><svg
                            xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                            <path
                                d="M7.66752 6.776C7.41731 6.776 7.17736 6.87593 7.00044 7.05379C6.82351 7.23166 6.72412 7.47289 6.72412 7.72443V8.67286C6.72412 8.9244 6.82351 9.16563 7.00044 9.3435C7.17736 9.52136 7.41731 9.62129 7.66752 9.62129H8.13922V18.1571C8.13922 18.6602 8.338 19.1427 8.69184 19.4984C9.04569 19.8541 9.5256 20.054 10.026 20.054H15.6864C16.1868 20.054 16.6667 19.8541 17.0205 19.4984C17.3744 19.1427 17.5732 18.6602 17.5732 18.1571V9.62129H18.0449C18.2951 9.62129 18.535 9.52136 18.712 9.3435C18.8889 9.16563 18.9883 8.9244 18.9883 8.67286V7.72443C18.9883 7.47289 18.8889 7.23166 18.712 7.05379C18.535 6.87593 18.2951 6.776 18.0449 6.776H14.743C14.743 6.52446 14.6436 6.28323 14.4667 6.10536C14.2898 5.9275 14.0498 5.82758 13.7996 5.82758H11.9128C11.6626 5.82758 11.4226 5.9275 11.2457 6.10536C11.0688 6.28323 10.9694 6.52446 10.9694 6.776H7.66752ZM10.4977 10.5697C10.6228 10.5697 10.7428 10.6197 10.8312 10.7086C10.9197 10.7975 10.9694 10.9182 10.9694 11.0439V17.6829C10.9694 17.8087 10.9197 17.9293 10.8312 18.0182C10.7428 18.1072 10.6228 18.1571 10.4977 18.1571C10.3726 18.1571 10.2526 18.1072 10.1642 18.0182C10.0757 17.9293 10.026 17.8087 10.026 17.6829V11.0439C10.026 10.9182 10.0757 10.7975 10.1642 10.7086C10.2526 10.6197 10.3726 10.5697 10.4977 10.5697ZM12.8562 10.5697C12.9813 10.5697 13.1013 10.6197 13.1897 10.7086C13.2782 10.7975 13.3279 10.9182 13.3279 11.0439V17.6829C13.3279 17.8087 13.2782 17.9293 13.1897 18.0182C13.1013 18.1072 12.9813 18.1571 12.8562 18.1571C12.7311 18.1571 12.6111 18.1072 12.5227 18.0182C12.4342 17.9293 12.3845 17.8087 12.3845 17.6829V11.0439C12.3845 10.9182 12.4342 10.7975 12.5227 10.7086C12.6111 10.6197 12.7311 10.5697 12.8562 10.5697ZM15.6864 11.0439V17.6829C15.6864 17.8087 15.6367 17.9293 15.5482 18.0182C15.4598 18.1072 15.3398 18.1571 15.2147 18.1571C15.0896 18.1571 14.9696 18.1072 14.8811 18.0182C14.7927 17.9293 14.743 17.8087 14.743 17.6829V11.0439C14.743 10.9182 14.7927 10.7975 14.8811 10.7086C14.9696 10.6197 15.0896 10.5697 15.2147 10.5697C15.3398 10.5697 15.4598 10.6197 15.5482 10.7086C15.6367 10.7975 15.6864 10.9182 15.6864 11.0439Z"
                                fill="white" />
                        </svg></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="buttonsEditProductProveedAbajo">
            <a href="<?= base_url('usuarios') ?>" type="button" class="boton volverButton">
                Volver
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M19.5 13C19.5 13.2155 19.4144 13.4221 19.262 13.5745C19.1096 13.7269 18.903 13.8125 18.6875 13.8125H9.27386L12.7627 17.2997C12.8383 17.3753 12.8982 17.465 12.9391 17.5637C12.98 17.6624 13.001 17.7682 13.001 17.875C13.001 17.9818 12.98 18.0876 12.9391 18.1863C12.8982 18.285 12.8383 18.3747 12.7627 18.4502C12.6872 18.5258 12.5975 18.5857 12.4988 18.6266C12.4001 18.6675 12.2943 18.6885 12.1875 18.6885C12.0807 18.6885 11.9749 18.6675 11.8762 18.6266C11.7775 18.5857 11.6878 18.5258 11.6122 18.4502L6.73724 13.5752C6.66157 13.4998 6.60154 13.4101 6.56058 13.3114C6.51962 13.2127 6.49854 13.1069 6.49854 13C6.49854 12.8931 6.51962 12.7873 6.56058 12.6886C6.60154 12.5899 6.66157 12.5002 6.73724 12.4247L11.6122 7.54974C11.7648 7.39717 11.9717 7.31146 12.1875 7.31146C12.4032 7.31146 12.6102 7.39717 12.7627 7.54974C12.9153 7.7023 13.001 7.90923 13.001 8.12499C13.001 8.34075 12.9153 8.54767 12.7627 8.70024L9.27386 12.1875H18.6875C18.903 12.1875 19.1096 12.2731 19.262 12.4255C19.4144 12.5778 19.5 12.7845 19.5 13Z"
                        fill="white" />
                </svg>
            </a>
            <button type="submit" class="boton btnGuardar">Guardar Cambios
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 27" fill="none">
                    <path
                        d="M7.11751 6.91875C6.86324 6.91875 6.61937 7.01976 6.43957 7.19956C6.25977 7.37936 6.15876 7.62322 6.15876 7.8775V19.3825C6.15876 19.6368 6.25977 19.8806 6.43957 20.0604C6.61937 20.2402 6.86324 20.3413 7.11751 20.3413H18.6225C18.8768 20.3413 19.1207 20.2402 19.3005 20.0604C19.4803 19.8806 19.5813 19.6368 19.5813 19.3825V7.8775C19.5813 7.62322 19.4803 7.37936 19.3005 7.19956C19.1207 7.01976 18.8768 6.91875 18.6225 6.91875H14.3081C14.0539 6.91875 13.81 7.01976 13.6302 7.19956C13.4504 7.37936 13.3494 7.62322 13.3494 7.8775V14.8697L15.8862 12.3319C15.9763 12.2418 16.0983 12.1913 16.2256 12.1913C16.3529 12.1913 16.475 12.2418 16.565 12.3319C16.655 12.4219 16.7056 12.544 16.7056 12.6712C16.7056 12.7985 16.655 12.9206 16.565 13.0106L13.2094 16.3663C13.1649 16.4109 13.112 16.4463 13.0537 16.4705C12.9955 16.4947 12.9331 16.5071 12.87 16.5071C12.807 16.5071 12.7445 16.4947 12.6863 16.4705C12.628 16.4463 12.5751 16.4109 12.5306 16.3663L9.17499 13.0106C9.13042 12.9661 9.09506 12.9132 9.07094 12.8549C9.04682 12.7967 9.03441 12.7343 9.03441 12.6712C9.03441 12.6082 9.04682 12.5458 9.07094 12.4876C9.09506 12.4293 9.13042 12.3764 9.17499 12.3319C9.21956 12.2873 9.27247 12.2519 9.33071 12.2278C9.38894 12.2037 9.45136 12.1913 9.51439 12.1913C9.57742 12.1913 9.63983 12.2037 9.69807 12.2278C9.7563 12.2519 9.80921 12.2873 9.85379 12.3319L12.3906 14.8697V7.8775C12.3906 7.36895 12.5927 6.88122 12.9523 6.52162C13.3119 6.16202 13.7996 5.96 14.3081 5.96H18.6225C19.1311 5.96 19.6188 6.16202 19.9784 6.52162C20.338 6.88122 20.54 7.36895 20.54 7.8775V19.3825C20.54 19.8911 20.338 20.3788 19.9784 20.7384C19.6188 21.098 19.1311 21.3 18.6225 21.3H7.11751C6.60896 21.3 6.12124 21.098 5.76164 20.7384C5.40203 20.3788 5.20001 19.8911 5.20001 19.3825V7.8775C5.20001 7.36895 5.40203 6.88122 5.76164 6.52162C6.12124 6.16202 6.60896 5.96 7.11751 5.96H9.51439C9.64153 5.96 9.76346 6.0105 9.85336 6.1004C9.94326 6.19031 9.99376 6.31224 9.99376 6.43937C9.99376 6.56651 9.94326 6.68844 9.85336 6.77834C9.76346 6.86824 9.64153 6.91875 9.51439 6.91875H7.11751Z"
                        fill="white" />
                </svg>
            </button>
        </div>
    </form>
</div>
<script>
    function confirmarEliminacion() {
        if (confirm("¿Estás seguro de que deseas eliminar esta imagen?")) {
            // Aquí se puede realizar una petición para eliminar la imagen
            // o usar un formulario para eliminarla en el backend
            window.location.href = "<?= base_url('usuarios/eliminarFoto/' . $usuario['id']) ?>";
        }
    }
</script>
<?= $this->endSection() ?>