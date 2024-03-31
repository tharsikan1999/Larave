<script setup>
import { defineProps, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";

// Define props
const props = defineProps({
    student: {
        type: Object,
        required: true,
    },
});

// Define refs for form data
const studentData = ref({
    email: props.student.email,
    firstname: props.student.firstname,
    lastname: props.student.lastname,
    age: props.student.age,
    status: props.student.status,
    image: props.student.image,
});

const handleImageChange = (event) => {
    const file = event.target.files[0];

    if (file) {
        // Update studentData with the selected file
        studentData.value.image = file;
    }
};

const formDataName = "updateStudentForm";

// Method to submit the form
const submitForm = async () => {
    try {
        // Check if image has changed
        if (studentData.value.image) {
            // If the image has changed, submit the form as POST
            await Inertia.post(
                route("students.update", props.student.id),
                studentData.value,
                { headers: { "X-HTTP-Method-Override": "PUT" } }
            );
        } else {
            // If the image has not changed, submit the form as PUT
            await Inertia.put(
                route("students.update", props.student.id),
                studentData.value
            );
        }
    } catch (error) {
        console.error("Error updating student:", error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <form class="max-w-md mx-auto m-20" @submit.prevent="submitForm">
                <!-- Email input -->
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="email"
                        v-model="studentData.email"
                        name="email"
                        id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "
                        required
                    />
                    <label
                        for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Email address</label
                    >
                </div>

                <!-- First name input -->
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="studentData.firstname"
                        name="firstname"
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
                </div>

                <!-- Last name input -->
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="studentData.lastname"
                        name="lastname"
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
                </div>

                <!-- Age input -->
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="number"
                        v-model="studentData.age"
                        name="age"
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
                </div>

                <!-- Status input -->
                <div class="relative z-0 w-full mb-5 group">
                    <select
                        v-model="studentData.status"
                        name="status"
                        id="status"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
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
                </div>
                <!-- Profile picture input -->
                <div class="relative z-0 w-full mb-5 group">
                    <label
                        for="user_avatar"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Upload file</label
                    >
                    <input
                        type="file"
                        name="image"
                        id="user_avatar"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help"
                        @change="handleImageChange"
                    />

                    <div
                        class="mt-1 text-sm text-gray-500"
                        id="user_avatar_help"
                    >
                        A profile picture is useful to confirm you are logged
                        into your account
                    </div>
                </div>
                <!-- Submit button -->
                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Update student
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
