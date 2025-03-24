<template>

<div class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Create Account</h1>
            <p class="text-gray-600 mt-2">Register for a new account</p>
        </div>

        <form action="login.html" method="GET">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" id="firstName" name="firstName" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="radio" name="role" value="user" checked class="h-4 w-4 text-blue-600">
                    <span class="ml-2 text-gray-700">Register as User</span>
                </label>
                <label class="flex items-center mt-2">
                    <input type="radio" name="role" value="agent" class="h-4 w-4 text-blue-600">
                    <span class="ml-2 text-gray-700">Register as Agent</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                Create Account
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600">Already have an account?
                <router-link to="/" class="text-blue-600 hover:underline">Sing In</router-link>
            </p>
        </div>
    </div>
</div>
</template>
<script setup lang="ts">
</script>
