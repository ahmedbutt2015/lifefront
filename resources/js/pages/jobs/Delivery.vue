<template>
    <section class="all-starups-area">
        <div class="container-fluid p-0" v-if="is_doer">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">My Work</a></li>
                <li class="nav-item"><a class="nav-link" id="supplies-tab" data-toggle="tab" href="#supplies" role="tab" aria-controls="supplies" aria-selected="true">Head Office</a></li>
                <li class="nav-item"><a class="nav-link" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Accounts</a></li>
            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="work" role="tabpanel">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">{{job.job_name}}</h2>
                            <p v-html="job.job_description"></p>


                            <div class="form-group form-row">
                                Set your price per delivery <input type="number" v-model="owner.price" class="form-control text-center" style="max-width: 8rem;"> MO
                            </div>
                            <button class="genric-btn primary medium" @click="savePrice()">Save</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Current Deliveries</h4>
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in in_process">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td v-html="row.quantity"></td>
                                    <td v-html="row.sender_name"></td>
                                    <td v-html="row.receiver_name"></td>
                                    <td>{{row.complete_in}} sec</td>
                                </tr>
                                 <tr v-for="row in inprocessFactory">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td v-html="row.quantity"></td>
                                    <td v-html="row.sender_name"></td>
                                    <td v-html="row.receiver_name"></td>
                                    <td>{{row.complete_in}} sec</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Delivery Requests</h4>
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in requests">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td v-html="row.quantity"></td>
                                    <td v-html="row.sender_name"></td>
                                    <td v-html="row.receiver_name"></td>
                                    <td>
                                        <span class="text-success pointer" @click="acceptRequest(row)">ACCEPT</span>
                                        /
                                        <span class="text-danger pointer" @click="rejectRequest(row)">REJECT</span>
                                    </td>
                                </tr>
                                 <tr v-for="row in offerFactory">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td v-html="row.quantity"></td>
                                    <td v-html="row.sender_name"></td>
                                    <td v-html="row.receiver_name"></td>
                                    <td>
                                        <span class="text-success pointer" @click="acceptRequest(row)">ACCEPT</span>
                                        /
                                        <span class="text-danger pointer" @click="rejectRequest(row)">REJECT</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="accounts" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">Accounting</h2>
                            <p>Description....</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Revenues</th>
                                    <th>Expenses</th>
                                    <th>Clients</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in finance_report">
                                    <td v-html="row.created_at"></td>
                                    <td>{{row.revenue}} <b>MO</b></td>
                                    <td >{{row.expense}} <b>MO</b></td>
                                    <td><router-link class="text-primary" :to="row.client_link" >{{row.client_name}}</router-link></td>
                                    <td v-html="row.revenue-row.expense"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total Profit</td>
                                    <td>{{reportTotal}} <b>MO</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="supplies" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">Supplies</h2>
                            <p>Description....</p>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="container-fluid p-0" v-else>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="job-icon">
                        <img :src="job.icon" :alt="job.job_name" class="img">
                    </div>
                    <h2 class="text-center">{{job.job_name}}</h2>
                    <p>{{job.description}}</p>

                    <h5>The Price per delivery is: {{ owner.price}} MO</h5>
                    <p>This delivery man has made {{ owner.delivery_made}} deliveries.</p>
                    <p>This delivery man is currently making a delivery.</p>
                    <!--    todo : make rob part    -->
                </div>
            </div>


        </div>
    </section>
</template>

