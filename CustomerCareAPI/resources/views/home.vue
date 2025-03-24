<template>
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-blue-600">Ticket System</h1>
                    </div>
                    <nav class="ml-6 flex space-x-8">
                        <a href="home.html" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-item" data-role="user">
                            My Tickets
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-item" data-role="agent">
                            All Tickets
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-item" data-role="all">
                            Settings
                        </a>
                    </nav>
                </div>
                <div class="flex items-center">
                    <a href="login.html" class="ml-4 text-sm text-gray-500 hover:text-gray-700">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- User View -->
        <div id="userView">
            <div class="px-4 py-6 sm:px-0">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">My Tickets</h2>
                    <a href="create-ticket.html" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Create New Ticket
                    </a>
                </div>

                <!-- Ticket Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Ticket Card 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Login issue with my account</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Open
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I'm having trouble logging into my account. When I enter my credentials and click the login button...
                            </p>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>ID: #1234</span>
                                <span>Mar 24, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=1" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                View Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Ticket Card 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Payment not processed</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            In Progress
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I made a payment yesterday but it's still showing as pending in my account. The amount was deducted...
                            </p>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>ID: #1235</span>
                                <span>Mar 22, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=2" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                View Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Ticket Card 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Feature request: Dark mode</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                            Closed
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I would like to request a dark mode feature for the application. It would be easier on the eyes...
                            </p>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>ID: #1236</span>
                                <span>Mar 15, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=3" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                View Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent View -->
        <div id="agentView">
            <div class="px-4 py-6 sm:px-0">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">All Tickets</h2>
                    <div class="flex space-x-2">
                        <select class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>All Statuses</option>
                            <option>Open</option>
                            <option>In Progress</option>
                            <option>Closed</option>
                        </select>
                        <input type="text" placeholder="Search tickets..." class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Ticket Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Ticket Card 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Login issue with my account</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Open
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I'm having trouble logging into my account. When I enter my credentials and click the login button...
                            </p>
                            <div class="flex flex-col gap-1 text-xs text-gray-500 mb-4">
                                <span>ID: #1234</span>
                                <span>User: John Doe</span>
                                <span>Created: Mar 24, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=1&role=agent" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                Open Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Ticket Card 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Payment not processed</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            In Progress
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I made a payment yesterday but it's still showing as pending in my account. The amount was deducted...
                            </p>
                            <div class="flex flex-col gap-1 text-xs text-gray-500 mb-4">
                                <span>ID: #1235</span>
                                <span>User: Jane Smith</span>
                                <span>Created: Mar 22, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=2&role=agent" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                Open Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Ticket Card 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Feature request: Dark mode</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                            Closed
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I would like to request a dark mode feature for the application. It would be easier on the eyes...
                            </p>
                            <div class="flex flex-col gap-1 text-xs text-gray-500 mb-4">
                                <span>ID: #1236</span>
                                <span>User: John Doe</span>
                                <span>Created: Mar 15, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=3&role=agent" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                Open Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Ticket Card 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-blue-600 truncate">Account deletion request</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Open
                        </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                I would like to request my account to be deleted as I no longer need the service. Please process...
                            </p>
                            <div class="flex flex-col gap-1 text-xs text-gray-500 mb-4">
                                <span>ID: #1237</span>
                                <span>User: Sarah Johnson</span>
                                <span>Created: Mar 23, 2025</span>
                            </div>
                        </div>
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                            <a href="ticket-detail.html?id=4&role=agent" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                Open Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
