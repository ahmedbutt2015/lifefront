<template>
    <section>

        <!--Hero End -->
        <section class="all-starups-area">

            <div class="container-fluid p-0">
                <div v-if="is_doer">

                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="true">Setting</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="true">Requests</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">Work</a></li>
                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="setting" role="tabpanel">

                            <div class="row">
                                <div class="col-6 m-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Price Settings</h4>
                                            <form id="setting-form">
                                                <div class="form-group">
                                                    <label for="sms">For SMS Service</label>
                                                    <input type="number" class="form-control" name="sms" id="sms" placeholder="0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">For Message Service</label>
                                                    <input type="number" class="form-control" name="message" id="message" placeholder="0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="age_filter">For Age Filter</label>
                                                    <input type="number" class="form-control" name="age_filter" id="age_filter" placeholder="0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kind_filter">For Kind Filter</label>
                                                    <input type="number" class="form-control" name="kind_filter" id="kind_filter" placeholder="0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="job_filter">For Job Filter</label>
                                                    <input type="number" class="form-control" name="job_filter" id="job_filter" placeholder="0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="neighbourhood_filter">For Neighbourhood Filter</label>
                                                    <input type="number" class="form-control" name="neighbourhood_filter" id="neighbourhood_filter" placeholder="0">
                                                </div>
                                                <button class="genric-btn primary circle">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="requests" role="tabpanel">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Job Details</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="work" role="tabpanel">
                            send message etc
                        </div>
                    </div>


                </div>
                <div class="row " v-else>
                    <div class="col-6 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <h3>Make Request for advertisement</h3>


                                <form action="" id="advertisement-request-form">
                                    <div class="form-group">
                                        <label for="advertiser">Select Advertiser*</label>
                                        <select name="advertiser" id="advertiser" class="form-control">
                                            <option>Select</option>
                                            <option v-for="advertiser in advertisers" value="advertiser.id" v-html="advertiser.first_name + ' ' +advertiser.last_name"></option>
                                        </select>
                                    </div>
                                    <h4>Filters</h4>

                                    <div class="form-group">
                                        <label for="method">Method*</label>
                                        <select name="method" id="method" class="form-control" required>
                                            <option value="mail">Mail</option>
                                            <option value="sms">SMS</option>
                                            <option value="both">Both</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="kind">Kind</label>
                                        <select name="gender" id="kind" class="form-control">
                                            <option>Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <select name="gender" id="age" class="form-control">
                                            <option>Select</option>
                                            <option value="child">Child</option>
                                            <option value="teen">Teen</option>
                                            <option value="adult">Adult</option>
                                            <option value="elder">Elder</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="neighborhoods">Neighbourhoods</label>
                                        <select name="neighbourhoods" id="neighborhoods" class="form-control">
                                            <option>Select</option>
                                            <option v-for="nb in neighborhoods" :value="nb.id" v-html="nb.neighbourhood_name"></option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="price" v-model="cashForRequest">
                                    <h4>Total Price : <span v-html="cashForRequest"></span></h4>

                                    <button class="genric-btn primary circle">Submit</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            jobs: [],
            is_doer: false,
            advertisers: [],
            neighborhoods: [],
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getAdvertiserJobDetails', {
                job_id: this.$route.params.id,
                ch_id: user.character.id
            });
            this.jobs = data.jobs;
            this.advertisers = data.advertisers;
            this.neighborhoods = data.neighborhoods;
            this.is_doer = data.is_doer;
        },

        methods: {},

        computed: {
            cashForRequest() {
                return 0;
            },
        }
    }

</script>

<style scoped>

</style>
