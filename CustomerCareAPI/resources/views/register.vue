<template>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Create Account</h1>
                <p class="text-gray-600 mt-2">Register for a new account</p>
            </div>

            <form @submit.prevent="registerUser">
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" v-model="name" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" v-model="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" v-model="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="radio" v-model="role" name="role" value="user" checked class="h-4 w-4 text-blue-600">
                        <span class="ml-2 text-gray-700">Register as User</span>
                    </label>
                    <label class="flex items-center mt-2">
                        <input type="radio" v-model="role" name="role" value="agent" class="h-4 w-4 text-blue-600">
                        <span class="ml-2 text-gray-700">Register as Agent</span>
                    </label>
                </div>

                <button type="submit" :disabled="loading"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Create Account
                </button>

                <div v-if="errorMessage" class="text-red-600 text-sm mt-4">
                    {{ errorMessage }}
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">Already have an account?
                    <router-link to="/" class="text-blue-600 hover:underline">Sign In</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

// State variables
const name = ref('')
const email = ref('')
const password = ref('')
const role = ref('user')
const loading = ref(false)
const errorMessage = ref('')

const router = useRouter()

const API_URL = 'http://127.0.0.1:8000/api/register'

const registerUser = async () => {
    loading.value = true
    errorMessage.value = ''

    try {
        const response = await axios.post(API_URL, {
            name: name.value,
            email: email.value,
            password: password.value,
            role: role.value
        })

        if (response.status === 201) {
            router.push('/')
        }
    } catch (error) {
        errorMessage.value = 'Error registering. Please try again.'
    } finally {
        loading.value = false
    }
}
</script>
