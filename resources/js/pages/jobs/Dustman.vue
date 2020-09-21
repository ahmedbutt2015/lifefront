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

                            <p>The current trash points price is: {{company.charges}} MO</p>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>List of Trash Disposal Requests</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Habitation</th>
                                    <th>Trash PTS</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in disposal_requests">

                                    <td v-html="object.full_name"></td>
                                    <td v-html="object.habitation"></td>
                                    <td v-html="object.points"></td>
                                    <td>{{object.total}} MO</td>
                                    <td>
                                        <button @click="cleanTrash(object)" class="genric-btn medium primary">Visit</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Tools in Garage</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Tool Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in tools">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>

                                    <td v-html="object.quantity"></td>
                                    <td>
                                        <button @click="throwObject(object)" class="genric-btn medium primary">Throw</button>
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
                                    <td >{{row.commission}} <b>MO</b></td>
                                    <td>{{row.bonus}} <b>MO</b></td>
                                    <td >{{row.commission+row.bonus}} <b>MO</b></td>
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
                            <h2 class="text-center">DUSTMAN MANAGER</h2>
                            <p v-html="job.job_description"></p>

                            <div class="form-group form-row">
                                Set your trash points price
                                <input @change="saveCharge()" class="form-control text-center" style="max-width: 8rem;" type="number" v-model="company.charges"> MO
                            </div>
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
                                    <th>Payment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in supplies">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td class="form-row">{{object.price}} MO</td>
                                    <td>
                                        <select @change="changePurQty($event)" class="form-control" name="quantity">
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
                                    <td> {{object.price*purchase_quantity}} MO</td>
                                    <td>
                                        <button @click="buy(object)" class="genric-btn medium primary">PAY</button>
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
                                <tr v-for="object in manager_stock">
                                    <td><img :alt="object.object_name" :src="object.icon"></td>
                                    <td v-html="object.object_name"></td>
                                    <td v-html="object.quantity"></td>
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
                                    <td>{{row.revenue}} <b>MO</b></td>
                                    <td>{{row.expense}} <b>MO</b></td>
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
                                        <input class="form-control" readonly type="text" value="DustMan">
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
                    <p>The price per trash points is: {{ company.charges }} MO</p>
                    <div class="form-group">
                        <div class="form-row">
                            Request Trash Empty
                            <button @click="saveTrashRequest()" class="genric-btn medium primary">SEND</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Your Past Requests</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Dustman</th>
                            <th>Habitation</th>
                            <th>Trash PTS</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="object in visitor_requests">
                            <td><img :alt="object.object_name" :src="object.icon"></td>
                            <td v-html="object.object_name"></td>
                            <td v-html="object.price"></td>
                            <td v-html="object.quantity"></td>


                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
        <div class="container-fluid p-0" v-else>

            <div class="card">
                <div class="card-body">

                    <h3>DustMan Not Found</h3>
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
                job_name: 'DUSTMAN',
                job_description: '',
                icon: '',
            },
            owner: {},
            finance_report: [],
            company: {
                charges: 0,
            },
            supplies: [],
            manager_stock: [],
            employees: [],
            employee_requests: [],
            applications: [],
            products: [],
            manager: {},
            tools: [],
            disposal_requests: [],
            visitor_requests: [],

        }),
        async mounted() {
            if (this.$route.params.keeper === undefined) {
                const {data} = await axios.post('/ajax/getDustManJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                console.log("data",data);
                this.is_doer = data.doer;
                this.job = data.job;
                this.owner = data.owner;
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
                    this.tools = data.tools;
                    this.disposal_requests = data.disposal_requests;
                }
                this.finance_report = data.finance_report;

            } else {
                const {data} = await axios.post('/ajax/getDustManJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.keeper
                });
            console.log("data",data);
                if (data.doer == 3) {
                    this.is_doer = data.doer;
                    this.job = data.job;
                    this.owner = data.owner;
                    this.company = data.company;
                    this.visitor_requests = data.requests;

                }
            }
        },
        methods: {
            saveCharge() {
                axios.post('/ajax/saveCompanyCharges', {
                    company_id: this.company.id,
                    charges: this.company.charges,
                }).then(res => {
                    alert('done');
                })
            },
            changePurQty($event) {
                this.purchase_quantity = $($event.target).val()
            },
            buy(object) {
                let self = this;
                axios.post('/ajax/DustManBuyProduct', {
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
                axios.post('/ajax/dustManagerStockRequestAction', {
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
                axios.post('/ajax/dustManagerStockRequestAction', {
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
                axios.post('/ajax/createDustmanItemRequest', data)
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
            throwObject(object) {
                let self = this;
                axios.post('/ajax/dustmanThrowObject', {
                    id: object.id,
                    ch_id: this.owner.id
                }).then(res => {
                    self.tools = res.tools
                    alert('done');
                })
            },

            saveTrashRequest() {
                let self = this;
                axios.post('/ajax/saveTrashCleanRequest', {
                    ch_id: this.owner.id,
                    company_id: this.company.id
                }).then(res => {
                    alert(res.data)
                })
            },

            cleanTrash(request) {
                let self = this;
                axios.post('/ajax/cleanTrash', {
                    id: request.id,
                }).then(res => {
                    self.disposal_requests.splice(self.disposal_requests.indexOf(request), 1);
                })
            }

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
