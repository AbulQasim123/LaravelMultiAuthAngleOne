<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link">
                <i class="bi bi-list-task"></i>
                <span>Task Board</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="{{ request()->is('logout') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
        </li>
    </ul>
</aside>
