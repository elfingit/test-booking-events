<template>
    <GmapMap :center="{lat:53.8841936, lng:27.3091114}"
             :zoom="10"
             style="width: 100%; height: 100%"
             ref="mapRef">

        <GmapInfoWindow :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen"
                        @closeclick="infoWinOpen=false">
            <InfoWindow :event="currentEvent"/>
        </GmapInfoWindow>

        <GmapMarker :key="marker.id"
                    v-for="marker in events"
                    :position="marker.position"
                    :clickable="true"
                    @click="showInfoWindow(marker)"/>

    </GmapMap>
</template>

<script>

    import _ from 'lodash'
    import InfoWindow from './InfoWindow'

    export default {
        name: "Map",

        components: { InfoWindow },

        data() {
            return {
                events: [],
                infoWindowPos: null,
                infoWinOpen: false,
                currentEvent: null,

                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                },
            }
        },

        mounted() {
            axios.get('/api/events')
                .then(response  => {
                    this.events = _.map(response.data.data, (value, key) => {
                        return Object.assign(
                            {...value, position: {lat: parseFloat(value.lat), lng: parseFloat(value.long)}}
                        )
                    })
                })
                .catch(e => {
                    console.log(e);
                    alert('Something went wrong please try again later.')
                })
        },

        methods: {
            showInfoWindow: function (marker) {
                this.infoWinOpen = true

                this.infoWindowPos = marker.position
                this.currentEvent = marker
            }
        }
    }
</script>

<style scoped>

</style>
