<template>
    <div>
        <p><router-link to="/">Home</router-link></p>
        <Loader v-if="!eventData" />
        <div class="row" v-else>
            <div class="col s8">
                <Place
                    @placeClick="onPlaceClick"
                    v-for="place in places"
                    :place="place"
                    :key="place.id" />
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
        <BookFormComponent ref="bookForm" @newReservation="onNewReservation"/>
    </div>
</template>

<script>
    import Loader from "./Loader"
    import Place from "./Place"
    import BookFormComponent from "./BookFormComponent"

    import axios from "axios"

    export default {
        name: "EventComponent",
        components: {BookFormComponent, Place, Loader},
        props: ['id'],

        data() {
            return {
                eventData: null,
                places: []
            }
        },

        mounted() {
            axios.get(`/api/events/${this.id}`)
                .then( response => {
                    this.eventData = response.data.data
                })
                .catch(e => {
                    console.log(e)
                    alert('Something went wrong please try again later')
                })

            axios.get(`/api/events/${this.id}/place`)
                .then( response => {
                    this.places = response.data.data
                })
                .catch(e => {
                    console.log(e)
                    alert('Something went wrong please try again later')
                })
        },

        methods: {
            onPlaceClick: function(place) {
                this.$refs.bookForm.show(place)
            },

            onNewReservation: function(reserv) {
                let index = window._.findIndex(this.places, { id: parseInt(reserv.place_id) })

                if (index > -1) {
                    const place = this.places[index]
                    place.reservation = reserv
                    this.places.splice(index, 1, place)
                }
            }
        }
    }
</script>

<style scoped>
 .s8 {
    position: relative;
 }
</style>
