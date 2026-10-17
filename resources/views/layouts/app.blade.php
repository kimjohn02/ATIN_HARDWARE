<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATIN Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Select 2 CSS -->
    <link href="{{ asset('css/vendor/select2.min.css') }}" rel="stylesheet">
    
    <style>
        
        /* Company Color Variables */
        :root {
            --congress-blue: #06448a;
            --brand-primary: #06448a;
            --brand-secondary: #fac307;
            --amber: #fac307;
            --white: #ffffff;
            --monza: #e20615;
            --sidebar-bg: #ffffff;
            --body-bg: #fdfdfd;
            --card-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.08), 0 2px 10px -5px rgba(0, 0, 0, 0.04);
            --sidebar-width: 260px;
            --premium-border: 1px solid rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--body-bg);
            color: #1f2937;
            overflow-x: hidden;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .sidebar {
            background: var(--sidebar-bg);
            color: #374151;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            padding-top: 25px;
            box-shadow: 20px 0 40px -15px rgba(0, 0, 0, 0.03);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-right: var(--premium-border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 30px;
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.1) transparent;
        }
        
        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .sidebar .nav-link {
            color: #64748b;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
        
        .sidebar .nav-link i {
            font-size: 1.1rem;
            margin-right: 12px;
            transition: all 0.2s ease;
        }
        
        .sidebar .nav-link:hover {
            background: #f9fafb;
            color: var(--congress-blue);
            transform: translateX(4px);
        }
        
        .sidebar .nav-link.active {
            background: var(--congress-blue);
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(6, 68, 138, 0.25);
        }
        
        .sidebar .nav-link.active i {
            color: #ffffff;
        }

        .sidebar .nav-link.active .chevron {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .sidebar .nav-link .chevron {
            margin-left: auto;
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link[aria-expanded="true"] .chevron {   
            transform: rotate(90deg);
        }
                    
        .sub-link {
            padding: 8px 15px 8px 48px !important;
            font-size: 0.85rem;
            margin: 1px 16px !important;
            border-radius: 8px !important;
        }

        .sub-link:hover {
            background: #f3f4f6 !important;
            transform: none !important;
        }

        .sub-link.active {
            background: rgba(6, 68, 138, 0.05) !important;
            color: var(--congress-blue) !important;
            box-shadow: none !important;
        }
        
        .sub-icon {
            font-size: 0.5rem;
        }
        
        .main-iframe {
            margin-left: var(--sidebar-width);
            width: calc(100vw - var(--sidebar-width));
            height: 100vh;
            border: none;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100vw - var(--sidebar-width));
            min-height: 100vh;
            padding: 30px;
            background: var(--body-bg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--amber);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 16px;
            border: 3px solid #e9ecef;
        }
        
        .logo-container {
            padding: 0 25px 25px 25px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }
        
        .sidebar-toggle-btn {
            color: var(--congress-blue);
            font-size: 1.2rem;
            transition: transform 0.3s ease;
            background: none;
            border: none;
        }
        
        .sidebar-toggle-btn:hover {
            color: var(--congress-blue);
            transform: scale(1.1);
        }
        
        .sidebar-toggle-btn i {
            transition: transform 0.3s ease;
        }
        
        /* Collapsed Sidebar Styles */
        .sidebar {
            transition: width 0.3s ease;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .logo-text {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-logo {
            margin-right: 0 !important;
        }
        
        .sidebar.collapsed .sidebar-toggle-btn i {
            transform: rotate(180deg);
        }
        
        .sidebar.collapsed .nav-link {
            padding: 15px;
            margin: 8px 10px;
            text-align: center;
            justify-content: center;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0 !important;
            font-size: 1.2rem;
        }
        
        .sidebar.collapsed .nav-link .chevron {
            display: none;
        }
        
        .sidebar.collapsed .collapse {
            display: none !important;
        }
        
        .sidebar.collapsed .collapse.show {
            display: none !important;
        }
        
        .sidebar.collapsed .sidebar-user-info {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-user-link {
            justify-content: center;
            width: 100%;
        }
        
        .sidebar.collapsed .user-avatar {
            margin-right: 0 !important;
            margin-left: 0 !important;
            width: 40px !important;
            height: 40px !important;
            min-width: 40px !important;
            min-height: 40px !important;
            flex-shrink: 0;
        }
        
        .sidebar.collapsed .sidebar-footer {
            padding: 15px 10px !important;
        }
        
        .sidebar.collapsed .dropdown {
            position: static;
        }
        
        /* Only apply fixed positioning when sidebar is collapsed */
        .sidebar.collapsed .dropdown-menu.show {
            position: fixed !important;
            left: 80px !important;
            transform: none !important;
            margin-top: 0 !important;
            z-index: 1051 !important;
            min-width: 200px;
        }
        
        /* Reset dropdown positioning for expanded sidebar (admin view) */
        .sidebar:not(.collapsed) .dropdown-menu {
            position: absolute !important;
            left: auto !important;
            transform: translateX(0) !important;
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: 80px;
            width: calc(100vw - 80px);
            transition: margin-left 0.3s ease, width 0.3s ease;
        }
        
        .notification-badge {
            background: var(--monza);
            color: var(--white);
        }
        
        @media (max-width: 992px) and (min-width: 769px) {
            .sidebar {
                width: 80px;
                text-align: center;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .logo-text {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0 !important;
                font-size: 1.2rem;
            }
            
            .sidebar .nav-link {
                padding: 15px;
                margin: 8px 10px;
                text-align: center;
            }

            .sidebar .sidebar-user-info {
                display: none !important; /* Hide the name */
            }
            
            .sidebar .user-avatar {
                margin-right: 0 !important;
                margin-left: 0 !important;
                width: 40px !important;
                height: 40px !important;
                min-width: 40px !important;
                min-height: 40px !important;
                flex-shrink: 0;
                display: flex !important;
            }

            .sidebar .nav .nav {
                padding-left: 0 !important;
            }
            
            .sidebar .nav .nav .nav-item .nav-link {
                padding-left: 15px !important;
            }
            
            .sidebar .dropdown-menu.show {
                position: fixed !important;
                left: 80px !important;
                transform: none !important;
                margin-top: 0 !important;
                z-index: 1051 !important;
                min-width: 200px;
            }

            .main-content {
                margin-left: 80px;
                width: calc(100vw - 80px);
            }

            .main-iframe {
                margin-left: 80px;
                width: calc(100vw - 80px);
            }
        }

        /* Mobile Top Navbar & Backdrop */
        .mobile-navbar {
            background: #ffffff;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1020;
            padding: 8px 16px;
            min-height: 56px;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }

        /* Mobile Devices (<= 768px) */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 280px !important;
                height: 100vh !important;
                z-index: 1050 !important;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 15px 0 35px rgba(0, 0, 0, 0.15) !important;
                border-right: none !important;
            }

            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }

            .sidebar.mobile-open .logo-text {
                display: block !important;
            }

            .sidebar.mobile-open .nav-link span {
                display: inline-block !important;
            }

            .sidebar.mobile-open .sidebar-user-info {
                display: block !important;
            }

            .sidebar.mobile-open .nav-link .chevron {
                display: inline-block !important;
            }

            .sidebar.mobile-open .nav-link {
                text-align: left !important;
                justify-content: flex-start !important;
                padding: 12px 18px !important;
                margin: 4px 10px !important;
            }

            .sidebar.mobile-open .nav-link i {
                margin-right: 12px !important;
                font-size: 1.1rem !important;
            }

            .sidebar.mobile-open .user-avatar {
                margin-right: 12px !important;
            }

            .sidebar.mobile-open .dropdown-menu.show {
                position: absolute !important;
                left: 0 !important;
                top: auto !important;
                bottom: 100% !important;
                margin-bottom: 8px !important;
                width: 100% !important;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100vw !important;
                padding: 16px 12px !important;
                min-height: calc(100vh - 56px);
            }

            .main-iframe {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }

            .modal-dialog {
                margin: 0.5rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>

   <!-- Default Password Reminder Modal -->
    <div class="modal fade" id="defaultPasswordModal" tabindex="-1" aria-labelledby="defaultPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-2 shadow-sm">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="defaultPasswordModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Security Reminder
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <p class="fs-6">
                        You are currently using your <strong>default password</strong>.
                    </p>
                    <p>
                        For your account security, we strongly recommend updating it as soon as possible.
                    </p>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" id="dismissDefaultPasswordModal">Later</button>
                    <a href="{{ route('account.settings') }}" class="btn btn-warning fw-semibold" id="changeNowBtn">Change Password</a>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    @include('components.sidebar')
    
    <!-- Mobile Navigation Bar -->
    <header class="mobile-navbar d-md-none d-flex align-items-center justify-content-between shadow-sm">
        <button type="button" class="btn btn-light border-0 p-1 me-2" id="mobileSidebarToggle" aria-label="Toggle Navigation">
            <i class="bi bi-list fs-2" style="color: var(--congress-blue);"></i>
        </button>
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/atin_logo.png') }}" alt="Company Logo" style="max-height: 32px;" class="me-2">
            <span class="fw-bold fs-5" style="color: var(--congress-blue); letter-spacing: -0.5px;">ATIN</span>
        </div>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar" style="width: 34px; height: 34px; font-size: 14px; border-width: 2px;">
                    {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold small text-truncate" style="max-width: 180px;">{{ session('user_name') }}</div>
                    <div class="text-muted smaller" style="font-size: 0.75rem;">{{ session('user_role') }}</div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('account.settings') }}">
                        <i class="bi bi-gear me-2"></i>Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="/logout" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Select 2 JS -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/select2.min.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('defaultPasswordModal');
    
            // Check the session flag that you set in login controller
            const shouldShowModal = {{ session('show_default_password_modal') ? 'true' : 'false' }};
    
            console.log('Session flag - show modal:', shouldShowModal);
            console.log('User password changed:', {{ auth()->check() ? (auth()->user()->password_changed ? 'true' : 'false') : 'false' }});
    
            if (modalEl && shouldShowModal) {
                console.log('Showing default password modal from session flag');
                const defaultModal = new bootstrap.Modal(modalEl);
                defaultModal.show();
    
                // Clear the session flag so it doesn't show again on page refresh
                fetch('{{ route("clear-password-modal-flag") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).catch(err => console.log('Flag clear request failed:', err));
    
                // Later button hides modal
                document.getElementById('dismissDefaultPasswordModal').addEventListener('click', function() {
                    defaultModal.hide();
                });
    
                // Change Now button navigates to settings
                document.getElementById('changeNowBtn').addEventListener('click', function() {
                    // The href will handle navigation
                });
            }
    
            // Sidebar functionality
            const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
            
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // If it's a collapse toggle (has data-bs-toggle="collapse"), don't prevent default
                    if (this.getAttribute('data-bs-toggle') === 'collapse') {
                        // Let Bootstrap handle the collapse
                        return;
                    }
                    
                    // If it's a regular navigation link (has href and not #), let it navigate normally
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        // Let the browser navigate to the page normally
                        return;
                    }
                    
                    // Only prevent default for links that don't navigate anywhere
                    e.preventDefault();
                    
                    // Update active state for non-navigation links
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
    
            // Auto-expand sidebar sections based on current page
            const currentPath = window.location.pathname;
            if (currentPath.includes('/roles') || currentPath.includes('/users')) {
                const userCollapse = document.getElementById('collapseUser');
                if (userCollapse) {
                    userCollapse.classList.add('show');
                    const trigger = document.querySelector('[aria-controls="collapseUser"]');
                    if (trigger) {
                        trigger.classList.remove('collapsed');
                    }
                }
            }
            
            // Auto-expand inventory section if on related pages
            if (currentPath.includes('/products') || currentPath.includes('/categories') || currentPath.includes('/suppliers')) {
                const inventoryCollapse = document.getElementById('collapseInventory');
                if (inventoryCollapse) {
                    inventoryCollapse.classList.add('show');
                    const trigger = document.querySelector('[aria-controls="collapseInventory"]');
                    if (trigger) {
                        trigger.classList.remove('collapsed');
                    }
                }
            }
            
            // Sidebar state management - no toggle, role-based only
            const sidebar = document.querySelector('.sidebar');
            const isCashier = {{ session('user_role') == 'Cashier' ? 'true' : 'false' }};
            
            if (sidebar) {
                // Force correct state based on role (no user preference)
                if (isCashier) {
                    // Cashier: Always collapsed
                    sidebar.classList.add('collapsed');
                } else {
                    // Admin: Always expanded
                    sidebar.classList.remove('collapsed');
                }
            }
            
            // Fix dropdown menu positioning when sidebar is collapsed
            if (isCashier) {
                const dropdownToggle = document.querySelector('.sidebar.collapsed .sidebar-user-link');
                const dropdownMenu = document.querySelector('.sidebar.collapsed .dropdown-menu');
                
                if (dropdownToggle && dropdownMenu) {
                    // Use Bootstrap's dropdown events
                    dropdownToggle.addEventListener('show.bs.dropdown', function() {
                        const rect = this.getBoundingClientRect();
                        dropdownMenu.style.position = 'fixed';
                        dropdownMenu.style.left = '80px';
                        dropdownMenu.style.top = (rect.top - dropdownMenu.offsetHeight - 10) + 'px';
                        dropdownMenu.style.bottom = 'auto';
                        dropdownMenu.style.transform = 'none';
                        dropdownMenu.style.zIndex = '1051';
                        
                        // Ensure it doesn't go off screen
                        const menuHeight = dropdownMenu.offsetHeight;
                        const windowHeight = window.innerHeight;
                        if (parseInt(dropdownMenu.style.top) < 10) {
                            dropdownMenu.style.top = '10px';
                        }
                        if (rect.top - menuHeight < 10) {
                            dropdownMenu.style.top = (rect.bottom + 10) + 'px';
                        }
                    });
                }
            }
            
            // Initialize Bootstrap tooltips for sidebar links when collapsed
            function initializeTooltips() {
                const sidebar = document.querySelector('.sidebar');
                const tooltipTriggerList = document.querySelectorAll('.sidebar .nav-link[title]');
                
                // Destroy existing tooltips first
                tooltipTriggerList.forEach(el => {
                    const existingTooltip = bootstrap.Tooltip.getInstance(el);
                    if (existingTooltip) {
                        existingTooltip.dispose();
                    }
                });
                
                // Create new tooltips only if sidebar is collapsed
                if (sidebar && sidebar.classList.contains('collapsed')) {
                    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                        new bootstrap.Tooltip(tooltipTriggerEl, {
                            placement: 'right',
                            trigger: 'hover'
                        });
                    });
                }
            }
            
            // Initialize tooltips if sidebar is collapsed
            initializeTooltips();

            // Global AJAX Pagination
            document.addEventListener('click', function(e) {
                const link = e.target.closest('.pagination a');
                if (link) {
                    const url = link.getAttribute('href');
                    if (!url || url === '#' || url.startsWith('javascript:')) return;
                    
                    e.preventDefault();

                    // Find the closest container with an ID to update
                    const container = link.closest('[id]');
                    if (!container) {
                        window.location.href = url;
                        return;
                    }
                    
                    const containerId = container.id;

                    // Visual feedback
                    container.style.opacity = '0.5';
                    container.style.pointerEvents = 'none';

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById(containerId);
                        
                        if (newContent) {
                            container.innerHTML = newContent.innerHTML;
                            window.history.pushState({}, '', url);
                            
                            // Re-initialize tooltips in the new content
                            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                                const tooltips = container.querySelectorAll('[data-bs-toggle="tooltip"]');
                                tooltips.forEach(t => new bootstrap.Tooltip(t));
                            }
                        } else {
                            window.location.href = url;
                        }
                    })
                    .catch(error => {
                        console.error('Pagination error:', error);
                        window.location.href = url;
                    })
                    .finally(() => {
                        container.style.opacity = '1';
                        container.style.pointerEvents = 'auto';
                    });
                }
            });

            // Mobile Sidebar Drawer Toggle
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const sidebarMobileClose = document.getElementById('sidebarMobileClose');

            function openMobileSidebar() {
                if (sidebar) {
                    sidebar.classList.add('mobile-open');
                }
                if (sidebarBackdrop) {
                    sidebarBackdrop.classList.add('show');
                }
                document.body.style.overflow = 'hidden';
            }

            function closeMobileSidebar() {
                if (sidebar) {
                    sidebar.classList.remove('mobile-open');
                }
                if (sidebarBackdrop) {
                    sidebarBackdrop.classList.remove('show');
                }
                document.body.style.overflow = '';
            }

            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', openMobileSidebar);
            }
            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', closeMobileSidebar);
            }
            if (sidebarMobileClose) {
                sidebarMobileClose.addEventListener('click', closeMobileSidebar);
            }

            // Close mobile sidebar on link click
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768 && !this.getAttribute('data-bs-toggle')) {
                        closeMobileSidebar();
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>