<template>
    <div class="place-container" @click="onPlaceClick"
         :style="{ 'top': place.position_y + 'px',  'left': place.position_x + 'px'}">
        <div class="place-body">
            <span class="price">{{ place.price }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Place",
        props: ['place'],

        methods: {
            onPlaceClick: function() {
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
    }
    .place-body:hover {
        background-color: #0E9A00;
    }

    .price {
        padding: 1rem;
    }
</style>
