<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpenseRecord;
use App\Models\IncomeRecord;
use App\Models\Land;
use App\Models\RentalContract;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }
        
        return $this->tenantDashboard($user);
    }

    /**
     * Display admin dashboard with statistics and insights.
     */
    protected function adminDashboard()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        
        // Key statistics
        $stats = [
            'total_lands' => Land::count(),
            'available_lands' => Land::available()->count(),
            'rented_lands' => Land::rented()->count(),
            'total_tenants' => Tenant::active()->count(),
            'active_contracts' => RentalContract::active()->count(),
            'expiring_soon' => RentalContract::expiringSoon(30)->count(),
        ];

        // Financial data
        $monthlyIncome = IncomeRecord::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->sum('amount');
            
        $monthlyExpenses = ExpenseRecord::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->sum('amount');
            
        $yearlyIncome = IncomeRecord::whereYear('date', $currentYear)
            ->sum('amount');
            
        $yearlyExpenses = ExpenseRecord::whereYear('date', $currentYear)
            ->sum('amount');

        // Charts data - last 12 months
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'income' => IncomeRecord::whereYear('date', $date->year)
                    ->whereMonth('date', $date->month)
                    ->sum('amount'),
                'expenses' => ExpenseRecord::whereYear('date', $date->year)
                    ->whereMonth('date', $date->month)
                    ->sum('amount'),
            ];
        }

        // Upcoming due dates
        $upcomingDueDates = RentalContract::with(['tenant', 'land'])
            ->active()
            ->expiringSoon(60)
            ->orderBy('end_date')
            ->take(5)
            ->get();

        // Recent income/expense records
        $recentIncomes = IncomeRecord::with('rentalContract.tenant')
            ->latest()
            ->take(5)
            ->get();
            
        $recentExpenses = ExpenseRecord::with('land')
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'financial' => [
                'monthly_income' => $monthlyIncome,
                'monthly_expenses' => $monthlyExpenses,
                'yearly_income' => $yearlyIncome,
                'yearly_expenses' => $yearlyExpenses,
                'monthly_profit' => $monthlyIncome - $monthlyExpenses,
                'yearly_profit' => $yearlyIncome - $yearlyExpenses,
            ],
            'charts' => [
                'monthly_data' => $monthlyData,
            ],
            'upcoming_due_dates' => $upcomingDueDates,
            'recent_incomes' => $recentIncomes,
            'recent_expenses' => $recentExpenses,
        ]);
    }

    /**
     * Display tenant dashboard with rental history.
     */
    protected function tenantDashboard($user)
    {
        // For now, just show basic tenant dashboard
        // In a complete implementation, you'd link tenants to users
        return Inertia::render('dashboard-tenant', [
            'user' => $user,
        ]);
    }
}