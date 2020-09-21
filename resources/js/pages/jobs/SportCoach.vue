<template>
    <section class="all-starups-area">
        <div class="container-fluid p-0" v-if="is_doer">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">My Work</a></li>
                <li class="nav-item"><a class="nav-link" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Accounts</a></li>
                <li class="nav-item"><a class="nav-link" id="supplies-tab" data-toggle="tab" href="#supplies" role="tab" aria-controls="supplies" aria-selected="true">Suppliers</a></li>
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
                            <h4>List of Services Offered</h4>
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="service in services">
                                    <td>
                                        <img :src="service.icon" :alt="service.object_name">
                                    </td>
                                    <td>{{service.object_name}}</td>
                                    <td>
                                        <input type="range" step="1" :min="service.min_price" :max="service.max_price" v-model="service.price" @change="saveServicePrice(service)">
                                        <label class="ml-1" style="line-height: 1;">{{service.price}} MO</label>
                                    </td>
                                    <td>{{service.time}} seconds</td>
                                    <td>
                                        <div class="primary-switch">
                                            <input type="checkbox" id="primary-switch" :checked="service.is_active" @change="changeServiceStatus(service)">
                                            <label for="primary-switch"></label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="form-row">Set your daily fees for your Gym Subscriptions:
                                <div class="col-1"><input type="number" class="form-control inline" v-model="owner.charges" @change="saveSubscriptionsPrice"></div>
                                MO
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Equipments in your Gym</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Equipment</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Time Used</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="equipment in equipments">
                                    <td><img :src="equipment.icon" :alt="equipment.object_name"></td>
                                    <td v-html="equipment.object_name"></td>
                                    <td v-html="equipment.service_name"></td>
                                    <td>{{equipment.price}} MO</td>
                                    <td v-html="equipment.time_used"></td>
                                    <td>Actions</td>
                                </tr>
                                </tbody>
                            </table>
                            <p>The <b>VAT</b> on the services you sell is: <b class="text-success">ON</b> (2%)</p>
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
                                    <td>{{row.expense}} <b>MO</b></td>
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
                            <h4>Orders from suppliers</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="order in orders">
                                    <td><img :src="order.icon" :alt="order.object_name"></td>
                                    <td v-html="order.object_name"></td>
                                    <td v-html="order.price"></td>
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
                                    <td v-html="purchase_quantity * order.price"></td>
                                    <td>
                                        <button class="genric-btn medium primary" @click="buy(order)">Buy</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Back shop</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Equipment</th>
                                    <th>Quantity</th>
                                    <th>Put Front</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in back_shop">
                                    <td><img :src="object.icon" :alt="object.object_name"></td>
                                    <td>{{object.object_name}}</td>
                                    <td>{{object.quantity}}</td>
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
                                        <button class="genric-btn primary medium" @click="putFront(object)">Put Front</button>
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
                    <p>....</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">List of Services offered</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="service in services">
                            <td><img :src="service.icon" :alt="service.object_name"></td>
                            <td v-html="service.object_name"></td>
                            <td v-html="service.price"></td>
                            <td>{{service.time}} seconds</td>
                            <td>
                                <button class="genric-btn primary medium" @click="addInCashier(service)">Select</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="form-row" v-if="!subscribed">Daily fees for this Gym Subscription {{owner.charges}} MO
                        <button class="genric-btn medium primary" @click="subscribeGym"> Subscribe</button>
                    </div>
                    <div v-else>
                        You have subscribe this gym
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Cashiers</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Service</th>
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
                            <th>+ VAT(2%)</th>
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

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Service In Use</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center">Pending</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="pro in on_table">
                            <td>{{pro.object_name}}</td>
                            <td>{{pro.time}} Sec</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">In Process</th>
                        </tr>
                        <tr v-if="in_process != null">
                            <td colspan="2">
                                <div class="text-center">{{in_process.object_name}}</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" :style="in_process.filled_width" :aria-valuenow="in_process.filled" aria-valuemin="0" aria-valuemax="100">
                                        {{in_process.time}} sec
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
                job_name: 'SportCoach',
                job_description: '',
                icon: '',
            },
            purchase_quantity: 1,
            owner: {},
            finance_report: [],
            equipments: [],
            services: [],
            orders: [],
            back_shop: [],
            client_order: [],
            in_process: null,
            on_table: [],
            subscribed: 0,
        }),
        async mounted() {
            if (this.$route.params.owner === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getSportCoachJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                this.job = data.job;
                this.owner = data.owner;
                this.equipments = data.equipments;
                this.services = data.services;
                this.orders = data.orders;
                this.back_shop = data.back_shop;
                this.finance_report = data.finance_report;
            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getSportCoachJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.owner
                });
                this.job = data.job;
                this.owner = data.owner;
                this.services = data.services;
                this.subscribed = data.subscribed;
            }
        },
        methods: {
            buy(object) {
                let self = this;
                axios.post('/ajax/coachPurchaseEquipment', {
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
                console.log($($event.target).val())
                this.purchase_quantity = $($event.target).val()
            },
            putFront(object) {
                let self = this;
                axios.post('/ajax/coachPutFront', {
                    product: object.product_id,
                    quantity: object.put,
                    id: this.owner.id,
                }).then(res => {
                    let data = res.data;
                    self.equipments = data.equipments;
                    self.back_shop = data.back_shop;
                }).catch(error => {
                    console.log(error)
                })
            },
            saveSubscriptionsPrice() {
                axios.post('/ajax/saveCoachSubscriptionsPrice', {
                    id: this.owner.id,
                    charges: this.owner.charges
                }).then(res => {
                    alert('saved');
                })
            },
            saveServicePrice(service) {
                axios.post('/ajax/saveCoachServicePrice', {
                    id: this.owner.id,
                    service: service.product_id,
                    price: service.price
                }).then(res => {
                    alert('saved');
                })
            },
            changeServiceStatus(service) {
                axios.post('/ajax/changeServiceStatus', {
                    id: service.id,
                }).then(res => {
                    alert('saved');
                })
            },
            addInCashier(object) {
                let temp = {
                    id: object.product_id,
                    object_name: object.object_name,
                    icon: object.icon,
                    quantity: 1,
                    time: object.time,
                    price: object.price,
                }

                this.client_order.push(temp)
            },
            pay() {
                let self = this;
                if (this.client_order.length) {
                    axios.post('/ajax/coachVisitorPayService', {
                        total: this.total,
                        owner_id: this.owner.id,
                        services: this.client_order,
                        subscribed: this.subscribed,
                    }).then(res => {
                        if (res.data.status == 'ok') {
                            self.on_table = Object.assign([], self.client_order);
                            let waitTime = 0;
                            var previous_time = '';
                            for (let i in self.on_table) {
                                if (i == 0) {
                                    self.in_process = self.on_table[0]
                                    previous_time = self.in_process.time
                                    self.in_process.total_time = self.in_process.time;
                                    self.in_process.filled = 100;
                                    self.in_process.filled_width = 'width: 100%;';
                                    var timeout = setInterval(function () {
                                        self.in_process.time--
                                        self.in_process.filled = (self.in_process.time / self.in_process.total_time) * 100;
                                        self.in_process.filled_width = 'width: ' + self.in_process.filled + '%;';
                                    }, 1000);
                                    setTimeout(function () {
                                        self.in_process = null;
                                        self.on_table.splice(0, 1)
                                    }, (previous_time * 1000));

                                } else {
                                    waitTime += (previous_time * 1000)
                                    setTimeout(function () {
                                        let temp = self.on_table[0]
                                        previous_time = temp.time
                                        temp.total_time = temp.time;
                                        temp.filled = 100;
                                        temp.filled_width = 'width: 100%;';
                                        self.in_process = temp
                                    }, waitTime);
                                    setTimeout(function () {
                                        self.on_table.splice(0, 1)
                                        self.in_process = null;
                                    }, waitTime + (self.on_table[i].time * 1000));
                                }

                            }

                            waitTime += (previous_time * 1000)
                            setTimeout(function () {
                                self.in_process = null;
                                clearInterval(timeout);
                            }, waitTime);
                        }
                        self.client_order = [];
                        alert(res.data.msg);
                    })
                }


            },
            subscribeGym() {
                let self = this
                axios.post('/ajax/subscribeToGym', {
                    id: this.owner.id,
                }).then(res => {
                    self.subscribed = 1
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
                return this.subtotal * .02
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
