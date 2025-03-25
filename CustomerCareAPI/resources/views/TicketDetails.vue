<template>
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-xl font-bold text-blue-600">Ticket System</h1>
                </div>
                <nav class="ml-6 flex space-x-8">
                    <a href="home.html" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        My Tickets
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Settings
                    </a>
                </nav>
            </div>
            <div class="flex items-center">
                <div class="ml-3 relative">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-700 mr-2">John Doe</span>
                        <button type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="User profile">
                        </button>
                    </div>
                </div>
                <a href="login.html" class="ml-4 text-sm text-gray-500 hover:text-gray-700">Logout</a>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="home.html" class="text-gray-500 hover:text-gray-700">
                            Dashboard
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="#" class="ml-4 text-gray-500 hover:text-gray-700">
                            Tickets
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span id="ticketIdDisplay" class="ml-4 text-gray-700 font-medium">
                                Ticket #1234
                            </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Ticket Header Card -->
        <div v-if="ticket" class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ ticket.title }}</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Created on {{ formatDate(ticket.created_at) }}
                        </p>
                    </div>
                    <span :class="getStatusBadgeClass(ticket.status)" class="px-3 py-1 text-sm font-semibold rounded-full">
          {{ ticket.status }}
        </span>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Priority</h3>
                        <p class="mt-2 text-sm text-gray-900">{{ ticket.priority }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-500">Description</h3>
                    <div class="mt-2 p-4 bg-gray-50 rounded-md text-sm text-gray-900">
                        <p>{{ ticket.description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="agentActions" class="bg-white rounded-lg shadow-md overflow-hidden mb-6" style="display: none;">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Agent Actions
                </h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="open" selected>Open</option>
                            <option value="in-progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div>
                        <label for="assignee" class="block text-sm font-medium text-gray-700 mb-2">Assign To</label>
                        <select id="assignee" name="assignee" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Unassigned</option>
                            <option value="agent1">Agent 1</option>
                            <option value="agent2">Agent 2</option>
                            <option value="agent3">Agent 3</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Ticket
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Conversation
                </h2>
                <div class="space-y-6">
                    <!-- Original message -->
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="User">
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                                <div class="text-xs text-gray-500">Mar 24, 2025 at 10:34 AM</div>
                            </div>
                            <div class="mt-2 text-sm text-gray-700">
                                <p>I'm having trouble logging into my account. When I enter my credentials and click the login button, the page refreshes but I remain on the login page.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Support response -->
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Support+Team&background=4F46E5&color=fff" alt="Support">
                        </div>
                        <div class="flex-1 bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">Support Team</div>
                                <div class="text-xs text-gray-500">Mar 24, 2025 at 11:15 AM</div>
                            </div>
                            <div class="mt-2 text-sm text-gray-700">
                                <p>Hello John, thank you for reaching out. I'm sorry to hear you're having trouble logging in. Could you please tell me which browser and device you're using? Also, do you see any error messages when you try to log in?</p>
                            </div>
                        </div>
                    </div>

                    <!-- User reply -->
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="User">
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                                <div class="text-xs text-gray-500">Mar 24, 2025 at 11:42 AM</div>
                            </div>
                            <div class="mt-2 text-sm text-gray-700">
                                <p>I'm using Chrome on Windows 10. I don't see any error messages, the page just refreshes and I stay on the login page. I've attached a screenshot of what I see after trying to log in.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Form Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Add Reply
                </h2>
                <form>
                    <div class="mb-4">
                        <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Type your reply here..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            ticket: null,
            error: null,
        };
    },
    methods: {
        async fetchTicketDetails() {
            const ticketId = this.$route.params.id;
            const userToken = localStorage.getItem('userToken');
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/tickets/${ticketId}`, {
                    headers: {
                        Authorization: `Bearer ${userToken}`,
                    },
                });
                this.ticket = response.data[0];
            } catch (err) {
                console.error('Error fetching ticket details:', err);
                this.error = 'Failed to load ticket details. Please try again later.';
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleString();
        },
        getStatusBadgeClass(status) {
            switch (status) {
                case 'open':
                    return 'bg-green-500 text-white';
                case 'In Progress':
                    return 'bg-blue-500 text-white';
                case 'Resolved':
                    return 'bg-yellow-500 text-white';
                case 'Closed':
                    return 'bg-gray-500 text-white';
                default:
                    return '';
            }
        },
    },
    mounted() {
        this.fetchTicketDetails();
    },
};
</script>

<style scoped>
</style>
