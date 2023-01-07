<div class="nk-sidebar nk-sidebar-fixed bg-white" data-content="sidebarMenu">
<!-- <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu"> -->
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{asset('assets/images/leaf-branch-logo.png')}}" srcset="{{asset('assets/images/leaf-branch-logo.png')}}" alt="logo">
                            <img class="logo-dark logo-img" src="{{asset('assets/images/leaf-branch-logo.png')}}" srcset="{{asset('assets/images/leaf-branch-logo.png')}}" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Master Data</h6>
                                </li>
                                {{-- <li class="nk-menu-item">
                                    <a href="{{URL('/crud')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                        <span class="nk-menu-text">CRUD Example</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{URL('/penjamin')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Data Penjamin</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{URL('/iks')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-linux-server"></em></span>
                                        <span class="nk-menu-text">Ikatan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{URL('/tipeiks')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                        <span class="nk-menu-text">Data Tipe IKS</span>
                                    </a>
                                </li>
                            </li>  --}}
                            
                            
                            <li class="nk-menu-item">
                                <a href="{{URL('/iks')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                    <span class="nk-menu-text">Manajemen IKS</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{URL('/iks')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data IKS</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{URL('/penjamin')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data Penjamin</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{URL('/tipeiks')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data Tipe</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            <li class="nk-menu-item">
                                <a href="{{URL('/komponengroups')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                    <span class="nk-menu-text">Manajemen Komponen IKS</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{URL('/komponengroups')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data Komponen Group</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{URL('/komponengroupdetail')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data Komponen Group Detail</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- <li class="nk-menu-item">
                                <a href="{{URL('/komponengroups')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                    <span class="nk-menu-text">Komponen Groups</span>
                                </a> --}}

                            </li><!-- .nk-menu-item -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Transactions</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{URL('/transaksiikspro')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                        <span class="nk-menu-text">Transaksi IKS Provider</span><!-- <span class="nk-menu-badge">HOT</span> -->
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{URL('/transaksikomiks')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text">Transaksi Komponen IKS</span><!-- <span class="nk-menu-badge">HOT</span> -->
                                    </a>
                                </li><!-- .nk-menu-item -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{URL('/trx2')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text">Transaksi Komponen IKS Detail</span><!-- <span class="nk-menu-badge">HOT</span> -->
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Report</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{URL('/report1')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-list-index"></em></span>
                                        <span class="nk-menu-text">Report 1</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{URL('/report2')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                                        <span class="nk-menu-text">Report 2</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>