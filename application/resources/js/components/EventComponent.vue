<template>
    <Loader v-if="!eventData" />
    <div class="row" v-else>
        <div class="col s8">
        </div>
        <div class="col s4">
            <h3>{{ eventData.title }}</h3>
            <p>{{ eventData.description }}</p>
            <p>
                <span class="time"><b>Start at:</b> {{ eventData.started_at }}</span>
                <span class="time"><b>End at:</b> {{ eventData.end_at }}</span>
            </p>
        </div>
    </div>
</template>

<script>
    import Loader from "./Loader";
    export default {
        name: "EventComponent",
        components: {Loader},
        props: ['id'],

        data() {
            return {
                eventData: null
            }
        },

        mounted() {
            axios.get(`/api/events/${this.id}`)
                .then( response => {
                    this.eventData = response.data.data;
                })
                .catch(e => {
                    console.log(e);
                    alert('Something went wrong please try again later')
                })
        }
    }
</script>

<style scoped>

</style>
