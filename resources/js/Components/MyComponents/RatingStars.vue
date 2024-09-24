<template>
    <div v-if="rate==0">
        <i v-for="(star, index) in stars" :key="star" @click="selectStars" @mouseover="pos=star" @mouseout="pos=0" class="fa-regular fa-star text-xl text-gray-400 cursor-pointer"
        :class="index < pos ? 'text-yellow-500' : ''"></i>

    </div>
    <div v-if="rate!=0">
        <i v-for="(star, index) in stars" :key="star" @mouseover="pos=star" @click="selectStars" class="fa-regular fa-star text-xl text-gray-400 cursor-pointer"
        :class="index < rate ? 'text-yellow-500' : ''"></i>
    </div>

</template>

<script>
export default {
    data() {
        return {
            stars: 5,
            pos: 0,
            rate: 0,
        }
    },
    emits: ['selected'],
    methods:{
        selectStars() {
            this.rate = this.pos;
            this.$emit('selected', this.rate);
        }
    }
}
</script>