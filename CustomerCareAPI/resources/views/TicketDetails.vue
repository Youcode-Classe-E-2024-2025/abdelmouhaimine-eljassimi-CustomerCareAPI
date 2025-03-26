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

        <div v-if="userRole === 'agent'" id="agentActions" class="bg-white rounded-lg shadow-md overflow-hidden mb-6" style="display: block;">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Agent Actions
                </h2>
                <form @submit.prevent="updateTicketStatus">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                            <select v-model="status" id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="open" selected>Open</option>
                                <option value="in_progress">In Progress</option>
                                <option value="resolved">Resolved</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Conversation
                </h2>
                <div class="space-y-6">
                    <div v-for="message in messages" :key="message.id" class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full"
                                 :src="message.is_agent ? 'https://ui-avatars.com/api/?name=Support+Team&background=4F46E5&color=fff'
                                               : 'https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff'"
                                 alt="User">
                        </div>
                        <div :class="message.is_agent ? 'flex-1 bg-blue-50 rounded-lg p-4' : 'flex-1 bg-gray-50 rounded-lg p-4'">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ message.is_agent ? 'Support Team' : 'User' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ formatDate(message.created_at) }}
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-700">
                                <p>{{ message.message }}</p>
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
                <form @submit.prevent="sendReply">
                    <div class="mb-4">
                        <textarea v-model="messageContent" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Type your reply here..."></textarea>
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
            userRole: null,
            userId: null,
            messages: null,
            messageContent: '',
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
                this.ticket = response.data.ticket;
                this.messages = response.data.messages;
            } catch (err) {
                console.error('Error fetching ticket details:', err);
                this.error = 'Failed to load ticket details. Please try again later.';
            }
        },
        async fetchUserRole() {
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
                    console.log(this.userId);
                }
            } catch (error) {
                console.error('Error fetching user role:', error);
                return null;
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleString();
        },
        getStatusBadgeClass(status) {
            switch (status) {
                case 'open':
                    return 'bg-green-500 text-white';
                case 'in_progress':
                    return 'bg-blue-500 text-white';
                case 'resolved':
                    return 'bg-yellow-500 text-white';
                case 'closed':
                    return 'bg-gray-500 text-white';
                default:
                    return '';
            }
        },
        async updateTicketStatus() {
            try {
                const userToken = localStorage.getItem('userToken');
                const response = await axios.put(`http://127.0.0.1:8000/api/tickets/${this.ticket.id}`,
                    { status: this.status, agent_id: this.userId },
                    {
                        headers: {
                            'Authorization': `Bearer ${userToken}`,
                        },
                    }
                );
                if (response.status === 200) {
                    this.ticket.status = this.status;
                }
            } catch (err) {
                console.error('Error updating ticket status:', err);
                alert('Failed to update ticket status. Please try again.');
            }
        },

        async sendReply() {
            if (!this.messageContent) {
                alert('Please enter a message before submitting.');
                return;
            }

            try {
                const userToken = localStorage.getItem('userToken');
                const response = await axios.post(
                    `http://127.0.0.1:8000/api/messages`,
                    {
                        ticket_id: this.ticket.id,
                        sender_id: this.userId,
                        message: this.messageContent,
                        is_agent: this.userRole === 'agent',
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${userToken}`,
                        },
                    }
                );

                this.messages.push(response.data);
                this.messageContent = '';
            } catch (error) {
                console.error('Error sending reply:', error);
                alert('Failed to send reply. Please try again.');
            }
        },
    },
    mounted() {
        this.fetchTicketDetails();
        this.fetchUserRole();
    },
};
</script>


<style scoped>
</style>
