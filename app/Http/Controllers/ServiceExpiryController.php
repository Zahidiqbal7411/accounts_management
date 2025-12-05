<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceExpiryController extends Controller
{
    /**
     * Display the services expiry module.
     */
    public function index()
    {
        $today = Carbon::now()->startOfDay();
        $twoMonthsLater = $today->copy()->addMonths(2);

        // Services expiring in the next 2 months from today (grouped by month)
        $upcomingServices = Service::with(['account', 'product'])
            ->whereDate('service_due_date', '>=', $today)
            ->whereDate('service_due_date', '<=', $twoMonthsLater)
            ->orderBy('service_due_date', 'asc')
            ->get();

        // Group upcoming services by month-year
        $upcomingByMonth = $upcomingServices->groupBy(function ($service) {
            return Carbon::parse($service->service_due_date)->format('F Y');
        });

        // Expired services (all services with due date before today)
        $expiredServices = Service::with(['account', 'product'])
            ->whereDate('service_due_date', '<', $today)
            ->orderBy('service_due_date', 'desc')
            ->get();

        // Group expired services by month-year
        $expiredByMonth = $expiredServices->groupBy(function ($service) {
            return Carbon::parse($service->service_due_date)->format('F Y');
        });

        $serviceStatuses = config('constants.service_status');

        return view('service_expiry.index', compact(
            'upcomingByMonth',
            'expiredByMonth',
            'serviceStatuses',
            'today',
            'twoMonthsLater'
        ));
    }

    /**
     * Get services by specific month via AJAX.
     */
    public function getByMonth(Request $request)
    {
        $month = $request->input('month'); // Format: Y-m
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $services = Service::with(['account', 'product'])
            ->whereDate('service_due_date', '>=', $startDate)
            ->whereDate('service_due_date', '<=', $endDate)
            ->orderBy('service_due_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $services,
            'month' => $startDate->format('F Y')
        ]);
    }
}
