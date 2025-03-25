<template>
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Create a New Ticket</h2>

        <form @submit.prevent="createTicket">
            <div class="mb-4">
                <label for="title" class="block font-medium">Title:</label>
                <input v-model="ticket.title" type="text" id="title" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Description:</label>
                <textarea v-model="ticket.description" id="description" required class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="priority" class="block font-medium">Priority:</label>
                <select v-model="ticket.priority" id="priority" class="w-full p-2 border rounded">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Submit Ticket
            </button>
        </form>

        <p v-if="message" class="mt-4 text-green-600">{{ message }}</p>
        <p v-if="error" class="mt-4 text-red-600">{{ error }}</p>
    </div>
</template>

<script>
import { ref } from "vue";
import router from "../js/router.js";

export default {
    setup() {
        const ticket = ref({
            title: "",
            description: "",
            priority: "low",
            status: "open",
        });

        const message = ref("");
        const error = ref("");

        const createTicket = async () => {
            message.value = "";
            error.value = "";

            try {
                const token = localStorage.getItem("userToken");

                if (!token) {
                    error.value = "Authentication token is missing. Please log in.";
                    return;
                }

                const response = await fetch("http://127.0.0.1:8000/api/tickets", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": `Bearer ${token}`
                    },
                    body: JSON.stringify({
                        title: ticket.value.title,
                        description: ticket.value.description,
                        priority: ticket.value.priority,
                        status: ticket.value.status
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    message.value = "Ticket created successfully!";
                    ticket.value = { title: "", description: "", priority: "low", status: "open" };
                    await router.push('/home');
                } else {
                    error.value = data.message || "Error creating ticket.";
                }
            } catch (err) {
                error.value = "Network error. Please try again.";
            }
        };

        return { ticket, createTicket, message, error };
    }
};
</script>

<style scoped>
</style>
