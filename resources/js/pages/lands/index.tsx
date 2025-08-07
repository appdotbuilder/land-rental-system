import { AppShell } from '@/components/app-shell';
import { Head, Link } from '@inertiajs/react';

interface Land {
    id: number;
    name: string;
    location: string;
    area: number;
    area_unit: string;
    status: 'available' | 'rented';
    description: string | null;
    created_at: string;
}

interface LandsIndexProps {
    lands: {
        data: Land[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        meta: {
            current_page: number;
            last_page: number;
            per_page: number;
            total: number;
        };
    };
    [key: string]: unknown;
}

export default function LandsIndex({ lands }: LandsIndexProps) {
    const getStatusColor = (status: string) => {
        return status === 'available' 
            ? 'text-green-700 bg-green-100 dark:text-green-100 dark:bg-green-900/50'
            : 'text-blue-700 bg-blue-100 dark:text-blue-100 dark:bg-blue-900/50';
    };

    const getStatusIcon = (status: string) => {
        return status === 'available' ? '✅' : '🏠';
    };

    return (
        <AppShell>
            <Head title="Land Management" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            🏗️ Land Management
                        </h1>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Manage all your land properties and their rental status.
                        </p>
                    </div>
                    <Link
                        href={route('lands.create')}
                        className="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                    >
                        ➕ Add New Land
                    </Link>
                </div>

                {/* Lands Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {lands.data.map((land) => (
                        <div key={land.id} className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                            <div className="p-6">
                                <div className="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">
                                            {land.name}
                                        </h3>
                                        <p className="text-gray-600 dark:text-gray-400">
                                            📍 {land.location}
                                        </p>
                                    </div>
                                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(land.status)}`}>
                                        {getStatusIcon(land.status)} {land.status}
                                    </span>
                                </div>

                                <div className="space-y-2 mb-4">
                                    <div className="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <span className="mr-2">📏</span>
                                        <span>{land.area} {land.area_unit}</span>
                                    </div>
                                    {land.description && (
                                        <div className="flex items-start text-sm text-gray-600 dark:text-gray-400">
                                            <span className="mr-2 mt-0.5">📝</span>
                                            <span className="line-clamp-2">{land.description}</span>
                                        </div>
                                    )}
                                </div>

                                <div className="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <span className="text-xs text-gray-500 dark:text-gray-500">
                                        Added {new Date(land.created_at).toLocaleDateString()}
                                    </span>
                                    <div className="flex items-center space-x-2">
                                        <Link
                                            href={route('lands.show', land.id)}
                                            className="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium"
                                        >
                                            View
                                        </Link>
                                        <Link
                                            href={route('lands.edit', land.id)}
                                            className="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300 text-sm font-medium"
                                        >
                                            Edit
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Empty State */}
                {lands.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">🏗️</div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            No lands registered yet
                        </h3>
                        <p className="text-gray-600 dark:text-gray-400 mb-6">
                            Get started by adding your first land property to the system.
                        </p>
                        <Link
                            href={route('lands.create')}
                            className="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                        >
                            ➕ Add Your First Land
                        </Link>
                    </div>
                )}
            </div>
        </AppShell>
    );
}