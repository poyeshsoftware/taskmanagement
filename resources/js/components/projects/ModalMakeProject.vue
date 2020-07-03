<template>
    <div class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">

        <div @click.prevent="closeModal" class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
             role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
                <div class="w-full sm:flex sm:items-start ">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left ">
                        <h3 v-if="id === -1" class="text-lg leading-6 font-medium text-gray-900">
                            Make a new project
                        </h3>
                        <h3 v-else class="text-lg leading-6 font-medium text-gray-900">
                            Edit Project
                        </h3>
                        <input class="mt-4 px-2 py-2 border border-2 border-gray-300 rounded-lg w-full" type="text"
                               placeholder="Project Name" v-model="name"/>

                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                      <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <a
                    @click.prevent="makeOrUpdateProject"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >
                    <span v-if="id === -1">Create</span>
                    <span v-else>Edit</span>
                </a>
                      </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <a
                    @click.prevent="closeModal"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >
                    Cancel
                </a>
                                    </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalMakeProject",
        props: {
            id: {
                required: true,
                type: Number,
                default: -1
            },
            projectName: {
                required: false,
                type: String,
                default: ""
            }
        }, data() {
            return {
                name: this.projectName
            }
        },
        methods: {
            closeModal() {
                this.$emit('cancelModal')
            },
            async makeOrUpdateProject() {
                if (this.name.length > 0) {
                    if (this.id === -1) {

                        let response = await axios.post('/api/projects', {
                            name: this.name
                        });

                        this.$emit('addProject', response.data);
                    }else{

                        let response = await axios.patch(`/api/projects/${this.id}`, {
                            name: this.name
                        });

                        this.$emit('addProject', response.data);
                    }


                }
            }
        },
    }
</script>
