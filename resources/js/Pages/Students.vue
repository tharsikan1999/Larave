<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps, defineExpose } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { faEdit } from "@fortawesome/free-solid-svg-icons";

const userImg = "/DefaultImages/man.png";

const props = defineProps({
    students: {
        type: Array,
        required: true,
    },
    currentPage: {
        type: Number,
        required: true,
    },
    lastPage: {
        type: Number,
        required: true,
    },
});

const deleteForm = useForm({
    id: null,
});

const handleEdit = (route) => {
    Inertia.visit(route);
};

const handleDelete = (id) => {
    if (confirm("Are you sure you want to delete this student?")) {
        deleteForm.delete(route("students.delete", id));
    }
};

const paginate = (page) => {
    Inertia.visit(route("students.index", { page }));
};

const formatDate = (timestamp) => {
    const date = new Date(timestamp);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
};

const getStatusColor = (status) => {
    return {
        "flex items-center ": true,
        "h-3 w-3 rounded-full": true,
        "mx-2": true,
        "bg-green-500": status === "active",
        "bg-red-500": status === "inactive",
    };
};

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
                                :src="student.image ? student.image : userImg"
                                alt="User image"
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
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer"
                            >
                                <font-awesome-icon :icon="faEdit" />
                            </a>
                            <a
                                @click="handleDelete(student.id)"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer"
                            >
                                <font-awesome-icon :icon="faTrash" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-4">
            <nav
                class="inline-flex rounded-md shadow-sm -space-x-px"
                aria-label="Pagination"
            >
                <template v-if="props.currentPage > 1">
                    <a
                        href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        @click.prevent="paginate(props.currentPage - 1)"
                    >
                        {{ props.currentPage - 1 }}
                    </a>
                </template>
                <a
                    href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                    aria-current="page"
                >
                    {{ props.currentPage }}
                </a>
                <template v-if="props.currentPage < props.lastPage">
                    <a
                        href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        @click.prevent="paginate(props.currentPage + 1)"
                    >
                        {{ props.currentPage + 1 }}
                    </a>
                </template>
            </nav>
        </div>
    </AuthenticatedLayout>
</template>
