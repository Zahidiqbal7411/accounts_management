@extends('layouts.app')

@section('title', 'Services Expiry')

@section('content')
<div class="expiry-container">
    <!-- Header -->
    <div class="expiry-header">
        <h2 class="expiry-title">
            <i class="fas fa-calendar-times"></i> Services Expiry Overview
        </h2>
        <div class="expiry-summary">
            <span class="summary-badge summary-warning">
                <i class="fas fa-clock"></i> Next 2 Months: {{ $upcomingByMonth->flatten()->count() }}
            </span>
            <span class="summary-badge summary-danger">
                <i class="fas fa-exclamation-triangle"></i> Expired: {{ $expiredByMonth->flatten()->count() }}
            </span>
        </div>
    </div>

    <!-- Upcoming Services (Next 2 Months) - Shown First -->
    <div class="expiry-section">
        <div class="section-header section-warning">
            <h3><i class="fas fa-clock"></i> Expiring in Next 2 Months ({{ $today->format('d M Y') }} - {{ $twoMonthsLater->format('d M Y') }})</h3>
            <span class="section-count">{{ $upcomingByMonth->flatten()->count() }} services</span>
        </div>
        
        @forelse($upcomingByMonth as $month => $services)
            <div class="month-group">
                <div class="month-header month-upcoming">
                    <h4><i class="fas fa-calendar"></i> {{ $month }}</h4>
                    <span class="month-count month-count-warning">{{ $services->count() }} expiring</span>
                </div>
                <div class="table-container">
                    <table class="expiry-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Title</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Days Left</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $index => $service)
                                @php
                                    $dueDate = \Carbon\Carbon::parse($service->service_due_date);
                                    $today = \Carbon\Carbon::now()->startOfDay();
                                    $daysRemaining = $today->diffInDays($dueDate, false);
                                    
                                    if ($daysRemaining > 0) {
                                        $daysText = $daysRemaining . ' days left';
                                        $daysClass = 'days-warning';
                                    } elseif ($daysRemaining == 0) {
                                        $daysText = 'Expires today';
                                        $daysClass = 'days-today';
                                    } else {
                                        $daysText = abs($daysRemaining) . ' days ago';
                                        $daysClass = 'days-danger';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="service-title-cell">{{ $service->service_title }}</td>
                                    <td>{{ $service->service_start_date ? $service->service_start_date->format('d M Y') : 'N/A' }}</td>
                                    <td>{{ $dueDate->format('d M Y') }}</td>
                                    <td><span class="days-badge {{ $daysClass }}">{{ $daysText }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="empty-section">
                <i class="fas fa-check-circle"></i>
                <p>No services expiring in the next 2 months</p>
            </div>
        @endforelse
    </div>

    <!-- Section Divider -->
    <div class="section-divider">
        <div class="divider-line"></div>
        <div class="divider-icon">
            <i class="fas fa-history"></i>
        </div>
        <div class="divider-line"></div>
    </div>

    <!-- Expired Services (Previous Months) - Shown After -->
    <div class="expiry-section expired-section">
        <div class="section-header section-danger">
            <h3><i class="fas fa-exclamation-triangle"></i> Expired Services</h3>
            <span class="section-count">{{ $expiredByMonth->flatten()->count() }} services</span>
        </div>
        
        @forelse($expiredByMonth as $month => $services)
            <div class="month-group">
                <div class="month-header month-expired">
                    <h4><i class="fas fa-calendar"></i> {{ $month }}</h4>
                    <span class="month-count">{{ $services->count() }} expired</span>
                </div>
                <div class="table-container">
                    <table class="expiry-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Title</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Days Expired</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $index => $service)
                                @php
                                    $dueDate = \Carbon\Carbon::parse($service->service_due_date);
                                    $today = \Carbon\Carbon::now()->startOfDay();
                                    $daysRemaining = $today->diffInDays($dueDate, false);
                                    
                                    if ($daysRemaining == 0) {
                                        $daysText = 'Expired today';
                                    } else {
                                        $daysText = abs($daysRemaining) . ' days ago';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="service-title-cell">{{ $service->service_title }}</td>
                                    <td>{{ $service->service_start_date ? $service->service_start_date->format('d M Y') : 'N/A' }}</td>
                                    <td>{{ $dueDate->format('d M Y') }}</td>
                                    <td><span class="days-badge days-danger">{{ $daysText }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="empty-section">
                <i class="fas fa-check-circle"></i>
                <p>No expired services</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
/* Expiry Container */
.expiry-container {
    max-width: 100%;
}

/* Header */
.expiry-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 16px;
}

.expiry-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 12px;
}

.expiry-title i {
    color: #4f46e5;
}

.expiry-summary {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.summary-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.summary-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.summary-warning {
    background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
    color: #1e293b;
    border: none;
    box-shadow: 0 2px 8px rgba(252, 211, 77, 0.4);
}

.summary-info {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: #1e293b;
    border: 1px solid #cbd5e1;
}

.summary-danger {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Section Styles */
.expiry-section {
    background: var(--bg-white);
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    margin-bottom: 28px;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.04);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

.section-header h3 {
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

.section-warning {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    border-bottom: 2px solid #475569;
}

.section-warning h3 {
    color: #ffffff;
}

.section-info {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    border-bottom: 2px solid #475569;
}

.section-info h3 {
    color: #ffffff;
}

.section-danger {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    border-bottom: 2px solid #475569;
}

.section-danger h3 {
    color: #ffffff;
}

.section-count {
    font-size: 14px;
    font-weight: 600;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    border-radius: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.section-danger .section-count {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
}

/* Month Group */
.month-group {
    border-top: 1px solid rgba(0, 0, 0, 0.04);
}

.month-group:first-of-type {
    border-top: none;
}

.month-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 28px;
    background: linear-gradient(135deg, #475569 0%, #64748b 100%);
}

.month-header h4 {
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.month-header h4 i {
    color: #fde68a;
}

.month-count {
    font-size: 13px;
    color: #ffffff;
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    border: none;
    box-shadow: 0 2px 6px rgba(220, 38, 38, 0.3);
}

.month-count-warning {
    color: #1e293b;
    background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
    border: none;
    box-shadow: 0 2px 6px rgba(252, 211, 77, 0.4);
}

/* Section Divider */
.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 35px 0;
    gap: 20px;
}

.divider-line {
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%);
    border-radius: 2px;
}

.divider-icon {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: 3px solid #ffffff;
}

.divider-icon i {
    font-size: 20px;
    color: #64748b;
}

/* Cards Grid */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
    padding: 24px;
}

/* Table Styles */
.table-container {
    padding: 24px;
    overflow-x: auto;
}

.expiry-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
    background: #ffffff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    border: 1px solid #e2e8f0;
}

.expiry-table thead {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e2e8f0;
}

/* Expired Section Table Header */
.expired-section .expiry-table thead {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e2e8f0;
}

.expiry-table th {
    padding: 16px 22px;
    text-align: left;
    font-weight: 600;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: none;
    position: relative;
}

.expiry-table th:first-child {
    width: 70px;
    text-align: center;
    border-radius: 14px 0 0 0;
}

.expiry-table th:last-child {
    text-align: center;
    border-radius: 0 14px 0 0;
}

.expiry-table tbody tr {
    transition: all 0.25s ease;
    border-bottom: 1px solid #f1f5f9;
}

.expiry-table tbody tr:last-child {
    border-bottom: none;
}

.expiry-table tbody tr:last-child td:first-child {
    border-radius: 0 0 0 14px;
}

.expiry-table tbody tr:last-child td:last-child {
    border-radius: 0 0 14px 0;
}

.expiry-table tbody tr:hover {
    background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%);
    transform: scale(1.005);
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.08);
}

.expiry-table tbody tr:nth-child(even) {
    background-color: #fafbfc;
}

.expiry-table tbody tr:nth-child(even):hover {
    background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%);
}

