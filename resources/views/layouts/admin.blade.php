<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - GenShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #1e40af;
            --bg: #f6f7fc;
            --border: #d1d7e5;
            --text: #1f2a44;
            --text-muted: #667085;
            --success: #16a34a;
            --warn: #d97706;
            --danger: #dc2626;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        a { color: inherit; text-decoration: none; }

        .sidebar {
            width: var(--sidebar-width);
            background: #fff;
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .sidebar-brand {
            padding: 28px 24px 22px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.04em;
            color: #0c3a97;
        }

        .sidebar-brand span {
            display: block;
            margin-top: 8px;
            font-size: 16px;
            color: var(--text-muted);
        }

        .sidebar-nav {
            flex: 1;
            padding: 22px 12px 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 0;
            color: var(--text);
            font-size: 16px;
            font-weight: 500;
            transition: background .15s, color .15s;
        }

        .sidebar-nav a:hover {
            background: #f1f5f9;
        }

        .sidebar-nav a.active {
            background: #dbe8ff;
            color: var(--primary);
        }

        .sidebar-nav a svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 20px 18px 24px;
            border-top: 1px solid var(--border);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0c3a97, #2e5bcb);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            flex-shrink: 0;
        }

        .sidebar-user-info strong { display: block; font-size: 18px; }
        .sidebar-user-info span {
            display: block;
            max-width: 160px;
            font-size: 14px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 24px 36px 32px;
            max-width: 100%;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-header h2 { margin: 0; font-size: 24px; color: #0f172a; }
        .page-header p { margin: 4px 0 0; color: var(--text-muted); font-size: 14px; }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-outline {
            padding: 8px 14px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 8px;
            font-size: 13px;
            color: var(--text);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            padding: 8px 18px;
            background: var(--primary);
            color: #fff;
            border: 0;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .stat-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--text-muted);
        }

        .stat-label svg {
            width: 20px;
            height: 20px;
            color: var(--text-muted);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
            margin-top: 4px;
        }

        .stat-change {
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stat-change.up { color: var(--success); }
        .stat-change.down { color: var(--danger); }
        .stat-change.neutral { color: var(--text-muted); }
        .stat-sub { color: var(--text-muted); font-size: 12px; font-weight: 400; }

        .content-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
        }

        .legend {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .chart-wrap {
            height: 260px;
            position: relative;
        }

        .rank-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .rank-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .rank-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
        }

        .rank-value {
            color: var(--text-muted);
            font-size: 13px;
        }

        .rank-bar {
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .rank-fill {
            height: 100%;
            background: #bfdbfe;
            border-radius: 4px;
            transition: width .5s ease;
        }

        .text-link {
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 10px 12px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
        }

        tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        tbody tr:last-child td { border-bottom: 0; }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-completed { background: #dcfce7; color: #15803d; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stock-ok { background: var(--success); }
        .stock-low { background: var(--warn); }
        .stock-out { background: var(--danger); }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-thumb {
            width: 28px; height: 28px;
            border-radius: 6px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .pagination {
            display: flex;
            gap: 4px;
            align-items: center;
            justify-content: center;
            padding: 14px 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        .pagination a, .pagination span {
            min-width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid var(--border);
            padding: 0 6px;
            font-size: 13px;
            color: var(--text);
        }

        .pagination .active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        @media (max-width: 1100px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .content-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <h1>GenShop<br>Admin</h1>
        <span>System Manager</span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/><path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/></svg>
            Categories
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            Products
        </a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            Orders
        </a>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            Customers
        </a>
        <a href="{{ route('admin.logout.page') }}" class="{{ request()->routeIs('admin.logout.page') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            Logout
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            @php $u = auth()->user(); @endphp
            <div class="sidebar-avatar">
                {{ strtoupper(substr($u->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <strong>{{ $u->name }}</strong>
                <span>{{ $u->email }}</span>
            </div>
        </div>
    </div>
</div>

<div class="main">
    @yield('content')
</div>

</body>
</html>
