<template>
    <div class="container mx-auto w-3/5 mt-8">
        <div class="text-center text-grey-dark font-semibold text-3xl mb-4">
            {{project.name}}
            <p class="text-base">December 5, 2017 - December 13, 2017</p>
        </div>

        <!-- Add Member Form -->
        <addMemberForm v-if="addMemberFormShown" @close="closeAddMemberForm" :project="project" @addMember="addMember"></addMemberForm>

        <div class="h-16 flex flex-row justify-center items-center px-2">
            <span @click="showAddMemberForm" class="bg-white shadow w-8 h-8 rounded-full text-teal hover:cursor-pointer text-center p-2">
                <i class="fas fa-plus"></i>
            </span>
            <a v-for="(member, index) in project.members" v-if="index < 5" :href="'/users/' + member.username" class="pl-2">
                <img :src="member.avatar" class="rounded-full w-8 h-8 mr-1">
            </a>
            <span v-if="project.members.length > 5" class="bg-grey-lighter border-teal border p-2 rounded-full">{{ project.members.length - 5 }}+</span>
        </div>

        <div class="flex flex-row flex-wrap justify-center">
            <taskBoard :resourceType="resourceType" :resource="project"></taskBoard>
            <discussionBoard :resourceType="resourceType" :resource="project"></discussionBoard>
            <messagesBoard :resourceType="resourceType" :resource="project"></messagesBoard>
            <schedule :resourceType="resourceType" :resource="project"></schedule>
            <files :resourceType="resourceType" :resource="project"></files>
            <activity :resourceType="resourceType" :resource="project"></activity>
        </div>
    </div>
</template>

<script>
import taskBoard from './../partials/taskBoard.vue'
import discussionBoard from './../partials/discussionBoard.vue'
import messagesBoard from './../partials/messagesBoard.vue'
import schedule from './../partials/schedule.vue'
import files from './../partials/files.vue'
import activity from './../partials/activity.vue'
import addMemberForm from "./../partials/addMemberForm.vue";

export default {
    components: {
        taskBoard, discussionBoard, messagesBoard, schedule, files, activity, addMemberForm
    },
    props: ['project'],
    data: () => ({
        resourceType: 'projects',
        addMemberFormShown: false,
    }),
    methods: {
        showAddMemberForm () {
            this.addMemberFormShown = true;
        },
        closeAddMemberForm () {
            this.addMemberFormShown = false;
        },
        addMember (newMember) {
            this.project.members.push(newMember);
            this.addMemberFormShown = false;
        }
    }
}
</script>
