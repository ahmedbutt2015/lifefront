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
                                <img class="img">
                            </div>
                            <h2 class="text-center">Phone Seller</h2>
                            <p >hcjdbj nmcbdbcj kcnbkd</p>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Front Store</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>All Quantity</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="object in keeperFront" >
                                     <td><img :alt="object.object_name" :src="object.icon"></td>
                                        <td>{{object.object_name}}</td>
                                        <td>{{object.quantity}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Credits</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price per credit</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                <td>Icon</td>
                                <td>Credit</td>
                                <td> {{company.credits}}</td>
                                <td>Remove</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Credits Subscription</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Daily Fees</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="sp in subscription_plan" >
                                        <td>Icon</td>
                                        <td>Phone</td>
                                        <td>{{sp.credits_subscription}}</td>
                                        <td>{{sp.subscription_quantity}}</td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Credits Subscription Clients</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Daily Fees</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="sp in subscription_plan_buyer" >
                                        <td>{{sp.first_name+sp.last_name}}</td>
                                        <td>{{sp.credits_subscription}}</td>
                                        <td>{{sp.subscription_quantity}}</td>
                                        <td @click="resign(sp)">RESIGN</td>
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
                                <img  class="img">
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
                                <img  class="img">
                            </div>
                            <h2 class="text-center">HUMAN RESOURCES</h2>
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
                                    <th>Data</th>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
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
                <li class="nav-item"><a aria-controls="supplies" aria-selected="true" class="nav-link" data-toggle="tab" href="#supplies" id="supplies-tab" role="tab">Head Office</a></li>
            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="work" role="tabpanel">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :alt="job.job_name" :src="job.icon" class="img">
                            </div>
                            <h2 class="text-center">Phone Seller Manager</h2>
                            <p v-html="job.job_description"></p>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Order from Suppliers</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
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
                            <h4>Credits</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price per credit</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                 <td></td>
                                <td>Credits</td>
                                <td>
                         <input @change="saveCredit()" class="form-control text-center" style="max-width: 8rem;" type="number" v-model="company.credits"></td>
                                <td class="text-danger pointer" @click="removeSaveCredit">Remove</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 <div class="card mb-4">
                        <div class="card-body">
                            <h4>Employee Request</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Employee</th>
                                    <th>Actions</th>
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
                            <h4>Credits Subscription</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                               <tr v-for="(sp,index) in subscription_plan" >
                                        <td>Icon</td>
                                        <td>Phone</td>
                                        <td>{{sp.credits_subscription}}</td>
                                        <td>{{sp.subscription_quantity}}</td>
                                        <td @click="creditSubManager(sp,index)" class="text-danger pointer">Remove</td>
                                    </tr>
                                <tr>
                                <td>Icon</td>
                                <td>Credit</td>
                        <td><input @change="saveCreditSubscription()" class="form-control text-center" style="max-width: 8rem;" type="number" v-model="company.creditSubcription"></td>
                                <td>
                                        <select v-model="selectedQunty" class="form-control" name="quantity">
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
                                <td @click="saveSubcriptionPlan()" class="text-success pointer">Add</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Credits Subscription Clients</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Daily Fees</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="sp in subscription_plan_buyer" >
                                        <td>{{sp.first_name+sp.last_name}}</td>
                                        <td>{{sp.credits_subscription}}</td>
                                        <td>{{sp.subscription_quantity}}</td>
                                        <td>RESIGN</td>
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
                            <h2 class="text-center">HUMAN RESOURCES</h2>
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
                                    <th>Data of Application</th>
                                    <th>Action</th>>
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
                            <h4>List of Employee</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Join Date</th>
                                    <th>Contract</th>
                                    <th>Action</th>
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
                                        <input class="form-control" readonly type="text" value="Phone Seller">
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
                            <h4>Items</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                <td>Icon</td>
                                <td>Phone</td>
                                       <td>
                         <input class="form-control text-center" style="max-width: 8rem;" type="number" v-model="keeper.quantity"></td>
                                <td>{{ownerCompany.credits}}</td>
                                <td @click="buyKeeper">Buy</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                     <div class="card mb-4">
                        <div class="card-body">
                            <h4>Credits</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Price per Credit</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                <td>Icon</td>
                                <td>Credit</td>
                                <td>{{ownerCompany.credits}}</td>
                                <td>
                                <select v-model="selectedQuntyKeeper" class="form-control" name="quantity">
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
                                <td @click="buyKeeperCredit">Buy</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  <div class="card mb-4">
                        <div class="card-body">
                            <h4>Subscriber</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Daily Fees</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="sp in subscription_plan" >
                                        <td>Icon</td>
                                        <td>Phone</td>
                                        <td>{{sp.credits_subscription}}</td>
                                        <td>{{sp.subscription_quantity}}</td>
                                        <td @click="buyKeeperSubscription(sp)">Buy</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
          </div>
        <div class="container-fluid p-0" v-else>

            <div class="card">
                <div class="card-body">

                    <h3>Phone Selller  Not Found</h3>
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
            offers:[],
            availabestock :[],
            // company: {
            //     credit: 0,
            //     creditSubcription: 0,
            //     charges: 0,
            // },
            company:[],
            subscription_quantity: 0,
            subscription_credits: 0,
            selectedQunty:'',
            keeper:{
          quantity:0
            },
            ownerCompany:[],
            selectedQuntyKeeper:'',
            subscription_plan:[],
            subscription_plan_buy:[],
            subscription_plan_buyer:[],
            

        }),
    
    async mounted() {
        console.log("saass");
            if (this.$route.params.keeper === undefined) {
                const {data} = await axios.post('/ajax/phoneSellerDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                
                console.log("data",data);
                this.is_doer = data.doer;
                this.job = data.job;
                this.owner = data.owner;
                this.employee_requests = data.employee_requests;
                this.company = data.company;
                this.offers = data.offers;
                this.availabestock = data.ingredients;
                if (data.doer == 2) {
                    this.applications = data.applications;
                    this.employees = data.employees;
                    this.supplies = data.supplies;
                    this.manager_stock = data.manager_stock;
                } else {
                    this.products = data.products;
                    this.manager = data.manager; 
                     this.keeperFront =  data.keeperFront;
                     console.log(this.keeperFront);
                }
                this.finance_report = data.finance_report;
                this.subscription_plan = data.subscription_plan;
                this.subscription_plan_buyer=data.subscription_plan_buyer;
            } else {
                console.log("ddd") 
                console.log("this.$route.params.id",this.$route.params.id);
                const {data} = await axios.post('/ajax/getPhoneSellerJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.keeper,
                    cerdit_id: user.character.id
                });
                
            console.log("datavister",data);
                if (data.doer == 3) {
                    this.is_doer = data.doer;
                    this.job = data.job;
                    this.owner = data.owner;
                    this.company = data.company;
                    this.visitor_requests = data.requests;
                    this.ownerCompany = data.ownerCompany;
                    this.subscription_plan = data.subscription_plan;
                    this.subscription_plan_buy = data.subscription_plan_buy;

                }
            }
        },
        methods: {
            // resign(obj){
            //          axios.post('/ajax/resignSubscription', {
            //          id:obj.id
            //     }).then(res => {
            //         alert('done');
            //     })
            // },
            creditSubManager(obj,index){
                console.log("obj",obj);
   axios.post('/ajax/removeSubManPhoneSeller', {
                     id:obj.id
                }).then(res => {
                    console.log("res",res.data.msg)
                    this.$delete(this.subscription_plan,index)
                    alert(res.data.msg);
                })
            },
            removeSaveCredit(){
                axios.post('/ajax/removeCompanyCredits', {
                    company_id: this.company.id,
                    credits: 0,
                }).then(res => {
                    this.company.credits = 0;
                    alert('done');
                })
            },
            buyKeeper(){
           console.log("qunaty",this.keeper.quantity);
           console.log("price",this.ownerCompany.credits);
           axios.post('/ajax/saveItemCreditSubscription', {
                    subscriptionQnty: this.keeper.quantity,
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.keeper,
                }).then(res => {
                    alert('done');
                })
            },
            buyKeeperCredit(){
          console.log("qunaty",this.selectedQuntyKeeper);
           console.log("price",this.ownerCompany.credits);
                      console.log("qunaty",this.keeper.quantity);
           console.log("price",this.ownerCompany.credits);
           axios.post('/ajax/buyKeeperCrdeit', {
                    Qnty: this.selectedQuntyKeeper,
                    credit:this.ownerCompany.credits,
                    ch_id: this.$route.params.keeper,
                }).then(res => {
                    alert('done');
                })
            },
            buyKeeperSubscription(object){
            console.log("obkect",object);
            console.log("user.character.id",user.character.id);
            console.log("id",this.owner.id)
            axios.post('/ajax/buyCreditSubscription', {
                    subscriptionCredit: object.credits_subscription,
                    subscriptionQnty: object.subscription_quantity,
                    job_id: this.$route.params.id,
                    ch_id: this.owner.id,
                    user_id:user.id
                }).then(res => {
                    console.log("res",res);
                    this.subscription_plan_buy = res.data.subscription_plan;
                    console.log(this.subscription_plan);
                    alert('done');
                })
            },
             saveCredit() {
                axios.post('/ajax/saveCompanyCredits', {
                    company_id: this.company.id,
                    credits: this.company.credits,
                }).then(res => {
                    alert('done');
                })
            },
            saveCreditSubscription() {
                this.subscription_credits = this.company.creditSubcription; 
            },

            saveSubcriptionPlan(){
             console.log(this.owner.id);
                axios.post('/ajax/saveCompanyCreditSubscription', {
                    company_id: this.company.id,
                    subscriptionCredit: this.subscription_credits,
                    subscriptionQnty: this.selectedQunty,
                    job_id: this.$route.params.id,
                    ch_id: user.character.id,
                    user_id:user.id
                }).then(res => {
                    this.subscription_plan = res.data.subscription_plan;
                   this.selectedQunty = '';
                    this.company.creditSubcription = '';
                    
                    alert('done');
                })
            },
            
         acceptOffer(offer) {
                let self = this;
                console.log("data",offer);
                axios.post('/ajax/actionFarmerOfferPhoneSeller', {
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
                        createItemRequest() {
                let self = this
                let data = $("#item-request-form").serialize();
                axios.post('/ajax/createPhoneSellerItemRequest', data)
                    .then(res => {
                        let data = res.data
                        self.employee_requests = data.employee_requests
                        alert(data.msg)
                    })
            },
             acceptRequest(object) {

                let self = this;
                axios.post('/ajax/phoneSellerRequestAction', {
                    action: 'accept',
                    request_id: object.id,
                    job_id: this.$route.params.id,
                    ch_id: user.character.id

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
              buy(object) {
                let self = this;
                axios.post('/ajax/PhoneSellerBuyProduct', {
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
             sendBonusToEmployee() {
                let self = this
                let data = $("#bonus-form").serialize()
                axios.post('/ajax/sendBonus', data)
                    .then(res => {
                        self.finance_report = res.data.finance_report
                        alert(res.data.msg)
                    })
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
