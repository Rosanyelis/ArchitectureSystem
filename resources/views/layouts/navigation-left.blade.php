        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <span style="color: var(--bs-primary)">
                            <img src="{{ asset('assets/img/oromatic-logo.png') }}" width="160" height="70" alt="" >
                        </span>
                    </span>
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                        fill-opacity="0.9" />
                        <path
                        d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                        fill-opacity="0.4" />
                    </svg>
                </a>
            </div>
            <div class="menu-inner-shadow"></div>
            @role('Administrador')
            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item @if (Route::currentRouteName() == 'dashboard') active @endif">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-home-smile-line"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <li class="menu-header mt-1">
                    <span class="menu-header-text" data-i18n="Catálogos">Catálogos</span>
                </li>
                <li class="menu-item
                        @if (Route::currentRouteName() == 'client.index' ||
                                Route::currentRouteName() == 'client.create' ||
                                Route::currentRouteName() == 'client.edit' ||
                                Route::currentRouteName() == 'supplier.index' ||
                                Route::currentRouteName() == 'supplier.create' ||
                                Route::currentRouteName() == 'supplier.edit' ||
                                Route::currentRouteName() == 'material.index' ||
                                Route::currentRouteName() == 'material.create' ||
                                Route::currentRouteName() == 'material.edit' 
                                )
                            active open
                        @endif
                    ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ri-box-3-fill"></i>
                        <div data-i18n="Catalogos">Catalogos</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'client.index' ||
                                Route::currentRouteName() == 'client.create' ||
                                Route::currentRouteName() == 'client.edit') active @endif">
                            <a href="{{ route('client.index') }}" class="menu-link">
                                <div data-i18n="Clientes">Clientes</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'supplier.index' ||
                                Route::currentRouteName() == 'supplier.create' ||
                                Route::currentRouteName() == 'supplier.edit') active @endif">
                            <a href="{{ route('supplier.index') }}" class="menu-link">
                                <div data-i18n="Proveedores">Proveedores</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'material.index' ||
                                Route::currentRouteName() == 'material.create' ||
                                Route::currentRouteName() == 'material.edit') active @endif">
                            <a href="{{ route('material.index') }}" class="menu-link">
                                <div data-i18n="Materiales">Materiales</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'contractor.index' ||
                                Route::currentRouteName() == 'contractor.create' ||
                                Route::currentRouteName() == 'contractor.edit') active @endif">
                            <a href="{{ route('contractor.index') }}" class="menu-link">
                                <div data-i18n="Contratistas">Contratistas</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'dollar-rate.index' ||
                                Route::currentRouteName() == 'dollar-rate.create' ||
                                Route::currentRouteName() == 'dollar-rate.edit') active @endif">
                            <a href="{{ route('dollar-rate.index') }}" class="menu-link">
                                <div data-i18n="Tasa de dolar">Tasa de dolar</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header mt-1">
                    <span class="menu-header-text" data-i18n="Proyectos">Proyectos</span>
                </li>
                <li class="menu-item
                    ">
                    <a href="{{ route('budget.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-file-list-3-line"></i>
                        <div data-i18n="Presupuestos">Presupuestos</div>
                    </a>
                </li>
                <li class="menu-item
                    ">
                    <a href="{{ route('project.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-todo-fill"></i>
                        <div data-i18n="Proyectos">Proyectos</div>
                    </a>
                </li>
                
                <li class="menu-header mt-1">
                    <span class="menu-header-text" data-i18n="Configuraciones">Configuraciones</span>
                </li>
                <li class="menu-item
                        @if (Route::currentRouteName() == 'user.index' ||
                                Route::currentRouteName() == 'user.create' ||
                                Route::currentRouteName() == 'user.edit' 
                                )
                            active open
                        @endif
                    ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ri-list-settings-fill"></i>
                        <div data-i18n="Configuraciones">Configuraciones</div>
                    </a>
                    <ul class="menu-sub">
                        
                       
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'user.index' ||
                                Route::currentRouteName() == 'user.create' ||
                                Route::currentRouteName() == 'user.edit') active @endif">
                            <a href="{{ route('user.index') }}" class="menu-link">
                                <div data-i18n="Usuarios">Usuarios</div>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
            @else
            
            @endrole
        </aside>
