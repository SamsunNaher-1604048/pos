<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding pos-logo">
                <a class="" href="{{route('dashboard')}}">DEV POS</a>
        </div>

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">

                <li class="nav-item">
                    <a class="nav-link active" href="{{route('dashboard')}}">
                        <span class="nav-link-text">Dashboard</span>
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

            </ul>
        </nav>
    </div>
</div>