.expiry-table td {
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
    color: #475569;
    vertical-align: middle;
}

.expiry-table tbody tr:last-child td {
    border-bottom: none;
}

.expiry-table td:first-child {
    text-align: center;
    font-weight: 700;
    color: #4f46e5;
    font-size: 15px;
}

.expiry-table td:last-child {
    text-align: center;
}

.service-title-cell {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.service-title-cell:hover {
    color: #4f46e5;
}

/* Days Badge Styles */
.days-badge {
    padding: 10px 18px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.days-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.days-badge.days-warning {
    background: linear-gradient(135deg, #fcd34d 0%, #fde68a 100%);
    color: #1e293b;
    border: none;
    box-shadow: 0 3px 10px rgba(252, 211, 77, 0.5);
}

.days-badge.days-today {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: #ffffff;
    font-weight: 700;
    border: none;
    box-shadow: 0 3px 10px rgba(30, 41, 59, 0.4);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { 
        opacity: 1;
        box-shadow: 0 3px 10px rgba(30, 41, 59, 0.4);
    }
    50% { 
        opacity: 0.9;
        box-shadow: 0 3px 15px rgba(30, 41, 59, 0.6);
    }
}

.days-badge.days-danger {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: #ffffff;
    border: none;
    box-shadow: 0 3px 10px rgba(220, 38, 38, 0.35);
}

.days-badge.warning {
    background: linear-gradient(135deg, #fcd34d 0%, #fde68a 100%);
    color: #1e293b;
    border: none;
    box-shadow: 0 3px 10px rgba(252, 211, 77, 0.5);
}

.days-badge.info {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: #ffffff;
    border: none;
    box-shadow: 0 3px 10px rgba(30, 41, 59, 0.3);
}

.days-badge.danger {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: #ffffff;
    border: none;
    box-shadow: 0 3px 10px rgba(220, 38, 38, 0.35);
}

/* Month Header Expired */
.month-header.month-expired {
    background: linear-gradient(135deg, #475569 0%, #64748b 100%);
}

.month-header.month-expired h4 i {
    color: #f1f5f9;
}

/* Empty Section */
.empty-section {
    text-align: center;
    padding: 50px 20px;
    color: var(--text-light);
}

.empty-section i {
    font-size: 52px;
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 16px;
}

.empty-section p {
    font-size: 15px;
    margin: 0;
    color: #64748b;
}

/* Responsive */
@media (max-width: 768px) {
    .expiry-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .expiry-summary {
        justify-content: center;
    }
    
    .cards-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }
    
    .expiry-table {
        font-size: 13px;
    }
    
    .expiry-table th,
    .expiry-table td {
        padding: 12px 14px;
    }
    
    .expiry-table th:first-child,
    .expiry-table td:first-child {
        display: none;
    }
}
</style>
@endpush
