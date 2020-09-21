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
                            <p>Set your trash points price:<span>[ ] MQ</span></p>
                    
                        <div>
                            <h4>Orders from Suppliers</h4>
                            <table class="table">
                                <thead class="table-color">
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
                                 <tr>
                                     <td>icon</td>
                                     <td>Product</td>
                                     <td>0.50</td>
                                     <td>20</td>
                                     <td>10.00</td>
                                     <td>PAY/REJECT</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                         <div>
                            <h4>Employees Requests</h4>
                            <table class="table">
                                <thead class="table-color">
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                     <td>Product</td>
                                     <td>20</td>
                                     <td>John</td>
                                     <td>PAY/REJECT</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                                                 <div>
                            <h4>Stock Available</h4>
                            <table class="table">
                                <thead class="table-color">
                                <tr>
                                    <th>Icon</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                     <td>Product</td>
                                     <td>20</td>
                                     <td>John</td>
                                     <td>DROPDOWN</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
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
                            <p>Welcome to the Account Office.</p>
                            <p>This is where you have to your shop accounting....</p>
                            <p>Amount Available In Your Account<span>1245.49 MQ</span></p>
                             <div>
                            <table class="table">
                                <thead class="table-color">
                                <tr>
                                    <th>Data</th>
                                    <th>Revenues</th>
                                    <th>Expeness</th>
                                    <th>Commission</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="supplies" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="job-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">HUMAN RESOURCES</h2>
                            <p>Welcome to the HR Office.</p>
                            <p>This is where you will manage all your employees. </p>
                    <div>
                        <h3>Job Applications </h3>
                            <table class="table">
                                <thead class="table-color">
                                <tr>
                                    <th>Candidate Name </th>
                                    <th>Date of Application</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                     <td>jjhon</td>
                                     <td>01/02/2020</td>
                                     <td>Accept/REJECT</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                    <div>
                        <h3>List of Employees  </h3>
                            <table class="table">
                                <thead class="table-color">
                                <tr>
                                    <th>ID</th>
                                    <th>Employee Name </th>
                                    <th>Join Date</th>
                                    <th>Contract</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                     <td></td>
                                     <td>Bill GATES</td>
                                     <td>22/03/2020</td>
                                     <td>12 days</td>
                                     <td class="garge-action">FIRE</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                          <div>
                              <h3>Post Job Offer</h3>
                        <form id="restaurant-produce-form">
                            <div class="card-body form-row">
                                <div class="col-3">
                                 <input class="form-control" type="text" placeholder="Commission"/>
                                </div>
                                  <div class="col-3">
                                 <input class="form-control" type="text" placeholder="ShopKeeper "/>
                                </div>
                                <div class="col-3">
                                 <input class="form-control" type="text" placeholder="Contract"/>
                                </div>
                                <div class="col">
                                    <button type="button" class="genric-btn primary medium">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>
                       <div>
                              <h3>Send Bonus</h3>
                        <form id="restaurant-produce-form">
                            <div class="card-body form-row">
                                <div class="col-4">
                                    <select class="form-control inputDropdown"  name="quantity">
                                        <option value="" disabled selected hidden>-- Employees List -</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                  <div class="col-4">
                                    <input class="form-control" type="text" placeholder="Amount"/>
                                </div>
                                <div class="col">
                                    <button type="button" class="genric-btn primary medium">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                    <p>Welcome to the restaurant.</p>
                    <p>You will find all the necessary products for your character, the children as well as the house.</p>
                    <p>Be aware that VAT may be applicable when paying for your purchases.</p>
                    <p>Enjoy your meal.</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">Available Plates</h4>
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
                            <td><img :src="object.icon" :alt="object.object_name"></td>
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
                            <th>+ VAT(0%)</th>
                            <th>0 MO</th>
                        </tr>

                        <tr>
                            <th colspan="3"></th>
                            <th>TOTAL</th>
                            <th>{{subtotal}} MO</th>
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
                    <h4 class="text-center">Your Table</h4>
                    <p>Once you have paid the plates, the list will appear here. All item bought in a restaurant are to be consumed in the restaurant.</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="dish in on_table">
                            <td><img :src="dish.icon" :alt="dish.object_name"></td>
                            <td>{{dish.object_name}}</td>
                            <td>{{dish.quantity}}</td>
                            <td>
                                <button class="genric-btn primary medium" @click="consume(dish)">Consume</button>
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
                job_name: 'Restaurant Keeper',
                job_description: '',
                icon: '',
            },
            owner: {},
            finance_report: [],
            ingredients: [],
            dishes: [],
            in_process: [],
            offers: [],
            back_shop: [],
            front_shop: [],
            client_order: [],
            on_table: [],
        }),
        async mounted() {
            if (this.$route.params.keeper === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getRestaurantJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                this.job = data.job;
                this.owner = data.owner;
                this.ingredients = data.ingredients;
                this.offers = data.offers;
                this.dishes = data.dishes;
                this.in_process = data.in_process;
                this.back_shop = data.back_shop;
                this.front_shop = data.front_shop;
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

            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getRestaurantJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    ch_id: this.$route.params.keeper
                });
                this.job = data.job;
                this.owner = data.owner;
                this.front_shop = data.front_shop;

            }
        },
        methods: {
            getStockForRecipe(ing, part) {
                for (let index in part) {
                    part[index].id
                    if (ing.id == part[index].id) {
                        return part[index].pivot.quantity
                    }
                }
                return 0;
            },
            refreshProduction(index) {
                let self = this;
                axios.post('/ajax/restaurantRefreshProduction', {id: self.owner.id, product_id: self.in_process[index].product_id})
                    .then(res => {
                        let data = res.data;
                        self.in_process = data.in_process;
                        self.back_shop = data.back_shop;
                    }).catch(error => {
                    console.log(error.response)
                })
            },
            acceptOffer(offer) {
                let self = this;
                axios.post('/ajax/actionFarmerOffer', {
                    action: 'accept',
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
            startProduction() {
                let self = this;
                let data = $('#restaurant-produce-form').serialize();
                axios.post('/ajax/restaurantStartProduction', data)
                    .then(res => {
                        let data = res.data;
                        if (data.status == 'ok') {
                            self.ingredients = data.ingredients;
                            self.in_process = data.in_process;
                        } else {
                            alert("Low Stock");
                        }
                    }).catch(error => {
                    console.log(error.response)
                })
            },
            saveObjectPrice(object) {
                let self = this;

                axios.post('/ajax/saveDishPrice', {
                    id: object.id,
                    price: object.price,
                }).then(res => {
                    alert('saved')
                }).catch(error => {
                    console.log(error.response)
                })
            },
            putObjectFront(object) {
                let self = this;
                if (object.quantity >= object.put) {
                    axios.post('/ajax/putDish', {
                        ch: self.owner.id,
                        id: object.product_id,
                        current: object.quantity,
                        qty: object.put,
                        place: 'front'
                    }).then(res => {
                        let data = res.data;
                        self.back_shop = data.back_shop
                        self.front_shop = data.front_shop
                        alert(data.msg)
                    }).catch(error => {
                        console.log(error.response)
                    })
                } else {
                    alert("You cannot put quantity in sales greater than you have.")
                }
            },
            putObjectBack(object) {
                let self = this;
                if (object.quantity >= object.put) {
                    axios.post('/ajax/putDish', {
                        ch: self.owner.id,
                        id: object.product_id,
                        current: object.quantity,
                        qty: object.put,
                        place: 'back'
                    }).then(res => {
                        let data = res.data;
                        self.back_shop = data.back_shop
                        self.front_shop = data.front_shop
                        alert(data.msg)
                    }).catch(error => {
                        console.log(error.response)
                    })
                } else {
                    alert("You cannot put quantity back greater than you have.")
                }
            },
            addInCashier(object) {
                if (object.quantity >= object.put) {
                    let temp = Object.assign({}, object)
                    temp.quantity = object.put
                    object.quantity -= object.put
                    this.client_order.push(temp)
                } else {
                    alert("You cannot put front more than quantity avaliable")
                }

            },
            pay() {

                let self = this;
                if (self.client_order.length) {
                    if (this.$root.user.character.cash >= this.subtotal) {
                        let id = this.$root.user.character.id
                        let cash = this.$root.user.character.cash - self.subtotal;
                        let owner_id = this.$route.params.keeper
                        axios.post('/ajax/buyDish', {id: id, owner_id: owner_id, cash: cash, total: self.subtotal, order: self.client_order}
                        ).then(res => {
                            self.$root.user.character.cash -= self.subtotal
                            self.on_table = Object.assign([], self.client_order);
                            self.client_order = [];
                        }).catch(error => {
                            console.log(error)
                        })

                    } else {
                        alert("Not enough cash")
                    }
                }

            },
            consume(dish) {
                let index = this.on_table.indexOf(dish)
                let self = this;
                let id = this.$root.user.character.id
                axios.post('/ajax/eatDish', {id: id, product_id: dish.product_id}
                ).then(res => {
                    self.on_table.splice(index, 1)
                    alert('Hunger decreased');
                }).catch(error => {
                    console.log(error)
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
    .table-color{
        background-color: violet;
    }
    .garge-action{
        color: red;
    }
    .inputDropdown{
    -webkit-appearance: none;
    -moz-appearance: none;
    border: none;
    }
    /* select{
    text-align-last:right;
    padding-right: 29px;
    direction: rtl;
} */
</style>
