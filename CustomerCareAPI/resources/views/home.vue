<template>
    <div>
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold text-blue-600">Ticket System</h1>
                        </div>
                        <nav class="ml-6 flex space-x-8">
                            <a href="#" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                        </nav>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="ml-4 text-sm text-gray-500 hover:text-gray-700">Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-20">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-gray-500">Loading tickets...</p>
                </div>
            </div>

            <!-- Error State -->
            <div v-if="error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ error }}</p>
            </div>

            <!-- User View -->
            <div v-if="currentView === 'user' && !loading && !error">
                <div class="px-4 py-6 sm:px-0">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My Tickets</h2>
                        <router-link to="/createTicket" v-if="userRole === 'agent'" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">Create New Ticket</router-link>

                    </div>

                    <!-- No Tickets Message -->
                    <div v-if="ticketsOpened.length === 0" class="text-center py-10 bg-white rounded-lg shadow-md">
                        <p class="text-gray-500">No tickets found. Create a new ticket to get started.</p>
                    </div>

                    <!-- Ticket Cards -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="ticket in ticketsOpened" :key="ticket.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-blue-600 truncate">{{ ticket.title }}</h3>
                                    <span :class="getStatusBadgeClass(ticket.status)" class="px-2 py-1 text-xs font-semibold rounded-full">
                    {{ ticket.status }}
                  </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ ticket.description }}</p>
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>ID: #{{ ticket.id }}</span>
                                    <span>{{ formatDate(ticket.created_at) }}</span>
                                </div>
                            </div>
                            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                                <a href="#" @click.prevent="viewTicket(ticket.id)" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                    View Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            <!-- User View -->
            <div v-if="currentView === 'user' && !loading && !error">
                <div class="px-4 py-6 sm:px-0">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">All Tickets</h2>
                    </div>

                    <!-- No Tickets Message -->
                    <div v-if="ticketsNotOpened.length === 0" class="text-center py-10 bg-white rounded-lg shadow-md">
                        <p class="text-gray-500">No tickets found. Create a new ticket to get started.</p>
                    </div>

                    <!-- Ticket Cards -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="ticket in ticketsNotOpened" :key="ticket.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-blue-600 truncate">{{ ticket.title }}</h3>
                                    <span :class="getStatusBadgeClass(ticket.status)" class="px-2 py-1 text-xs font-semibold rounded-full">
                    {{ ticket.status }}
                  </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ ticket.description }}</p>
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>ID: #{{ ticket.id }}</span>
                                    <span>{{ formatDate(ticket.created_at) }}</span>
                                </div>
                            </div>
                            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                                <a href="#" @click.prevent="viewTicket(ticket.id)" class="w-full block text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                    Open Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            loading: false,
            error: null,
            currentView: 'user',
            tickets: [],
            ticketsOpened: [],
            ticketsNotOpened: [],
            userRole : null,
            userId : null
        };
    },
    methods: {
        async fetchUserRole(){
            try {
                const token = localStorage.getItem('userToken');

                if (!token) {
                    new Error('No token found');
                }
                const response = await axios.get('/api/user', {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    }
                });

                if (response.status === 200) {
                    this.userRole = response.data.role;
                    this.userId = response.data.id;
                }
            } catch (error) {
                console.error('Error fetching user role:', error);
                return null;
            }
        },
        async fetchTickets() {
            try {
                this.loading = true;

                const userToken = localStorage.getItem('userToken');

                const response = await axios.get('http://127.0.0.1:8000/api/tickets', {
                    headers: {
                        'Authorization': `Bearer ${userToken}`
                    }
                });

                this.tickets = response.data;
                this.ticketsOpened = this.tickets.filter(ticket => ticket.agent_id === this.userId);
                this.ticketsNotOpened = this.tickets.filter(ticket => ticket.agent_id === null);
            } catch (err) {
                console.error('Error fetching tickets:', err);
                this.error = 'Failed to load tickets. Please try again later.';
            } finally {
                this.loading = false;
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
        getStatusBadgeClass(status) {
            switch (status) {
                case 'open':
                    return 'bg-green-300 text-white';
                case 'In Progress':
                    return 'bg-blue-500 text-white';
                case 'Resolved':
                    return 'bg-green-500 text-white';
                case 'Closed':
                    return 'bg-gray-500 text-white';
                default:
                    return '';
            }
        },
        switchView(view) {
            this.currentView = view;
        },
        viewTicket(ticketId) {
            this.$router.push({ name: 'TicketDetails', params: { id: ticketId } });
        }
    },
    mounted() {
        this.fetchUserRole();
        this.fetchTickets();
    },
};
</script>
<style scoped>
/* Add additional styling here */
</style>
