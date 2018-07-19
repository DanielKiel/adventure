<template>
    <div>
        <GmapMap
                :center="{lat:coord.lat, lng:coord.lon}"
                :zoom="8"
                map-type-id="hybrid"
                style="width: 100%; height: 300px"
        >

            <GmapMarker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                    :clickable="true"
                    :draggable="true"
                    @click="showWindow(m)",
                    :icon="m.icon"
            />

            <GmapInfoWindow
                :opened="infoWindow.opened"
                :position="infoWindow.position"
                @closeclick="closeInfoWindow"
            >
                <h3>{{infoWindow.city.name}}</h3>
                <div v-if="infoWindow.city.weather !== undefined && infoWindow.city.weather.id !== undefined">
                    {{infoWindow.city.weather.mainTemp}}
                </div>
                <div v-else>
                    <a href="#" @click="subscribe(infoWindow.city)">subscribe weather</a>
                </div>
            </GmapInfoWindow>

        </GmapMap>
    </div>
</template>

<script>
    import * as VueGoogleMaps from 'vue2-google-maps'
    import Model from "../classes/Model";

    export default {
        name: "MainCard",
        data() {
            return {
                coord: {
                    lat: 50.466671,
                    lon: 12.066670
                },
                iconBase: 'https://maps.google.com/mapfiles/kml/shapes/',
                icons: {
                    pin: {
                        icon: 'http://maps.google.com/mapfiles/kml/pushpin/red-pushpin.png',
                        alt: 'http://maps.google.com/mapfiles/kml/pushpin/red-pushpin.png',
                    },
                    sunny: {
                        icon: 'https://maps.google.com/mapfiles/kml/shapes/sunny.png',
                        alt: 'http://maps.google.com/mapfiles/kml/pal4/icon33.png'
                    },
                    partly_cloudly: {
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/partly_cloudy.png',
                        alt: ''
                    },
                    thunderstorm: {
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/thunderstorm.png',
                        alt: ''
                    },
                    snow: {
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/snowflake_simple.png',
                        alt: ''
                    },
                    rain: {
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/rainy.png',
                        alt: ''
                    }
                },
                markers: [],
                openWindow: true,
                infoWindow:{
                    opened: false,
                    position: {
                        lat: 50.466671,
                        lng: 12.066670
                    },
                    city: {
                        weather: {},
                        weatherForecast: {}
                    }
                }
            }
        },
        created() {
            this.subscriptions()

            Bus.$on('city-marker-requested', (city) => {
                this.coord.lat = city.lat
                this.coord.lon = city.lon

                this.pushCity(city, 'pin')
            })

            Bus.$on('city-weather-subscribed', (city) => {
                this.coord.lat = city.lat
                this.coord.lon = city.lon

                this.pushCity(city, 'pin')
            })
        },
        methods: {
            subscriptions() {
                axios({
                    method: 'GET',
                    url: laroute.route('weather.subscriptions')
                }).then( (response) => {
                    this.markers = new Array

                    response.data.forEach( (subscription) => {
                        Bus.$emit('city-weather-added', subscription.city)
                        this.pushCity(subscription.city)
                    } )

                } ).catch( (error) => {
                    console.log(error)
                } )
            },

            subscribe(city) {
                axios({
                    method: 'GET',
                    url: laroute.route('weather.subscribe',{city: city.id})
                }).then( (response) => {
                    Bus.$emit('city-weather-added', response.data)
                    this.pushCity(subscription.city)

                } ).catch( (error) => {
                    console.log(error)
                } )
            },

            pushCity(city, type = 'pin') {
                let icon = this.icons[type].alt

                if (city.weather !== undefined && city.weather.icon !== undefined) {
                    icon = 'http://openweathermap.org/img/w/' + city.weather.icon +'.png'
                }

                this.markers.push({
                    position: {
                        lat: city.lat,
                        lng: city.lon
                    },
                    city: city,
                    icon: icon
                })
            },

            showWindow(marker) {

                this.infoWindow = {
                    opened: true,
                    position: marker.position,
                    city: marker.city
                }
            },

            closeInfoWindow() {
                this.$set(this.infoWindow, 'opened', false)
                console.log(this.infoWindow)
            }
        }
    }
</script>

<style scoped>

</style>