<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { defineProps, defineExpose, ref } from "vue";

const formData = ref({
    email: "",
    firstName: "",
    lastName: "",
    age: "",
    status: "",
});

const errors = ref({
    email: "",
    firstName: "",
    lastName: "",
    age: "",
    status: "",
});

const handleSubmit = () => {
    // Reset errors
    Object.keys(errors.value).forEach((key) => {
        errors.value[key] = "";
    });

    // Validate email
    if (!formData.value.email.trim()) {
        errors.value.email = "Email is required";
    } else if (!isValidEmail(formData.value.email)) {
        errors.value.email = "Please enter a valid email";
    }

    // Validate first name
    if (!formData.value.firstName.trim()) {
        errors.value.firstName = "First name is required";
    }

    // Validate last name
    if (!formData.value.lastName.trim()) {
        errors.value.lastName = "Last name is required";
    }

    // Validate age
    if (!formData.value.age.toString().trim()) {
        errors.value.age = "Age is required";
    } else if (isNaN(formData.value.age)) {
        errors.value.age = "Please enter a valid age";
    }

    // Validate status
    if (!formData.value.status) {
        errors.value.status = "Status is required";
    }

    // If there are no errors, submit the form
    if (Object.values(errors.value).every((error) => !error)) {
        // Submit logic here
        console.log("Form submitted with:", formData.value);
    }
};

const isValidEmail = (email) => {
    // Regular expression for email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <form class="max-w-md mx-auto m-20" @submit.prevent="handleSubmit">
            <div class="relative z-0 w-full mb-5 group">
                <input
                    type="email"
                    v-model="formData.email"
                    name="floating_email"
                    id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                    required
                    value=""
                />
                <label
                    for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Email address</label
                >
                <p class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="formData.firstName"
                        name="floating_first_name"
                        id="floating_first_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "
                        required
                    />
                    <label
                        for="floating_first_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >First name</label
                    >
                    <p class="text-red-500 text-xs mt-1">
                        {{ errors.firstName }}
                    </p>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="formData.lastName"
                        name="floating_last_name"
                        id="floating_last_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "
                        required
                    />
                    <label
                        for="floating_last_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Last name</label
                    >
                    <p class="text-red-500 text-xs mt-1">
                        {{ errors.lastName }}
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="number"
                        v-model="formData.age"
                        name="floating_age"
                        id="floating_age"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "
                        required
                    />
                    <label
                        for="floating_age"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Age</label
                    >
                    <p class="text-red-500 text-xs mt-1">{{ errors.age }}</p>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <select
                        v-model="formData.status"
                        name="status"
                        id="status"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        required
                    >
                        <option value="">Select status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <label
                        for="status"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Status</label
                    >
                    <p class="text-red-500 text-xs mt-1">{{ errors.status }}</p>
                </div>
            </div>

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Submit
            </button>
        </form>
    </AuthenticatedLayout>
</template>
