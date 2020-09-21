<template>
    <section>

        <section class="all-starups-area">

            <div class="container-fluid sample-text-area">

                <ul class="unordered-list">
                    <li v-for="city in cities">
                        <router-link class="text-dark" :to="makeLink(city.slug)">{{city.title}}</router-link>
                    </li>
                </ul>

            </div>

        </section>
    </section>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            cities: [],
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getCities');
            this.cities = data;
        },

        methods: {
            makeLink(slug) {
                return "/city/"+slug;
            }
        }
    }
</script>
