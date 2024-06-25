<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="{{asset('assets/images/app-logo.svg')}}" alt="logo"><span class="logo-text">TASK</span></a>

        </div><!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">

                <li class="nav-item">
                    <a class="nav-link active" href="{{route('dashboard')}}">
                        <span class="nav-link-text">Overview</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('product.index')}}">
                        <span class="nav-link-text">Product</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('order.index')}}">
                        <span class="nav-link-text">Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{route('pos.show')}}">
                        <span class="nav-link-text">POS</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
