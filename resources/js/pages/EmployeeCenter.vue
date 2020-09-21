<template>
    <section>
            
        <!--Hero End -->
        <section class="all-starups-area">
            <div class="container-fluid p-0">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="job-icon">
                            <img src="" alt="employment center" class="img">
                        </div>
                        <h2 class="text-center text-uppercase">employment center</h2>
                        <p>description</p>

                        <div class="row">
                            <div class="col">
                                <button class="genric-btn medium primary" data-toggle="modal" data-target="#add-group">Create a Group</button>
                                <p><u>Cost:</u> X Diamonds + Y Diamonds for every company opened.</p>
                            </div>
                            <div class="col">
                                <button class="genric-btn medium primary" data-toggle="modal" data-target="#add-company">Create a Company</button>
                                <p><u>Cost:</u> Z Diamonds.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <model-select class="mb-4" :options="jobs" v-model="selected_job" placeholder="List oh Jobs"></model-select>
                            </div>
                            <div class="col">
                                <button class="genric-btn medium primary">OK</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card" v-for="offer in offers">
                    <div class="card-body">
                        
                    <div class="row">
                        <div class="col-md-2">

                            
                                <img :src="offer.company_logo"  class="w-100">
                                                        
                        </div>
                        <div class="col-md-4 text-right">


                        <div class="row mb-2">
                            <div class="col">
                                <b>Company Name</b>
                            </div>
                            <div class="col">
                                {{offer.company}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <b>Director Name</b>
                            </div>
                            <div class="col">
                                {{offer.firstname + offer.lastname }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <b>Job</b>
                            </div>
                            <div class="col">
                                {{offer.job_name}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <b>Commission</b>
                            </div>
                            <div class="col">
                                {{offer.commission}} %
                            </div>
                        </div>
                            </div>
</div>
                        <div class="text-right">
                            <button class="genric-btn medium primary" @click="applyForJob(offer)">APPLY</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Add Company Model -->
        <div class="modal" tabindex="-1" id="add-company" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Company Creation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-company-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Company Name:</label>
                                <input type="text" name="company_name" placeholder="Company Name" class="form-control"
                                v-model="company_name">
                            </div>
                            <div class="form-group">
                                <label for="">Company Logo:</label>
                                <input type="file" name="company_logo" placeholder="upload" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Company Job:</label>
                                <model-select class="mb-4" v-model="company_job" :options="jobs" placeholder="List of Jobs"></model-select>
                                <input type="hidden" name="company_job" v-model="company_job.value">

                            </div>
                            <div class="form-group">
                                <label for="">Initial Capital:</label>
                                <input type="number" name="company_capital" placeholder="Capital" class="form-control" min="0"
                                oninput="validity.valid||(value='');"
                                v-model="company_capital">
                                <small class="text-muted text-danger">Initial capital to start your business will be withdrawn from cash</small>
                            </div>
                            <p>You will be debited Z diamonds to create your company.</p>
                            <p>Need more diamonds? <a href="#" class="text-primary">Click here</a></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="create_company()" class="genric-btn circle primary medium"
                            data-dismiss="modal">Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Group Model -->
        <div class="modal" tabindex="-1" id="add-group" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Group Creation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-group-form" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="">Group Name:</label>
                                <input type="text" name="group_name" placeholder="Group Name" class="form-control"
                                v-model="group_name">
                            </div>
                            <div class="form-group">
                                <label for="">First Company Name:</label>
                                <input type="text" name="company_name" placeholder="1st Company Name" class="form-control"
                                v-model="company_name">
                            </div>
                            <div class="form-group">
                                <label for="">Company Logo:</label>
                                <input type="file" name="company_logo" placeholder="upload" class="form-control"
                                >
                            </div>
                            <div class="form-group">
                                <label for="">Company Job:</label>
                                <model-select class="mb-4" :options="jobs" v-model="group_job" placeholder="List oh Jobs"></model-select>
                                <input type="hidden" name="company_job" v-model="group_job.value"
                                >
                            </div>
                            <div class="form-group">
                                <label for="">Initial Capital:</label>
                                <input type="number" name="company_capital" placeholder="Capital" class="form-control"
                                v-model="company_capital" min="0"
                                oninput="validity.valid||(value='');">
                                <small class="text-muted text-danger">Initial capital to start your business will be withdrawn from cash</small>
                            </div>
                            <p>You will be debited X diamonds to create your Group + Y diamonds for the first Company.</p>
                            <p>Need more diamonds? <a href="#" class="text-primary">Click here</a></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="create_group()" class="genric-btn circle primary medium" data-dismiss="modal">Apply</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>

    export default {
           
        props: {},
        data: () => ({
            jobs: [],
            selected_job: {
                value: '',
                text: '',
            }, company_job: {
                value: '',
                text: '',
            }, group_job: {
                value: '',
                text: '',
            },
             errors: [],
             group_name:null,
             company_name:null,
             company_capital:null, 

            offers: [],
            
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getEmploymentCenterDetails');
            this.jobs = data.jobs;
            this.offers = data.offers;
            console.log("this.offers",this.offers);
                        console.log("this.jobs",this.jobs);
        },

        methods: {
      
            create_group() {
                if(this.group_name == null || this.company_name == null || this.company_capital == null || this.group_job.value == "" ){
                    alert("Please fill all the fields, Thanks");
                }
else{

                let formData = new FormData($("#add-group-form")[0]);
                                console.log("formData",formData);
                axios.post('/ajax/createGroup', formData)
                    .then(res =>
                        alert(res.data.msg)
                    )
                    .catch(error =>
                        console.log(error))
}
            },
            create_company() {
            if( this.company_name == null || this.company_capital == null || this.company_job.value == "" ){
                                alert("Please fill all the fields, Thanks");
                            }
                            else{

                let formData = new FormData($("#add-company-form")[0]);
                axios.post('/ajax/createCompany', formData)
                    .then(res =>
                        alert(res.data.msg)

                    )
                    .catch()
                            }
            },
            applyForJob(offer) {
           
                axios.post('/ajax/applyForJob', {
                    offer_id: offer.id,
                }).then(res => {
                        
                        if (res.data)
                            alert("Done")
                        else
                            alert('Already applied');
                    }
                ).catch()
            }
        },

        computed: {}
    }

</script>

<style scoped>
    .link {
        color: #333333;
    }
</style>
