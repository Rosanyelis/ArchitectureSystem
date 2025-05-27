<div class="modal fade" id="AddClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nuevo Cliente </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-5">
                    <div class="col-md-4" >
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Ingrese Nombre"
                                required
                            />
                            <label for="code">Nombre</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4" >
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="lastname"
                                name="lastname"
                                class="form-control"
                                placeholder="Ingrese Apellido"
                                required
                            />
                            <label for="code">Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="Ingrese Teléfono"
                                maxlength="10"
                                required
                            />
                            <label for="code">Teléfono</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="email"
                                id="correo"
                                name="correo"
                                class="form-control "
                                placeholder="Ingrese Correo"
                            />
                            <label for="code">Correo</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="provincia"
                                name="provincia"
                                class="form-control"
                                placeholder="Ingrese Provincia"
                            />
                            <label for="code">Provincia</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="domicilio"
                                name="domicilio"
                                class="form-control"
                                placeholder="Ingrese Domicilio"
                            />
                            <label for="code">Domicilio</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="localidad"
                                name="localidad"
                                class="form-control"
                                placeholder="Ingrese Localidad"
                            />
                            <label for="code">Localidad</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveClient" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
