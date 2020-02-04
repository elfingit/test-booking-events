<template>
    <div class="place-container" @click="onPlaceClick"
         :style="{ 'top': place.position_y + 'px',  'left': place.position_x + 'px'}">
        <div class="place-body" v-if="!place.reservation">
            <span class="price">{{ place.price }}</span>
        </div>
        <div class="reserved-body" v-else>
            <img :src="place.reservation.logo" width="100%" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Place",
        props: ['place'],

        methods: {
            onPlaceClick: function() {

                if (!this.place.reservation)
                    this.$emit('placeClick', this.place)
            }
        }
    }
</script>

<style scoped>
    .place-container {
        position: absolute;
        border: 1px solid grey;
        border-radius: 3px;
    }
    .place-body {
        cursor: pointer;
        min-height: 67px;
    }
    .place-body:hover {
        background-color: #0E9A00;
    }

    .price {
        padding: 1rem;
    }

    .reserved-body {
        width: 67px;
        min-height: 67px;
    }
</style>
