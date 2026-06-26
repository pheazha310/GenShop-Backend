@extends('layouts.admin')

@section('content')
<style>
    body {
        background: #f6f7fc;
    }

    .page-header {
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .page-header h2 {
        font-size: 34px;
        line-height: 1.05;
        font-weight: 800;
        letter-spacing: -0.03em;
        color: #0c3a97;
    }

    .page-header p {
        margin-top: 8px;
        font-size: 16px;
        color: #5f687e;
    }

    .header-actions {
        gap: 14px;
    }

    .btn-outline,
    .btn-primary {
        min-width: 202px;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 0;
        font-size: 16px;
        box-shadow: none;
    }

    .btn-outline {
        border-color: #d1d7e5;
        color: #16233f;
    }

    .btn-primary {
        background: #0a3aa0;
        font-weight: 700;
    }

    .stat-grid {
        gap: 20px;
        margin-bottom: 26px;
    }

    .stat-card,
    .card {
        border-radius: 0;
        border-color: #d1d7e5;
        box-shadow: 0 1px 0 rgba(15, 23, 42, 0.03);
    }

    .stat-card {
        min-height: 184px;
        padding: 24px 24px 20px;
    }

    .stat-label {
        font-size: 11px;
        letter-spacing: 0.16em;
        color: #5f687e;
    }

    .stat-label svg {
        width: 24px;
        height: 24px;
        color: #0c3a97;
    }

    .stat-value {
        margin-top: 10px;
        font-size: 40px;
        line-height: 1;
        color: #0d1e3b;
    }

    .stat-change {
        flex-wrap: wrap;
        line-height: 1.3;
    }

    .stat-change svg {
        color: currentColor;
    }

    .content-grid {
        gap: 24px;
        margin-bottom: 24px;
        grid-template-columns: minmax(0, 2.05fr) minmax(330px, 1fr);
    }

    .card {
        padding: 28px;
    }

    .card-header h3 {
        font-size: 22px;
        color: #0c3a97;
    }

    .legend-item {
        font-size: 14px;
        color: #5f687e;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
    }

    .chart-wrap {
        height: 360px;
    }

    .rank-list {
        gap: 22px;
    }

    .rank-head {
        font-size: 17px;
        color: #18233f;
    }

    .rank-value {
        color: #18233f;
        font-size: 16px;
    }

    .rank-bar {
        height: 10px;
        background: #d8e4fb;
        border-radius: 0;
    }

    .rank-fill {
        background: #0a3aa0;
        border-radius: 0;
    }

    .table-wrap {
        border-top: 1px solid #d1d7e5;
    }

    table {
        table-layout: fixed;
    }

    thead th {
        background: #eef3ff;
        color: #576176;
        padding: 18px 28px;
        font-size: 12px;
        letter-spacing: 0.08em;
    }

    tbody td {
        padding: 22px 28px;
        font-size: 16px;
        border-bottom: 1px solid #d1d7e5;
    }

    tbody tr:last-child td {
        border-bottom: 0;
    }

    .user-cell {
        gap: 12px;
    }

    .user-thumb {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        background: #c7d6f4;
        color: #132b57;
    }

    .status-badge {
        min-width: 86px;
        text-align: center;
        border-radius: 999px;
        font-size: 11px;
        padding: 6px 12px;
    }

    .status-completed {
        background: #6ae7ba;
        color: #0f5e43;
    }

    .status-processing {
        background: #7ee7bc;
        color: #0f5e43;
    }

    .status-pending {
        background: #b97711;
        color: #fff3d9;
    }

    .status-cancelled {
        background: #f8d8d3;
        color: #be3a2b;
    }

    .pagination {
        justify-content: center;
        gap: 6px;
        padding: 18px 0 0;
    }

    .pagination a,
    .pagination span {
        width: 38px;
        height: 38px;
        border-radius: 0;
        font-size: 16px;
    }

    .pagination .active {
        background: #0a3aa0;
    }

    .text-link {
        font-size: 15px;
        font-weight: 700;
    }

    .card .text-link {
        color: #0c3a97;
    }

    .dashboard-bottom-spacer {
        height: 12px;
    }

    @media (max-width: 1280px) {
        .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 860px) {
        .page-header,
        .header-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .btn-outline,
        .btn-primary {
            width: 100%;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="page-header">
    <div>
        <h2>Overview Dashboard</h2>
        <p>Welcome back. Here's what's happening today.</p>
    </div>
    <div class="header-actions">
        <button class="btn-outline" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Last 30 Days
        </button>
        <button class="btn-primary" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export Report
        </button>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">
            TOTAL SALES
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        </div>
        <div class="stat-value">${{ number_format($totalSales, 2) }}</div>
        <div class="stat-change up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
            +12%
            <span class="stat-sub">Compared to ${{ number_format($totalSales * 0.89, 2) }} last month</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">
            TOTAL ORDERS
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
        </div>
        <div class="stat-value">{{ number_format($totalOrders) }}</div>
        <div class="stat-change up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
            +5%
            <span class="stat-sub">Across all shop categories</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">
            TOTAL PRODUCTS
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
        </div>
        <div class="stat-value">{{ number_format($totalProducts) }}</div>
        <div class="stat-change neutral">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Stable
            <span class="stat-sub">Active in the catalog</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">
            TOTAL CUSTOMERS
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="stat-value">{{ number_format($totalCustomers) }}</div>
        <div class="stat-change up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
            +8%
            <span class="stat-sub">Verified registered users</span>
        </div>
    </div>
</div>

<div class="content-grid">
    <div class="card">
        <div class="card-header">
            <h3>Sales Overview</h3>
            <div class="legend">
                <div class="legend-item">
                    <span class="legend-dot" style="background:#1e40af"></span>
                    This Year
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background:#cbd5e1"></span>
                    Last Year
                </div>
            </div>
        </div>
        <div class="chart-wrap">
            <svg viewBox="0 0 720 240" preserveAspectRatio="none" style="width:100%;height:100%;overflow:visible;">
                @php
                    $months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
                    $thisYear = $thisYearSales;
                    $lastYear = $lastYearSales;

                    $allValues = array_values(array_merge($thisYear, $lastYear));
                    $max = max(array_merge([1], $allValues));
                    $min = min($allValues);
                    $range = max(1, $max - $min);

                    $points = [];
                    $pointsLast = [];
                    $width = 720;
                    $height = 200;
                    $step = $width / 11;

                    for ($i = 0; $i < 12; $i++) {
                        $val = $thisYear[$i + 1] ?? null;
                        if ($val !== null) {
                            $x = $i * $step;
                            $y = $height - (($val - $min) / $range) * ($height - 20);
                            $points[] = [$x, $y];
                        }
                    }

                    for ($i = 0; $i < 12; $i++) {
                        $val = $lastYear[$i + 1] ?? null;
                        if ($val !== null) {
                            $x = $i * $step;
                            $y = $height - (($val - $min) / $range) * ($height - 20);
                            $pointsLast[] = [$x, $y];
                        }
                    }

                    $path = '';
                    foreach ($points as $idx => $p) {
                        $path .= ($idx === 0 ? 'M' : 'L') . round($p[0]) . ',' . round($p[1]);
                    }

                    $pathLast = '';
                    foreach ($pointsLast as $idx => $p) {
                        $pathLast .= ($idx === 0 ? 'M' : 'L') . round($p[0]) . ',' . round($p[1]);
                    }
                @endphp

                <defs>
                    <linearGradient id="areaGrad" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#1e40af" stop-opacity="0.15"/>
                        <stop offset="100%" stop-color="#1e40af" stop-opacity="0"/>
                    </linearGradient>
                </defs>

                <path d="{{ $path }} L{{ end($points)[0] }},{{ $height }} L{{ $points[0][0] }},{{ $height }} Z" fill="url(#areaGrad)" />

                <path d="{{ $path }}" fill="none" stroke="#1e40af" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="{{ $pathLast }}" fill="none" stroke="#cbd5e1" stroke-width="2.5" stroke-dasharray="6 4" stroke-linecap="round" stroke-linejoin="round"/>

                @foreach ($points as $p)
                    <circle cx="{{ round($p[0]) }}" cy="{{ round($p[1]) }}" r="4" fill="#fff" stroke="#1e40af" stroke-width="2.5"/>
                @endforeach

                <g font-family="'Inter', Arial, sans-serif" font-size="11" fill="#64748b" text-anchor="middle">
                    @foreach ($months as $idx => $m)
                        <text x="{{ $idx * $step }}" y="{{ $height + 16 }}">{{ $m }}</text>
                    @endforeach
                </g>
            </svg>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Top Categories</h3>
        </div>
        <ul class="rank-list">
            @foreach ($topCategories as $cat)
                @php
                    $pct = round(($cat->product_count / ($categoryTotal ?: 1)) * 100);
                    $width = $categoryTotal <= 1 ? 0 : ($cat->product_count / $categoryTotal) * 100;
                @endphp
                <li class="rank-item">
                    <div class="rank-head">
                        <span>{{ $cat->name }}</span>
                        <span class="rank-value">{{ $pct }}%</span>
                    </div>
                    <div class="rank-bar">
                        <div class="rank-fill" style="width: {{ $width }}%"></div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div style="margin-top:20px; border-top:1px solid var(--border); padding-top:14px; text-align:center;">
            <a href="{{ route('categories.index') }}" class="text-link">Detailed Analytics</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-link">View All Orders</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th style="width:60px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentOrders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-thumb">
                                    {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span>{{ $order->user->name ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @php
                                $status = strtolower($order->status);
                                $statusClass = match($status) {
                                    'completed' => 'status-completed',
                                    'processing' => 'status-processing',
                                    'pending' => 'status-pending',
                                    'cancelled' => 'status-cancelled',
                                    default => 'status-pending',
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td>
                            <button class="btn-outline" type="button" style="padding:6px 10px; min-width:auto;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 24px; color: var(--text-muted);">No orders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($recentOrders->count() > 0)
    <div class="pagination">
        <span>Page 1 of 3</span>
        <a href="#" style="margin-left:auto; padding:6px 10px;">1</a>
        <a href="#" style="padding:6px 10px;">2</a>
        <a href="#" style="padding:6px 10px;">3</a>
    </div>
    @endif
</div>
@endsection
