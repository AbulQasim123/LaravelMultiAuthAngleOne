<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="{{ request()->is('admin/dashboard') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('admin/dashboard') }}">
                <i class="bi bi-calendar-check"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="{{ request()->is('admin/client') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('admin/client') }}">
                <i class="bi bi-person-circle"></i>
                <span>Client</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="{{ request()->is('admin/project') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('admin/project') }}">
                <i class="fa-regular fa-folder-open"></i>
                <span>Project</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="{{ request()->is('admin/employee') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('admin/employee') }}">
                <i class="bi bi bi-people-fill"></i>
                <span>Employee</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="{{ request()->is('admin/task') ? 'nav-link' : 'nav-link collapsed' }}"
                href="{{ URL::to('admin/task') }}">
                <i class="bi bi-list-task"></i>
                <span>Task</span>
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
