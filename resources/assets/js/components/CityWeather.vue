<template>
    <div>
        <div v-for="(city, index) in cities" :key="index">
            <h3>{{city.name}}</h3>
            <p>{{city.weather.main}}: {{city.weather.description}}</p>
            {{city.weather.mainTemp}} Celsius
        </div>
    </div>
</template>

<script>
    export default {
        name: "CityWeather",
        props: [
            'city-subscriptions'
        ],
        data() {
            return {
                cities: []
            }
        },
        created() {
            Bus.$on('city-weather-added', (city) => {
                this.cities.push(city)
            })
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>