import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface User {
    id: number;
    name: string;
    email: string;
    role: string;
}

interface DashboardTenantProps {
    user: User;
    [key: string]: unknown;
}

export default function DashboardTenant({ user }: DashboardTenantProps) {
    return (
        <AppShell>
            <Head title="Tenant Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🏠 Tenant Dashboard
                        </h1>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Welcome back, {user.name}! View your rental information here.
                        </p>
                    </div>
                </div>

                {/* Coming Soon Message */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-12 text-center">
                    <div className="text-6xl mb-6">🏠</div>
                    <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Tenant Portal Coming Soon
                    </h2>
                    <p className="text-lg text-gray-600 dark:text-gray-400 mb-6">
                        Your personal rental history and contract information will be available here soon.
                    </p>
                    <div className="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6">
                        <h3 className="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">
                            Coming Features:
                        </h3>
                        <ul className="text-blue-700 dark:text-blue-300 space-y-1">
                            <li>• View your rental history</li>
                            <li>• Access current and past contracts</li>
                            <li>• Track payment status</li>
                            <li>• Download invoices and documents</li>
                        </ul>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}