import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Land Rental Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col bg-gradient-to-br from-green-50 via-blue-50 to-indigo-50 text-gray-900 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:text-gray-100">
                {/* Header */}
                <header className="w-full px-6 py-4">
                    <nav className="flex items-center justify-between max-w-7xl mx-auto">
                        <div className="flex items-center space-x-2">
                            <div className="text-2xl">🏞️</div>
                            <span className="text-xl font-bold">LandRental</span>
                        </div>
                        <div className="flex items-center space-x-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                                >
                                    📊 Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="inline-flex items-center px-4 py-2 text-gray-700 hover:text-green-600 transition-colors dark:text-gray-300 dark:hover:text-green-400"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                                    >
                                        Get Started
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Main Content */}
                <main className="flex-1 flex items-center justify-center px-6 py-12">
                    <div className="max-w-7xl mx-auto">
                        {/* Hero Section */}
                        <div className="text-center mb-16">
                            <div className="text-6xl mb-6">🏞️</div>
                            <h1 className="text-5xl font-bold mb-6 bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                                Land Rental Management System
                            </h1>
                            <p className="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-8">
                                Streamline your land rental business with comprehensive management tools for properties, tenants, contracts, and financial tracking.
                            </p>
                            {!auth.user && (
                                <div className="flex items-center justify-center space-x-4">
                                    <Link
                                        href={route('register')}
                                        className="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold text-lg"
                                    >
                                        🚀 Start Managing Now
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="inline-flex items-center px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition-colors font-semibold text-lg dark:hover:bg-green-900/20"
                                    >
                                        👤 Sign In
                                    </Link>
                                </div>
                            )}
                        </div>

                        {/* Features Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🗺️</div>
                                <h3 className="text-xl font-semibold mb-3">Land Management</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Complete CRUD operations for land properties including location, area, status tracking, and detailed descriptions.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">👥</div>
                                <h3 className="text-xl font-semibold mb-3">Tenant Management</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Manage tenant information, contact details, and view complete rental history for each tenant.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">📋</div>
                                <h3 className="text-xl font-semibold mb-3">Rental Contracts</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Create and manage yearly rental contracts with automatic due date calculations and status tracking.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🧾</div>
                                <h3 className="text-xl font-semibold mb-3">Invoice Generation</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Generate professional PDF invoices for expired contracts with all necessary details.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">💰</div>
                                <h3 className="text-xl font-semibold mb-3">Financial Tracking</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Track income from rentals and various expenses with manual payment status recording.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">📊</div>
                                <h3 className="text-xl font-semibold mb-3">Reports & Analytics</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Monthly and annual reports with visual graphs, revenue analysis, and PDF export capabilities.
                                </p>
                            </div>
                        </div>

                        {/* User Roles Section */}
                        <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8 mb-16">
                            <h2 className="text-3xl font-bold text-center mb-8">User Roles</h2>
                            <div className="grid md:grid-cols-2 gap-8">
                                <div className="text-center">
                                    <div className="text-4xl mb-4">👨‍💼</div>
                                    <h3 className="text-2xl font-semibold mb-4 text-green-600">Admin</h3>
                                    <ul className="text-left space-y-2 text-gray-600 dark:text-gray-400">
                                        <li>✅ Full system access</li>
                                        <li>✅ Land & tenant management</li>
                                        <li>✅ Contract creation & tracking</li>
                                        <li>✅ Financial record keeping</li>
                                        <li>✅ Reports & analytics</li>
                                        <li>✅ Invoice generation</li>
                                    </ul>
                                </div>
                                <div className="text-center">
                                    <div className="text-4xl mb-4">🏠</div>
                                    <h3 className="text-2xl font-semibold mb-4 text-blue-600">Tenant</h3>
                                    <ul className="text-left space-y-2 text-gray-600 dark:text-gray-400">
                                        <li>✅ View rental history</li>
                                        <li>✅ Access contract details</li>
                                        <li>✅ Payment status tracking</li>
                                        <li>✅ Personal dashboard</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {/* Screenshots/Mockup Section */}
                        <div className="text-center mb-16">
                            <h2 className="text-3xl font-bold mb-8">Dashboard Preview</h2>
                            <div className="grid md:grid-cols-3 gap-6">
                                <div className="bg-gradient-to-br from-green-400 to-green-600 rounded-lg p-6 h-32 flex items-center justify-center">
                                    <div className="text-white text-center">
                                        <div className="text-2xl mb-2">📈</div>
                                        <div className="font-semibold">Income Tracking</div>
                                    </div>
                                </div>
                                <div className="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg p-6 h-32 flex items-center justify-center">
                                    <div className="text-white text-center">
                                        <div className="text-2xl mb-2">🏗️</div>
                                        <div className="font-semibold">Land Overview</div>
                                    </div>
                                </div>
                                <div className="bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg p-6 h-32 flex items-center justify-center">
                                    <div className="text-white text-center">
                                        <div className="text-2xl mb-2">⏰</div>
                                        <div className="font-semibold">Due Date Alerts</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="w-full px-6 py-8 border-t border-gray-200 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto text-center">
                        <p className="text-gray-600 dark:text-gray-400">
                            Built with ❤️ for efficient land rental management •{' '}
                            <a 
                                href="https://app.build" 
                                target="_blank" 
                                className="font-medium text-green-600 hover:text-green-700 transition-colors dark:text-green-400 dark:hover:text-green-300"
                            >
                                Powered by app.build
                            </a>
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}