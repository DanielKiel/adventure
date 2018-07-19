<template>
    <div>
        <div>
            <form @submit.prevent="sendForm()">
                <input type="text" v-model="country">
                <input type="text" v-model="query" @input="refreshResults()">
                <button type="submit">Search</button>
            </form>
        </div>
        <div v-if="meta.total > 0">
            Items: {{meta.total}}
            <div v-if="meta.last_page > meta.current_page">
                <a href="#" class="btn" @click="loadMoreResults">Mehr laden</a>
            </div>
        </div>
        <div v-for="(city, index) in cities" :key="index">
            <div>{{city.name}}
                <a href="#" @click="showOnMaps(city)"> <i class="fas fa-map-marker"></i></a>
                <a href="#" @click="subscribeWeather(city)"><i class="fas fa-check-square" </a>
            </div>
        </div>
    </div>
</template>

<script>
    import Model from "../classes/Model";

    export default {
        name: "CitySearch",
        data() {
            return {
                country: 'DE',
                wait: 1000,
                cities: [],
                meta: {},
                founded: [],
                query: '',
                searchData: {}
            }
        },
        mounted() {
            this.init()
        },
        methods: {
            init() {
                this.cities = []
                this.searchData = {
                    page: 1,
                    per_page: 10
                }
                this.meta = {
                    total: 0,
                    current_page: 0,
                    last_page: 0
                }
                this.founded = []
            },

            loadMoreResults() {
                this.searchData = {
                    page: this.meta.current_page + 1
                }

                this.search()
            },

            refreshResults() {
                this.sleep(this.wait).then( () => {
                    this.init()
                    this.search()
                } )
            },

            sendForm(wait = 0) {
                this.init()
                this.search()
            },

            search() {
                let city = new Model('cities', 'city')
                let query = [
                    {
                        leftOperand: 'name',
                        operand: 'LIKE',
                        rightOperand: '%' + this.query + '%'
                    },
                    {
                        leftOperand: 'country',
                        operand: '=',
                        rightOperand: this.country
                    }
                ]

                city.search(query, this.searchData).then( (response) => {
                    response.data.data.forEach( (city) => {
                        if (this.founded[city.id] === undefined) {
                            this.founded[city.id] = true
                            this.cities.push(city)
                        }
                    } )

                    this.meta = {
                        total: response.data.total,
                        current_page: response.data.current_page,
                        last_page: response.data.last_page
                    }

                } ).catch( (error) => {
                    console.log(error)
                } )
            },

            sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            },

            showOnMaps(city) {
                Bus.$emit('city-marker-requested', city)
            },

            subscribeWeather(city) {

            }
        }
    }
</script>

<style scoped>

</style>