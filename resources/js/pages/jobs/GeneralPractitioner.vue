<template>
    <section class="all-starups-area">
        <div class="container-fluid p-0" v-if="is_doer">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">My Work</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Accounts</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="supplies-tab" data-toggle="tab" href="#supplies" role="tab" aria-controls="supplies" aria-selected="true">Supplies</a></li>
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
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Diagnose Requests</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Fees</th>
                                    <th>Diagnose Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in requests">
                                    <td>
                                        <router-link class="text-primary" :to="'/city/'+row.prefix+'/'+row.address">{{row.full_name}}</router-link>
                                    </td>
                                    <td v-html="row.fees"></td>
                                    <td v-html="row.type"></td>
                                    <td>
                                        <span class="text-success pointer" @click="acceptRequest(row)">Accept</span>
                                        /
                                        <span class="text-danger pointer" @click="rejectRequest(row)">Reject</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Fees</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Adult</td>
                                    <td><input type="number" v-model="owner.adult_fees" placeholder="Price" class="form-control"> MO</td>
                                    <td>
                                        <button class="genric-btn medium primary" @click="saveServiceCharges">Confirm</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Children</td>
                                    <td><input type="number" v-model="owner.children_fees" placeholder="Price" class="form-control"> MO</td>
                                    <td>
                                        <button class="genric-btn medium primary" @click="saveServiceCharges">Confirm</button>
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
                            <p>Amount Available in Your Cashier: {{owner.cash}}</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Finances</h4>
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
                                    <td >{{row.revenue}} <b>MO</b></td>
                                    <td >{{row.expense}} <b>MO</b></td>
                                    <td v-if="row.client_link">
                                        <router-link class="text-primary" :to="row.client_link">{{row.client_name}}</router-link>
                                    </td>
                                    <td v-else>{{row.client_name}}</td>
                                    <td >{{row.revenue-row.expense}} <b>MO</b></td>
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

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Orders From Suppliers</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in supplies">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td v-html="row.price"></td>
                                    <td>
                                        <select class="form-control" name="quantity" @change="changePurQty($event)">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="genric-btn medium primary" @click="buy(row)">PAY</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Equipments in your clinic.</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Equipment Name</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in equipments">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td>{{row.quantity}}</td>
                                </tr>
                                </tbody>
                            </table>
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
                    <p>description</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <div>
                                <button class="genric-btn large rounded btn-block primary" @click="saveDiagnoseRequest('adult')">Diagnose Me</button>
                            </div>
                            <p>{{this.owner.adult_fees}} MO per Diagnose</p>
                        </div>
                        <div class="col">
                            <div>
                                <button class="genric-btn large rounded btn-block primary" @click="saveDiagnoseRequest('children')">Diagnose my Kids</button>
                            </div>
                            <p>{{this.owner.children_fees}} MO per Diagnose</p>
                        </div>
                    </div>


                    <p>The more you wait the more you will have another disease and more treatment you'll need.</p>
                    <p>You may have some rights to receive reimbursements for the visits, ask government members or insurer.</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data: () => ({
            is_doer: null,
            job: {},
            owner: {
                cash: 0,
                adult_fees: 0,
                children_fees: 0,
            },
            supplies: [],
            equipments: [],
            requests: [],
            finance_report: [],
            purchase_quantity: 1,
        }),
        async mounted() {
            if (this.$route.params.owner === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getPractitionerJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                this.job = data.job;
                this.owner = data.owner;
                this.supplies = data.supplies;
                this.requests = data.requests;
                this.equipments = data.equipments;
                this.finance_report = data.finance_report;
            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getPractitionerJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.owner,
                });
                this.job = data.job;
                this.owner = data.owner;
            }
        },
        methods: {
            buy(object) {
                let self = this;
                axios.post('/ajax/practitionerPurchaseEquipment', {
                    ch_id: this.owner.id,
                    quantity: this.purchase_quantity,
                    pro_id: object.id,
                }).then(res => {
                    let data = res.data;
                    self.equipments = data.equipments;
                    alert(data.msg);
                }).catch(error => {
                    console.log(error)
                })
            },
            changePurQty($event) {
                this.purchase_quantity = $($event.target).val()
            },
            saveDiagnoseRequest(to) {
                let fee = this.owner.adult_fees;
                if (to == 'children') {
                    fee = this.owner.children_fees;
                }
                axios.post('/ajax/practitionerSaveDiagnoseRequest', {
                    ch_id: this.owner.id,
                    type: to,
                    fee: fee,
                }).then(res => {
                    alert(res.data.msg);
                }).catch(error => {
                    console.log(error)
                })
            },
            saveServiceCharges() {
                axios.post('/ajax/practitionerSaveCharges', {
                    ch_id: this.owner.id,
                    adult_fees: this.owner.adult_fees,
                    children_fees: this.owner.children_fees,
                }).then(res => {
                    alert("saved");
                }).catch(error => {
                    console.log(error)
                })
            },
            acceptRequest(request) {
                let self = this;
                axios.post('/ajax/practitionerRequestAction', {
                    ch_id: this.owner.id,
                    action: 'accept',
                    request: request.id,
                }).then(res => {
                    self.requests = res.data.requests
                    alert("Going to Patient profile");
                    window.loaction = '/city/'+request.prefix+'/'+request.address
                }).catch(error => {
                    console.log(error)
                })
            },
            rejectRequest(request) {
                let self = this;
                axios.post('/ajax/practitionerRequestAction', {
                    ch_id: this.owner.id,
                    action: 'reject',
                    request: request.id,
                }).then(res => {
                    self.requests = res.data.requests
                    alert("saved");
                }).catch(error => {
                    console.log(error)
                })
            },
        },
        computed: {
            reportTotal() {
                let expense = 0;
                let revenue = 0;
                for (let i = 0; i < this.finance_report.length; i++) {
                    expense += this.finance_report[i].expense;
                    revenue += this.finance_report[i].revenue;
                }

                return revenue - expense;
            },
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
