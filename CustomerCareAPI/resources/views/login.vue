<template>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Ticket System</h1>
                <p class="text-gray-600 mt-2">Sign in to your account</p>
            </div>

            <form @submit.prevent="loginUser">
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" v-model="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" v-model="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                </div>

                <button type="submit"
                        :disabled="loading"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Sign In
                </button>

                <div v-if="errorMessage" class="text-red-600 text-sm mt-4">
                    {{ errorMessage }}
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">Don't have an account?
                    <router-link to="/register" class="text-blue-600 hover:underline">Sign Up</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const loading = ref(false)
const errorMessage = ref('')

const router = useRouter()

const API_URL = 'http://127.0.0.1:8000/api/login'


const loginUser = async () => {
    loading.value = true
    errorMessage.value = ''

    try {
        const response = await axios.post(API_URL, {
            email: email.value,
            password: password.value
        })
        if (response.status === 200) {
            localStorage.setItem('userToken', response.data.token)
            router.push('/home')
        }
    } catch (error) {
        errorMessage.value = 'Invalid email or password. Please try again.'
    } finally {
        loading.value = false
    }
}

</script>
