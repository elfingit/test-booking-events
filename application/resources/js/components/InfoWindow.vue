<template>
    <div v-if="event">
        <h3>{{ event.title }}</h3>
        <p>{{ event.description }}</p>
        <p>
            <span class="time"><b>Start at:</b> {{ event.started_at }}</span>
            <span class="time"><b>End at:</b> {{ event.end_at }}</span>
        </p>
        <button class="waves-effect waves-light btn-small" @click="registerToEvent">Register to event</button>
    </div>
</template>

<script>
    export default {
        name: "InfoWindowButton",
        props: ['event'],

        methods: {
            registerToEvent: function () {
                this.$router.push({
                    path: `/event/${this.event.id}`
                })
            }
        }
    }
</script>

<style scoped>

</style>
