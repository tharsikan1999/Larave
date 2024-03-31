<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps, defineExpose } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { faEdit } from "@fortawesome/free-solid-svg-icons";

const userImg = "/imgs/user.jpg";

const props = defineProps({
    students: {
        type: Array,
        required: true,
    },
});

// Function to format the date
const formatDate = (timestamp) => {
    const date = new Date(timestamp);
    // Get the date components
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    // Return the formatted date string (YYYY-MM-DD)
    return `${year}-${month}-${day}`;
};

// Function to determine background color based on status
const getStatusColor = (status) => {
    return {
        "flex items-center ": true,
        "h-3 w-3 rounded-full": true,
        "mx-2": true,
        "bg-green-500": status === "active",
        "bg-red-500": status === "inactive",
    };
};

const deleteForm = useForm({
    id: null,
});

// Function to handle the add button click
const handleEdit = (route) => {
    // Navigate to edit route
    Inertia.visit(route);
};

// Function to handle the delete button click

const handleDelete = (id) => {
    if (confirm("Are you sure you want to delete this student?")) {
        deleteForm.delete(route("students.delete", id));
    }
};

// Function to handle the add button click

defineExpose({
    formatDate,
    getStatusColor,
    handleEdit,
});
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <a :href="route('students.create')">
                <button
                    type="button"
                    class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-10 py-3 text-center me-2 mb-2"
                >
                    Add Students
                </button>
            </a>
        </template>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">NAME</th>
                        <th scope="col" class="px-6 py-3">AGE</th>
                        <th scope="col" class="px-6 py-3">Create At</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="student in props.students"
                        :key="student.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >
                        <td class="px-6 py-4">{{ student.id }}</td>

                        <th
                            scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <img
                                class="w-10 h-10 rounded-full"
                                :src="userImg"
                                alt="Jese image"
                            />
                            <div class="ps-3">
                                <div class="text-base font-semibold">
                                    {{ student.firstname }}
                                    {{ student.lastname }}
                                </div>
                                <div class="font-normal text-gray-500">
                                    {{ student.email }}
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ student.age }}
                        </td>
                        <td class="px-6 py-4">
                            {{ formatDate(student.created_at) }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    :class="getStatusColor(student.status)"
                                ></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 flex items-center justify-evenly">
                            <a
                                @click="
                                    handleEdit(
                                        route('students.edit', student.id)
                                    )
                                "
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            >
                                <font-awesome-icon :icon="faEdit" />
                            </a>
                            <a
                                @click="handleDelete(student.id)"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                            >
                                <font-awesome-icon :icon="faTrash" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
