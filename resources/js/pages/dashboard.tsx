import { AppShell } from '@/components/app-shell';
import { type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

interface DashboardProps {
    stats?: {
        total_lands: number;
        available_lands: number;
        rented_lands: number;
        total_tenants: number;
        active_contracts: number;
        expiring_soon: number;
    };
    financial?: {
        monthly_income: number;
        monthly_expenses: number;
        yearly_income: number;
        yearly_expenses: number;
        monthly_profit: number;
        yearly_profit: number;
    };
    charts?: {
        monthly_data: Array<{
            month: string;
            income: number;
            expenses: number;
        }>;
    };
    upcoming_due_dates?: Array<{
        id: number;
        end_date: string;
        tenant: { name: string };
        land: { name: string };
        payment_amount: number;
    }>;
    recent_incomes?: Array<{
        id: number;
        description: string;
        amount: number;
        date: string;
        payment_status: string;
    }>;
    recent_expenses?: Array<{
        id: number;
        description: string;
        amount: number;
        date: string;
        category: string;
    }>;
    [key: string]: unknown;
}

export default function Dashboard({ stats, financial, upcoming_due_dates, recent_incomes, recent_expenses }: DashboardProps) {
    const { auth } = usePage<SharedData>().props;

    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount || 0);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString();
    };

    return (
        <AppShell>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🏞️ Land Rental Dashboard
                        </h1>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Welcome back, {auth.user?.name}! Here's your property overview.
                        </p>
                    </div>
                </div>

                {/* Stats Grid */}
                {stats && (
                    <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">🏗️</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Lands</p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">{stats.total_lands}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">✅</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Available</p>
                                    <p className="text-2xl font-bold text-green-600">{stats.available_lands}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">🏠</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Rented</p>
                                    <p className="text-2xl font-bold text-blue-600">{stats.rented_lands}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">👥</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Active Tenants</p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">{stats.total_tenants}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">📋</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Active Contracts</p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">{stats.active_contracts}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">⏰</div>
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Expiring Soon</p>
                                    <p className="text-2xl font-bold text-orange-600">{stats.expiring_soon}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                {/* Financial Overview */}
                {financial && (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div className="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg text-white">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">💰</div>
                                <div>
                                    <p className="text-green-100">Monthly Income</p>
                                    <p className="text-2xl font-bold">{formatCurrency(financial.monthly_income)}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-gradient-to-br from-red-500 to-red-600 p-6 rounded-lg text-white">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">💸</div>
                                <div>
                                    <p className="text-red-100">Monthly Expenses</p>
                                    <p className="text-2xl font-bold">{formatCurrency(financial.monthly_expenses)}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg text-white">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">📈</div>
                                <div>
                                    <p className="text-blue-100">Monthly Profit</p>
                                    <p className="text-2xl font-bold">{formatCurrency(financial.monthly_profit)}</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-lg text-white">
                            <div className="flex items-center">
                                <div className="text-2xl mr-3">🎯</div>
                                <div>
                                    <p className="text-purple-100">Yearly Profit</p>
                                    <p className="text-2xl font-bold">{formatCurrency(financial.yearly_profit)}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Upcoming Due Dates */}
                    {upcoming_due_dates && upcoming_due_dates.length > 0 && (
                        <div className="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    ⏰ Upcoming Due Dates
                                </h3>
                            </div>
                            <div className="p-6">
                                <div className="space-y-4">
                                    {upcoming_due_dates.map((contract) => (
                                        <div key={contract.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {contract.tenant.name} - {contract.land.name}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    Due: {formatDate(contract.end_date)}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-bold text-green-600">
                                                    {formatCurrency(contract.payment_amount)}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    )}

                    {/* Recent Income */}
                    {recent_incomes && recent_incomes.length > 0 && (
                        <div className="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    📈 Recent Income
                                </h3>
                            </div>
                            <div className="p-6">
                                <div className="space-y-4">
                                    {recent_incomes.map((income) => (
                                        <div key={income.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {income.description}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {formatDate(income.date)} • {income.payment_status}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-bold text-green-600">
                                                    {formatCurrency(income.amount)}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    )}
                </div>

                {/* Recent Expenses */}
                {recent_expenses && recent_expenses.length > 0 && (
                    <div className="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                💸 Recent Expenses
                            </h3>
                        </div>
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                {recent_expenses.map((expense) => (
                                    <div key={expense.id} className="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <p className="font-medium text-gray-900 dark:text-white">
                                            {expense.description}
                                        </p>
                                        <p className="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            {formatDate(expense.date)} • {expense.category}
                                        </p>
                                        <p className="font-bold text-red-600 mt-2">
                                            -{formatCurrency(expense.amount)}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                            🚀 Quick Actions
                        </h3>
                    </div>
                    <div className="p-6">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <button className="flex items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                                <div className="text-2xl mr-3">🏗️</div>
                                <div className="text-left">
                                    <p className="font-medium text-green-900 dark:text-green-100">Add New Land</p>
                                    <p className="text-sm text-green-700 dark:text-green-300">Register property</p>
                                </div>
                            </button>
                            
                            <button className="flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                                <div className="text-2xl mr-3">👤</div>
                                <div className="text-left">
                                    <p className="font-medium text-blue-900 dark:text-blue-100">Add New Tenant</p>
                                    <p className="text-sm text-blue-700 dark:text-blue-300">Register tenant</p>
                                </div>
                            </button>
                            
                            <button className="flex items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors">
                                <div className="text-2xl mr-3">📋</div>
                                <div className="text-left">
                                    <p className="font-medium text-purple-900 dark:text-purple-100">New Contract</p>
                                    <p className="text-sm text-purple-700 dark:text-purple-300">Create rental contract</p>
                                </div>
                            </button>
                            
                            <button className="flex items-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors">
                                <div className="text-2xl mr-3">📊</div>
                                <div className="text-left">
                                    <p className="font-medium text-orange-900 dark:text-orange-100">View Reports</p>
                                    <p className="text-sm text-orange-700 dark:text-orange-300">Generate reports</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}