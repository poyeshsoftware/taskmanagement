<template>
    <div class="container flex flex-col lg:flex-row">
        <div class="w-full lg:w-4/12">
            <h1 class="text-2xl text-gray-700">My Projects</h1>


            <div class="w-full flex flex-col items-center bg-gray-200 rounded-lg mt-6 p-2 pt-4 text-xl">

                <a class="text-xl px-2 py-2 bg-blue-500 rounded-lg text-white mb-4"
                   @click.prevent="showCreateEditProjectModal = !showCreateEditProjectModal"
                   href="#">Add New Project</a>

                <draggable class="w-full" v-model="projects.data"
                           group="people"
                           @start="drag=true" @end="drag=false">
                    <div v-for="(project,index) in projects.data" :key="index">
                        <ul>
                            <li class="mb-4 border border-gray-400 border-2 px-2 py-2 rounded-lg  flex justify-between items-center"
                                :class="{'shadow-lg border-blue-500 ' : isSelected(project.id) }"
                            >
                                <div class="flex w-full items-center">

                                    <a href="#"
                                       class="flex flex-col relative w-8 h-8 justify-center cursor-move">
                                        <span class="bg-blue-500 h-1 w-8 rounded mb-1"/>
                                        <span class="bg-blue-500 h-1 w-8 rounded mb-1"/>
                                        <span class="bg-blue-500 h-1 w-8 rounded"/>

                                    </a>

                                    <a class="px-4 w-full py-2 cursor-pointer text-black"
                                       @click.prevent="openProject(index)">
                                        {{project.name}}
                                    </a>

                                </div>
                                <div class="flex">
                                    <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                       title="delete" @click.prevent="deleteProject(index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             class="fill-current text-white w-6 h-6">
                                            <path
                                                d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </a>

                                    <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                       title="edit" @click.prevent="editProject(index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             class="fill-current text-white w-6 h-6">
                                            <path
                                                d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/>
                                        </svg>

                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </draggable>


            </div>
        </div>
        <div class="w-full lg:w-8/12">
            <div class="ml-0 lg:ml-8 mt-8 lg:mt-0 ">

                <div v-if="projects.data && projects.data.length > 0">
                    <div class="flex justify-between items-center" v-if="selectedProject">
                        <h1 class="text-2xl text-gray-700">{{selectedProject.name}} :</h1>
                        <a class="text-xl px-2 py-2 bg-blue-500 rounded-lg text-white mx-4"
                           @click.prevent="showCreateEditTaskModal = !showCreateEditTaskModal"
                           href="#">Add New Task</a>
                    </div>
                    <div v-else>
                        <h1 class="text-2xl text-gray-700">Please choose one of the projects</h1>
                    </div>

                </div>
                <div v-else>
                    <h1 class="text-2xl text-gray-700">Please create a project</h1>
                </div>


                <div v-if="tasks" class="mt-8 mr-4">
                    <draggable class="" v-model="tasks.data"
                               group="tasks"
                               @start="drag=true" @end="drag=false">
                        <div v-for="(task,index) in tasks.data" :key="index">
                            <ul>
                                <li class="mb-4 border border-gray-400 border-2 px-2 py-2 rounded-lg flex justify-between items-center">
                                    <div class="flex w-full items-center">

                                        <a
                                            class="flex flex-col relative w-8 h-8 justify-center cursor-move z-0">
                                            <span class="bg-blue-500 h-1 w-8 rounded mb-1"/>
                                            <span class="bg-blue-500 h-1 w-8 rounded mb-1"/>
                                            <span class="bg-blue-500 h-1 w-8 rounded"/>

                                        </a>

                                        <a class="px-4 w-full py-2 cursor-pointer text-black">
                                            {{task.name}}
                                        </a>

                                    </div>
                                    <div class="flex">
                                        <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                           title="delete" @click.prevent="deleteTask(index)">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                 class="fill-current text-white w-6 h-6">
                                                <path
                                                    d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                                            </svg>
                                        </a>

                                        <a class="block p-3 bg-blue-500 hover:bg-blue-400 rounded-lg mr-2 order-1 lg:order-3"
                                           title="edit" @click.prevent="editTaskModal(index)">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                 class="fill-current text-white w-6 h-6">
                                                <path
                                                    d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/>
                                            </svg>

                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </draggable>
                </div>

            </div>
        </div>

        <modal-make-project v-if="showCreateEditProjectModal" :id="editId" :projectName="editName"
                            @addProject="handleProjectAdded"
                            @cancelModal="cancelModalAndResetVariables"/>

        <modal-make-task v-if="showCreateEditTaskModal" :project="selectedProject" :taskName="editName" :id="editId"
                         @addTask="handleTaskAdded"
                         @cancelTaskModal="cancelModalAndResetVariables"/>

        <delete-project v-if="showDeleteProjectModal" :id="editId" :projectName="editName"
                        @addProject="handleProjectAdded"
                        @cancelModal="cancelModalAndResetVariables"/>

        <delete-task v-if="showDeleteTaskModal" :project="selectedProject" :taskName="editName" :id="editId"
                     @addTask="handleTaskAdded"
                     @cancelTaskModal="cancelModalAndResetVariables"/>
    </div>
