<template>
    <section class="all-starups-area">
        <div class="container-fluid p-0" v-if="is_doer==1">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a aria-controls="work" aria-selected="true" class="nav-link active" data-toggle="tab" href="#work" id="work-tab" role="tab">My Work</a></li>
                <li class="nav-item"><a aria-controls="accounts" aria-selected="true" class="nav-link" data-toggle="tab" href="#accounts" id="accounts-tab" role="tab">Accounts</a></li>
                <li class="nav-item"><a aria-controls="supplies" aria-selected="true" class="nav-link" data-toggle="tab" href="#supplies" id="supplies-tab" role="tab">Head Office</a></li>
            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="work" role="tabpanel">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :alt="job.job_name" :src="job.icon" class="img">
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
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Put Front</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in back_shop">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td v-html="object.quantity"></td>
                                    <td class="form-row">
                                        <input :max="object.max_price" :min="object.min_price" @change="savePrice(object)" step="1" type="range" v-model="object.price">
                                        <label class="ml-1" style="line-height: 1;">{{object.price}} MO</label>
                                    </td>
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
                                        <button @click="putFront(object)" class="genric-btn medium primary">Put</button>
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
                                    <th>Price per Unit</th>
                                    <th>Quantity</th>
                                    <th>Put Back</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in front_shop">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td>{{object.price}} MO</td>
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
                                        <button @click="putBack(object)" class="genric-btn medium primary">Put</button>
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
                                <img :alt="job.job_name" :src="job.icon" class="img">
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
                                    <th>Commission</th>
                                    <th>Bonus</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in finance_report">
                                    <td v-html="row.created_at"></td>
                                    <td>{{row.revenue}} <b>MO</b></td>
                                    <td>{{row.commission}} <b>MO</b></td>
                                    <td>{{row.bonus}} <b>MO</b></td>
                                    <td>{{row.commission+row.bonus}} <b>MO</b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">Total Profit</td>
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
                                <img :alt="job.job_name" :src="job.icon" class="img">
                            </div>
                            <h2 class="text-center">Head Office</h2>
                            <p>Description....</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Items Requests</h4>
                            <form id="item-request-form">
                                <div class="form-row">
                                    <div class="col">

                                        <select class="form-control" name="product_id">
                                            <option value="">list of product</option>
                                            <option :value="product.value" v-for="product in products">{{product.text}}</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <select class="form-control" name="quantity">
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
                                    </div>
                                    <div class="col">
                                        <input name="ch_id" type="hidden" v-model="owner.id">
                                        <input name="manager_id" type="hidden" v-model="manager.id">
                                        <button @click="createItemRequest" class="genric-btn primary medium" type="button">CREATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Your Past Requests</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Icon</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="request in employee_requests">
                                    <td v-html="request.created_at"></td>
                                    <td><img :alt="request.object_name" :src="request.icon"></td>
                                    <td v-html="request.object_name"></td>
                                    <td v-html="request.quantity"></td>
                                    <td v-html="request.status"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="container-fluid p-0" v-else-if="is_doer==2">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item"><a aria-controls="work" aria-selected="true" class="nav-link active" data-toggle="tab" href="#work" id="work-tab" role="tab">My Work</a></li>
                <li class="nav-item"><a aria-controls="accounts" aria-selected="true" class="nav-link" data-toggle="tab" href="#accounts" id="accounts-tab" role="tab">Accounts</a></li>
                <li class="nav-item"><a aria-controls="supplies" aria-selected="true" class="nav-link" data-toggle="tab" href="#supplies" id="supplies-tab" role="tab">HR Office</a></li>
            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="work" role="tabpanel">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :alt="job.job_name" :src="job.icon" class="img">
                            </div>
                            <h2 class="text-center">SHOP MANAGER</h2>
                            <p v-html="job.job_description"></p>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Order From Suppliers</h4>
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
                                <tr v-for="prd in offers">
                                    <td><img :src="prd.icon" :alt="prd.object_name"></td>
                                    <td v-html="prd.object_name"></td>
                                    <td v-html="prd.price"></td>
                                    <td v-html="prd.quantity"></td>
                                    <td v-html="prd.quantity * prd.price"></td>
                                    <td>
                                        <span class="text-success pointer" @click="acceptOffer(prd)">Accept</span>
                                        /
                                        <span class="text-danger pointer" @click="rejectOffer(prd)">Reject</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Employees Requests</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in employee_requests">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td v-html="object.quantity"></td>
                                    <td>
                                        <router-link :to="'/city/'+object.prefix+'/'+object.address" class="text-primary">
                                            {{object.employee_name}}
                                        </router-link>
                                    </td>
                                    <td>
                                        <span @click="acceptRequest(object)" class="text-success pointer">Accept</span>
                                        /
                                        <span @click="rejectRequest(object)" class="text-danger pointer">Reject</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Stock Available</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in availabestock">
                                    <td><img :alt="object.product_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td v-html="object.stock"></td>
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
                                <img :alt="job.job_name" :src="job.icon" class="img">
                            </div>
                            <h2 class="text-center">Accounting</h2>
                            <p>Description....</p>
                            <p>Amount total in your account {{company.capital}} MO</p>
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
                                    <th>Commission</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in finance_report">
                                    <td v-html="row.created_at"></td>
                                    <td >{{row.revenue}} <b>MO</b></td>
                                    <td >{{row.expense}} <b>MO</b></td>
                                    <td>{{row.commission}} <b>MO</b></td>
                                    <td>{{row.revenue-(row.expense+row.commission)}} <b>MO</b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">Total Profit</td>
                                    <td>{{managerReportTotal}} <b>MO</b></td>
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
                                <img :alt="job.job_name" :src="job.icon" class="img">
                            </div>
                            <h2 class="text-center">Human Resources</h2>
                            <p>Description....</p>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Job Applications</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Candidate Name</th>
                                    <th>Date of Application</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="application in applications">
                                    <td>
                                        <router-link :to="'/city/'+application.prefix+'/'+application.address" class="text-primary">{{application.candidate}}</router-link>
                                    </td>
                                    <td v-html="application.created_at"></td>
                                    <td>
                                        <span @click="acceptApplication(application)" class="text-success pointer">Accept</span>
                                        /
                                        <span @click="rejectApplication(application)" class="text-danger pointer">Reject</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Employees</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee Name</th>
                                    <th>Join Date</th>
                                    <th>Contract</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in employees">
                                    <td v-html="employee.id"></td>
                                    <td v-html="employee.employee_name"></td>
                                    <td v-html="employee.joining_date"></td>
                                    <td v-html="employee.contract +' days'"></td>
                                    <td>
                                        <button @click="fireEmployee(employee)" class="genric-btn medium danger">Fire</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Post Job Offer</h4>
                            <form id="offer-form">
                                <div class="form-row">
                                    <div class="col">
                                        <input class="form-control" readonly type="text" value="ShopKeeper">
                                        <input :value="job.id" name="job_id" type="hidden">
                                        <input :value="owner.id" name="posted_by" type="hidden">
                                        <input :value="company.id" name="company_id" type="hidden">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" max="100" min="0" name="commission" placeholder="Commission in percent" type="number">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="contract" placeholder="Contract in days" type="number">
                                    </div>
                                    <div class="col">
                                        <button @click="postJobOffer" class="genric-btn medium primary" type="button">SEND</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Send Bonus</h4>
                            <form id="bonus-form">
                                <div class="form-row">
                                    <div class="col">
                                        <select class="form-control" id="" name="employee_id">
                                            <option :value="employee.id" v-for="employee in employees">{{employee.employee_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" min="0" name="bonus" placeholder="Bonus" type="number">
                                        <input name="company_id" type="hidden" v-model="company.id">
                                    </div>
                                    <div class="col">
                                        <button @click="sendBonusToEmployee" class="genric-btn medium primary" type="button">SEND</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <div class="container-fluid p-0" v-else-if="is_doer==3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="job-icon">
                        <img :alt="job.job_name" :src="job.icon" class="img">
                    </div>
                    <h2 class="text-center">{{job.job_name}}</h2>
                    <p>Welcome to the <b>{{company.name}}</b> shopkeeper page.</p>
                    <p>You will find all the necessary products for your character, the children as well as the house.</p>
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
                            <td><img :alt="object.object_name" :src="object.icon"></td>
                            <td v-html="object.object_name"></td>
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
                                <button @click="addInCashier(object)" class="genric-btn primary medium">Select</button>
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
                            <td><img :alt="object.object_name" :src="object.icon"></td>
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
                                <button @click="pay()" class="genric-btn primary medium">PAY CARD</button>
                            </th>
                            <th>
                                <button @click="pay()" class="genric-btn primary medium">PAY CASH</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="container-fluid p-0" v-else>

            <div class="card">
                <div class="card-body">

                    <h3>ShopKeeper Not Found</h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data: () => ({
            is_doer: null,
            purchase_quantity: 1,
            job: {
                job_name: 'SHOPKEEPER',
                job_description: '',
                icon: '',
            },
            owner: {},
            finance_report: [],
            company: {},
            supplies: [],
            manager_stock: [],
            employees: [],
            employee_requests: [],
            applications: [],
            products: [],
            manager: {},
            back_shop: [],
            front_shop: [],
            client_order: [],
            offers:[],
            availabestock :[],

        }),
        async mounted() {
            if (this.$route.params.keeper === undefined) {
                const {data} = await axios.post('/ajax/getShopKeeperJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                console.log("data check",data);
                this.is_doer = data.doer;
                this.availabestock = data.ingredients;
                this.job = data.job;
                this.owner = data.owner;
                this.offers = data.offers;
                this.employee_requests = data.employee_requests;
                this.company = data.company;
                if (data.doer == 2) {
                    this.supplies = data.supplies;
                    this.manager_stock = data.manager_stock;
                    this.employees = data.employees;
                    this.applications = data.applications;
                } else {
                    this.products = data.products;
                    this.manager = data.manager;
                    this.back_shop = data.back;
                    this.front_shop = data.front;
                }
                this.finance_report = data.finance_report;

            } else {
                const {data} = await axios.post('/ajax/getShopKeeperJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.keeper
                });
                console.log("datavis",data);
                if (data.doer == 3) {
                    this.is_doer = data.doer;
                    this.job = data.job;
                    this.owner = data.owner;
                    this.company = data.company;
                    this.front_shop = data.front_shop;
                }
            }
        },
        methods: {
          acceptOffer(offer) {
            //   this.buy(offer);
                let self = this;
                console.log("data",offer);
                axios.post('/ajax/actionFarmerOfferShopKeeper', {
                    action: 'accept',
                    offer: offer,
                }).then(res => {
                    let data = res.data;
                    alert(data.msg)
                    self.offers = data.offers;
                    self.ingredients = data.ingredients;
                }).catch(error => {
                    console.log(error.response)
                })
            },
            rejectOffer(offer) {
                let self = this;
                axios.post('/ajax/actionFarmerOffer', {
                    action: 'reject',
                    id: offer.id,
                }).then(res => {
                    let data = res.data;
                    alert(data.msg)
                    self.offers = data.offers;
                    self.ingredients = data.ingredients;
                }).catch(error => {
                    console.log(error.response)
                })
            },
            changePurQty($event) {
                this.purchase_quantity = $($event.target).val()
            },
            buy(object) {
                let self = this;
                axios.post('/ajax/ShopManagerBuyProduct', {
                    ch_id: this.owner.id,
                    company_id: this.company.id,
                    quantity: this.purchase_quantity,
                    pro_id: object.id,
                }).then(res => {
                    let data = res.data;

                    self.manager_stock = data.manager_stock;
                    self.company = data.company;
                    self.finance_report = data.finance_report;
                    alert(data.msg);
                }).catch(error => {
                    console.log(error)
                })
            },
            acceptRequest(object) {
                let self = this;
                axios.post('/ajax/shopManagerStockRequestAction', {
                    action: 'accept',
                    request_id: object.id
                }).then(res => {
                    let data = res.data
                    self.manager_stock = data.manager_stock;
                    self.employee_requests = data.employee_requests;
                    alert(data.msg)
                }).catch(error => {
                    console.log(error)
                })
            },
            rejectRequest(object) {
                let self = this;
                axios.post('/ajax/shopManagerStockRequestAction', {
                    action: 'reject',
                    request_id: object.id
                }).then(res => {
                    let data = res.data
                    self.manager_stock = data.manager_stock;
                    self.employee_requests = data.employee_requests;
                    alert(data.msg)
                }).catch(error => {
                    console.log(error)
                })
            },
            postJobOffer() {
                let data = $('#offer-form').serialize();
                if (data.commission == '' || data.contract == '') {
                    alert('Please fill form properly')
                } else {
                    axios.post('/ajax/createJobOffer', data)
                        .then(res => {
                            alert('done! wait for people to respond on your request')
                        })
                }
            },
            acceptApplication(object) {
                let self = this;
                axios.post('/ajax/jobApplicationAction', {
                    action: 'accept',
                    ch_id: this.owner.id,
                    request_id: object.id
                }).then(res => {
                    let data = res.data
                    self.applications = data.applications;
                    self.employees = data.employees;
                    alert(data.msg)
                }).catch(error => {
                    console.log(error)
                })
            },
            rejectApplication(object) {
                let self = this;
                axios.post('/ajax/jobApplicationAction', {
                    action: 'reject',
                    ch_id: this.owner.id,
                    request_id: object.id
                }).then(res => {
                    let data = res.data
                    self.applications = data.applications;
                    self.employees = data.employees;
                    alert(data.msg)
                }).catch(error => {
                    console.log(error)
                })
            },
            fireEmployee(employee) {
                axios.post('/ajax/fireEmployee', {
                    employee: employee.employee_id,
                    company_id: this.company.id,
                    ch_id: this.owner.id,
                    job_id: this.job.id,
                }).then(res => {
                    alert(res.data.msg)
                })
            },
            sendBonusToEmployee() {
                let self = this
                let data = $("#bonus-form").serialize()
                axios.post('/ajax/sendBonus', data)
                    .then(res => {
                        self.finance_report = res.data.finance_report
                        alert(res.data.msg)
                    })
            },


            createItemRequest() {
                let self = this
                let data = $("#item-request-form").serialize();
                axios.post('/ajax/createShopKeeperItemRequest', data)
                    .then(res => {
                        let data = res.data
                        self.employee_requests = data.employee_requests
                        alert(data.msg)
                    })
            },
            savePrice(object) {
                let self = this;
                axios.post('/ajax/shopkeeperSaveItemPrice', {
                    ch_id: this.owner.id,
                    price: object.price,
                    product_id: object.product_id,
                }).then(res => {
                    self.back_shop = res.data.back_shop
                    self.front_shop = res.data.front_shop
                    alert("saved");
                })
            },
            putFront(row) {
                let self = this;
                if (row.quantity >= row.put) {
                    axios.post('/ajax/shopkeeperPutFront', {
                        ch_id: this.owner.id,
                        pro_id: row.product_id,
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
                    axios.post('/ajax/shopkeeperPutBack', {
                        ch_id: this.owner.id,
                        pro_id: row.product_id,
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
                    axios.post('/ajax/shopkeeperVisitorPay', {
                        total: this.total,
                        owner_id: this.owner.id,
                        items: this.client_order,
                        company_id: this.company.id,
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
            },
            reportTotal() {
                let bonus = 0;
                let commission = 0;
                for (let i = 0; i < this.finance_report.length; i++) {
                    bonus += this.finance_report[i].bonus;
                    commission += this.finance_report[i].commission;
                }

                return bonus + commission;
            },
            managerReportTotal() {
                let expense = 0;
                let revenue = 0;
                let commission = 0;
                for (let i = 0; i < this.finance_report.length; i++) {
                    expense += this.finance_report[i].expense;
                    revenue += this.finance_report[i].revenue;
                    commission += this.finance_report[i].commission;
                }

                return revenue - (expense + commission);
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
