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
                            <h4>Back Shop</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Put Front</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in back_shop">
                                    <td><img :src="row.icon" :alt="row.name"></td>
                                    <td v-html="row.name"></td>
                                    <td class="form-row">
                                        <input type="range" step="1" :min="row.min_price" :max="row.max_price" v-model="row.price" @change="saveMedicationPrice(row)">
                                        <label class="ml-1" style="line-height: 1;">{{row.price}} MO</label>
                                    </td>
                                    <td>{{row.quantity}}</td>
                                    <td>
                                        <select class="form-control" name="quantity" v-model="row.put">
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
                                        <button class="genric-btn medium primary" @click="putFront(row)">Put</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Front Shop</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Put Front</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in front_shop">
                                    <td><img :src="row.icon" :alt="row.name"></td>
                                    <td v-html="row.name"></td>
                                    <td>{{row.price}} MO</td>
                                    <td>{{row.quantity}}</td>
                                    <td>
                                        <select class="form-control" name="quantity" v-model="row.put">
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
                                        <button class="genric-btn medium primary" @click="putBack(row)">Put</button>
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
                                    <td>{{row.expense}} <b>MO</b></td>
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
                            <h2 class="text-center">PHARMA LABO</h2>
                            <p>You will find here the medication supplies.</p>
                            <p class="text-danger"><u>Warning:</u> Do not take medication without consulting a doctor first.</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Orders From Suppliers</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in supplies">
                                    <td><img :src="row.icon" :alt="row.name"></td>
                                    <td v-html="row.name"></td>
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
                                    <td v-html="row.price * purchase_quantity "></td>
                                    <td>
                                        <button class="genric-btn medium primary" @click="buy(row)">PAY</button>
                                    </td>
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
                    <p>Welcome to the {{owner.first_name}} {{owner.last}} shopkeeper page.</p>
                    <p>You will find here all the necessary products for your character, the children as well as the house.</p>
                    <p>Be aware that VAT may be applicable when paying for your purchases.</p>
                    <p>Have a nice shopping!</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Available Items</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Put Front</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="object in front_shop">
                            <td><img :src="object.icon" :alt="object.name"></td>
                            <td v-html="object.name"></td>
                            <td v-html="object.price"></td>
                            <td v-html="object.quantity"></td>
                            <td>
                                <select class="form-control" name="quantity" v-model="object.put">
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
                                <button class="genric-btn primary medium" @click="addInCashier(object)">Select</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Cashiers</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="object in client_order">
                            <td><img :src="object.icon" :alt="object.object_name"></td>
                            <td v-html="object.object_name"></td>
                            <td v-html="object.price"></td>
                            <td v-html="object.quantity"></td>
                            <td v-html="object.quantity*object.price"></td>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Subtotal</th>
                            <th> {{subtotal}} MO</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>+ VAT(5%)</th>
                            <th>{{vat}} MO</th>
                        </tr>

                        <tr>
                            <th colspan="3"></th>
                            <th>TOTAL</th>
                            <th>{{total}} MO</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>
                                <button class="genric-btn primary medium" @click="pay()">PAY CARD</button>
                            </th>
                            <th>
                                <button class="genric-btn primary medium" @click="pay()">PAY CASH</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <!--
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="text-center">Items Brought</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="object in on_table">
                                        <td><img :src="object.icon" :alt="object.name"></td>
                                        <td v-html="object.name"></td>
                                        <td v-html="object.quantity"></td>
                                        <td>
                                          <button class="genric-btn primary medium" @click="addInCashier(object)">Select</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
            -->
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
            },
            supplies: [],
            back_shop: [],
            front_shop: [],
            client_order: [],
            on_table: [],
            finance_report: [],
            purchase_quantity: 1,
        }),
        async mounted() {
            if (this.$route.params.owner === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getPharmacistJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                this.job = data.job;
                this.owner = data.owner;
                this.supplies = data.supplies;
                this.back_shop = data.back_shop;
                this.front_shop = data.front_shop;
                this.finance_report = data.finance_report;
            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getPharmacistJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.owner,
                });
                this.job = data.job;
                this.owner = data.owner;
                this.front_shop = data.front_shop;

            }
        },
        methods: {
            buy(object) {
                let self = this;
                axios.post('/ajax/pharmacistPurchaseMedication', {
                    ch_id: this.owner.id,
                    quantity: this.purchase_quantity,
                    pro_id: object.id,
                }).then(res => {
                    let data = res.data;
                    self.back_shop = data.back_shop;
                    alert(data.msg);
                }).catch(error => {
                    console.log(error)
                })
            },
            changePurQty($event) {
                this.purchase_quantity = $($event.target).val()
            },

            saveMedicationPrice(object) {
                axios.post('/ajax/pharmacistSaveMedicationPrice', {
                    id: object.id,
                    price: object.price,
                }).then(res => {
                    alert("saved");
                }).catch(error => {
                    console.log(error)
                })
            },

            putFront(row) {
                let self = this;
                if (row.quantity >= row.put) {
                    axios.post('/ajax/pharmacistPutFront', {
                        ch_id: this.owner.id,
                        med_id: row.medication_id,
                        quantity: row.put,
                    }).then(res => {
                        self.back_shop = res.data.back_shop
                        self.front_shop = res.data.front_shop
                        alert("Done!");
                    }).catch(error => {
                        console.log(error)
                    })
                } else {
                    alert('Cannot put front quantity more than you have.')
                }
            },
            putBack(row) {
                let self = this;
                if (row.quantity >= row.put) {
                    axios.post('/ajax/pharmacistPutBack', {
                        ch_id: this.owner.id,
                        med_id: row.medication_id,
                        quantity: row.put,
                    }).then(res => {
                        self.back_shop = res.data.back_shop
                        self.front_shop = res.data.front_shop
                        alert("Done!");
                    }).catch(error => {
                        console.log(error)
                    })
                } else {
                    alert('Cannot put front quantity more than you have.')
                }
            },
            addInCashier(object) {
                if (object.quantity >= object.put) {
                    let temp = Object.assign({}, object)
                    temp.quantity = object.put
                    object.quantity -= object.put
                    this.client_order.push(temp)
                } else {
                    alert("You cannot put front more than quantity");
                }

            },
            pay() {
                let self = this;
                if (this.client_order.length) {
                    axios.post('/ajax/pharmacistVisitorPay', {
                        total: this.total,
                        owner_id: this.owner.id,
                        medications: this.client_order,
                    }).then(res => {
                        if (res.data.status == 'ok') {
                            self.on_table = Object.assign([], self.client_order);
                        }
                        self.client_order = [];
                        self.front_shop = res.data.front_shop;

                        alert(res.data.msg);
                    })
                }


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
            subtotal() {
                let total = 0;
                if (this.client_order.length) {
                    for (let i = 0; i < this.client_order.length; i++) {
                        total += (this.client_order[i].price * this.client_order[i].quantity)
                    }
                }
                return total
            },
            vat() {
                return this.subtotal * .05
            },
            total() {
                return this.subtotal + this.vat
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