</template>

<script>
    import ModalMakeProject from "./ModalMakeProject";
    import ModalMakeTask from "../tasks/ModalMakeTask";

    import draggable from 'vuedraggable'
    import DeleteProject from "./DeleteProject";
    import DeleteTask from "../tasks/DeleteTask";

    export default {
        name: "ProjectsMain",
        components: {DeleteTask, DeleteProject, draggable, ModalMakeProject, ModalMakeTask},
        data() {
            return {
                projects: [],
                showCreateEditProjectModal: false,
                editId: -1,
                editName: "",
                showCreateEditTaskModal: false,
                showDeleteTaskModal: false,
                showDeleteProjectModal: false,
                selectedProject: null,
                tasks: null
            }
        },
        methods: {
            async getProjects() {
                let response = await axios.get('/api/projects');
                this.projects = response.data;
                this.chooseFirstProject();
            }, chooseFirstProject() {
                if (this.projects.data && this.projects.data.length > 0) {
                    this.selectedProject = this.projects.data[0]
                } else {
                    this.selectedProject = null
                }
            }, chooseLastProject() {
                if (this.projects.data && this.projects.data.length > 0) {
                    this.selectedProject = this.projects.data[(this.projects.data.length - 1)]
                } else {
                    this.selectedProject = null
                }

            }, handleProjectAdded(response) {
                this.projects = response;
                this.cancelModalAndResetVariables();
                this.chooseLastProject();
            }, handleTaskAdded(response) {
                this.tasks = response;
                this.cancelModalAndResetVariables();
            }, openProject(index) {
                this.selectedProject = this.projects.data[index]
            }, editProject(index) {
                this.editId = this.projects.data[index].id;
                this.editName = this.projects.data[index].name;
                this.showCreateEditProjectModal = true;
            }, deleteProject(index) {
                this.editId = this.projects.data[index].id;
                this.editName = this.projects.data[index].name;
                this.showDeleteProjectModal = true
            }, isSelected(id) {
                if (this.selectedProject) {
                    return this.selectedProject.id === id;
                } else {
                    return false
                }

            }, showTaskModal() {
                this.showCreateEditProjectModal = true;
            }, editTaskModal(index) {
                this.editId = this.tasks.data[index].id;
                this.editName = this.tasks.data[index].name;
                this.showCreateEditTaskModal = true;
            }, deleteTask(index) {
                this.editId = this.tasks.data[index].id;
                this.editName = this.tasks.data[index].name;
                this.showDeleteTaskModal = true;
            }, cancelModalAndResetVariables() {
                this.showCreateEditTaskModal = false;
                this.showDeleteTaskModal = false;

                this.showCreateEditProjectModal = false;
                this.showDeleteProjectModal = false;

                this.editId = -1;
                this.editName = "";
            },

        }, watch: {
            projects: {
                deep: true,
                handler: async function () {
                    if (this.projects && this.projects.data.length > 0) {
                        await axios.post('/api/projects/resort', {
                            projects: this.projects.data
                        });
                    }
                }
            }, selectedProject: {
                deep: true,
                handler: async function () {
                    this.tasks = null;
                    if (this.selectedProject) {
                        let response = await axios.get(`/api/projects/${this.selectedProject.id}/tasks`);
                        this.tasks = response.data;
                    }
                }
            },
            tasks: {
                deep: true,
                handler: async function () {
                    if (this.selectedProject && this.tasks && this.tasks.data.length > 0) {
                        let response = await axios.post(`/api/projects/${this.selectedProject.id}/tasks/resort`, {
                            tasks: this.tasks.data
                        });
                    }
                }
            }
        }, mounted() {
            this.getProjects()
        }
    }
</script>

<style scoped>

</style>