<script>
    export default {
        data: () => ({
            is_doer: null,
            job: {
                job_name: 'Delivery Man',
                job_description: '',
                icon: '',
            },
            owner: {},
            finance_report: [],
            in_process: [],
            requests: [],
            inprocessFactory: [],
            offerFactory:[],
        }),
        async mounted() {
            if (this.$route.params.character === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getDeliveryJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
               console.log("data",data);
                this.job = data.job;
                this.owner = data.owner;
                this.in_process = data.in_process;
                this.requests = data.requests;
                this.inprocessFactory = data.inprocessFactory;
                this.offerFactory = data.offerFactory;
                // data.offerFactory.forEach(element => {
                //     this.requests.push(element)
                // });
                this.finance_report = data.finance_report;
                var self = this;
                setInterval(function () {
                    for (let index in self.in_process) {
                        if (self.in_process[index].complete_in > 0) {
                            self.in_process[index].complete_in--
                        } else {
                            self.refreshProduction(index)
                        }
                    }
                }, 1000);
                    setInterval(function () {
                    for (let index in self.inprocessFactory) {
                        if (self.inprocessFactory[index].complete_in > 0) {
                            self.inprocessFactory[index].complete_in--
                        } else {
                            self.refreshProductionFactory(index)
                        }
                    }
                }, 1000);

            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getDeliveryJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.character,
                });
                this.job = data.job;
                this.owner = data.owner;
            }
        },
        methods: {

            refreshProduction(index) {
                let self = this;
                let request = self.in_process[index];
                axios.post('/ajax/deliverItem', {id: request.id})
                    .then(res => {
                        self.in_process.splice(self.in_process.indexOf(request), 1);
                    }).catch(error => {
                    console.log(error.response)
                })
            },
                refreshProductionFactory(index) {
                let self = this;
                let request = self.inprocessFactory[index];
                axios.post('/ajax/deliverItemFactory', {id: request.id})
                    .then(res => {
                        self.inprocessFactory.splice(self.inprocessFactory.indexOf(request), 1);
                    }).catch(error => {
                    console.log(error.response)
                })
            },
            acceptRequest(offer) {
                console.log("pid",offer);
                if(offer.factory_id){
                let self = this;
                axios.post('/ajax/actionDeliveryRequestFactory', {
                    action: 'accept',
                    id: offer.id,
                    product_id:offer.product_id,
                }).then(res => {
                    let data = res.data;
                    this.inprocessFactory = data.in_process;
                    this.offerFactory = data.requests;
                }).catch(error => {
                    console.log(error.response)
                })
                }
                else{
                let self = this;
                axios.post('/ajax/actionDeliveryRequest', {
                    action: 'accept',
                    id: offer.id,
                    product_id:offer.product_id,
                }).then(res => {
                    let data = res.data;
                    this.in_process = data.in_process;
                    this.requests = data.requests;
                }).catch(error => {
                    console.log(error.response)
                })
                }

            },
            rejectRequest(offer) {
                let self = this;
                axios.post('/ajax/actionDeliveryRequest', {
                    action: 'reject',
                    id: offer.id,
                }).then(res => {
                    let data = res.data;
                    this.requests = data.requests;
                }).catch(error => {
                    console.log(error.response)
                })
            },
            savePrice() {
                let self = this;

                axios.post('/ajax/saveDeliveryCharges', {
                    id: self.owner.id,
                    price: self.owner.price,
                }).then(res => {
                    alert('saved')
                }).catch(error => {
                    console.log(error.response)
                })
            },

        },
        computed: {
            // subtotal() {
            //     let total = 0;
            //     if (this.client_order.length) {
            //         for (let i = 0; i < this.client_order.length; i++) {
            //             total += (this.client_order[i].price * this.client_order[i].quantity)
            //         }
            //     }
            //     return total
            // }
            reportTotal() {
                let expense = 0;
                let revenue = 0;
                for (let i = 0; i < this.finance_report.length; i++) {
                    expense += this.finance_report[i].expense;
                    revenue += this.finance_report[i].revenue;
                }

                return revenue - expense;
            }
        },
    }
</script>

<style scoped>
    .job-icon {
        position: absolute;
        width:    6%;
        height:   auto;
    }

    .job-icon img {
        width: 100%;
    }

    @media (min-width: 576px) {
        .job-icon {
            width: 10%;
        }
    }

    @media (min-width: 768px) {
        .job-icon {
            width: 6%;
        }
    }

    @media (max-width: 576px) {

    }
</style>
