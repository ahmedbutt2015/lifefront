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
                            <div class="farmer-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">{{job.job_name}}</h2>
                            <p v-html="job.job_description"></p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Components of your Farm</h4>
                            <div class="row">
                                <div class="animal-box col-2" v-for="anm in farmer_animals">
                                    <div class="img-thumbnail">
                                        <img :src="anm.icon" :alt="anm.name" class="w-100">
                                    </div>
                                    <div class="animal-box-label" v-html="anm.name"></div>
                                    <div class="animal-box-quantity" v-html="anm.quantity"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Create Products</h4>
                            <div class="form-row">
                                <div class="col">
                                    <select class="form-control" v-model="create_product.product">
                                        <option selected disable>--list of product--</option>
                                        <option v-for="prd in products" :value="prd.id" v-html="prd.object_name"></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <!--                                    <input type="number" class="form-control" placeholder="Quantity" >-->
                                    <select class="form-control" name="quantity" v-model="create_product.quantity">
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
                                    <button class="genric-btn primary small" @click="startProduction()">Create</button>
                                </div>
                            </div>

                            <h4>Current Production</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="prd in current_production">
                                    <td><img :src="prd.icon" :alt="prd.name"></td>
                                    <td v-html="prd.name"></td>
                                    <td v-html="prd.quantity"></td>
                                    <td>{{prd.complete_in}} sec</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Send Products</h4>
                            <form action="" id="send-product-form" class="col-6" @submit="sendProduct()" v-on:submit.prevent>

                                <div class="form-group">
                                    <select class="form-control" name="product_id" required>
                                        <option v-for="prd in products" :value="prd.id">{{prd.object_name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
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
                                <div class="form-group">
                                    <select class="form-control" @change="getJobs()" v-model="client_type" required>
                                        <option disabled selected>--Client Type--</option>
                                        <option value="independent">Independent</option>
                                        <option value="corporate">Corporate</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" v-model="client_job_selected" @change="getClients()" required>
                                        <option v-for="job in client_job" :value="job.id" v-html="job.job_name"></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <model-select class="mb-4" :options="clients" v-model="client_selected" placeholder="Select Clients"></model-select>
                                </div>
                                <div class="form-group">
                                    <model-select class="mb-4" :options="delivery_companies" v-model="delivery_selected" placeholder="Delivery Man"></model-select>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="charges" v-model="deliveryCharges" class="form-control" placeholder="Delivery Fees" readonly required>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control" placeholder="Price per unit" required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="client_id" v-model="client_selected.value">
                                    <input type="hidden" name="delivery_id" v-model="deliveryID">
                                    <input type="hidden" name="farmer_id" v-model="farmer.id">
                                    <button class="genric-btn primary" type="submit">Send</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="accounts" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="farmer-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">Accounting</h2>
                            <p>Description....</p>
                            <p>Amount Available in Your Cashier: {{farmer.cash}}</p>
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
                            <div class="farmer-icon">
                                <img :src="job.icon" :alt="job.job_name" class="img">
                            </div>
                            <h2 class="text-center">Supplies</h2>
                            <p>Description....</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Available Farm Stock</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Product Name</th>
                                    <th>Available Quantity</th>
                                    <th>Production Time</th>
                                    <th>Expires</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in stock">
                                    <td><img :src="row.icon" :alt="row.name"></td>
                                    <td v-html="row.name"></td>
                                    <td v-html="row.quantity"></td>
                                    <td>{{row.production_time}} sec</td>
                                    <td>{{row.expire_in}} Days</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Animals Guide</h4>
                            <p>explanation text</p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Animal</th>
                                    <th>Number of Parts</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in animal_guide">
                                    <td><img :src="row.icon" :alt="row.object_name"></td>
                                    <td v-html="row.object_name"></td>
                                    <td>{{row.part.quantity}} {{row.part.name}}</td>
                                    <td>{{row.price}} MO</td>
                                    <td>
                                        <select class="form-control purchase_quantity" @change="changePurQty($event)">
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
                                        <button @click="buyAnimal(row.id)" class="genric-btn primary small">BUY</button>
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
                    <div class="farmer-icon">
                        <img :src="job.icon" :alt="job.job_name" class="img">
                    </div>
                    <h2 class="text-center">{{job.job_name}}</h2>
                    <p>Welcome to the Farm of {{farmer.first_name}} {{farmer.first_name}}</p>
                    <p>You can find below all the animals that are living in this farm.</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="text-center">The Farm</h4>

                    <div class="row">
                        <div class="animal-box col-2" v-for="anm in farmer_animals">
                            <div class="img-thumbnail">
                                <img :src="anm.icon" :alt="anm.name" class="w-100">
                            </div>
                            <div class="animal-box-label" v-html="anm.name"></div>
                            <div class="animal-box-quantity">
                                <button class="genric-btn info small circle" @click="caress(anm)">Caress</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Farmer",
        data: () => ({
            is_doer: null,
            job: {
                job_name: 'Farmer',
                job_description: '',
                icon: '',
            },
            farmer: {
                cash: 0,
            },
            animal_guide: [],
            products: [],
            farmer_animals: [],
            create_product: {
                product: null,
                quantity: null,
                farmer: null
            },
            current_production: [],
            finance_report: [],
            stock: [],
            purchase_quantity: 1,
            client_type: '',
            client_job: [],
            delivery_companies: [],
            client_job_selected: 0,
            clients: [],
            delivery_selected: {
                value: null,
                text: null,
            },
            client_selected: {
                value: null,
                text: null,
            }
        }),
        async mounted() {

            console.log(this.$route.params.farmer)
            if (this.$route.params.farmer === undefined) {
                this.is_doer = true;
                const {data} = await axios.post('/ajax/getFarmerJobDetails', {
                    job_id: this.$route.params.id,
                    ch_id: user.character.id
                });
                console.log("data",data);
                this.job = data.job;
                this.is_doer = data.is_doer;
                this.farmer = data.farmer;
                this.animal_guide = data.animals;
                this.products = data.products;
                // console.log("this.products",this.products);
                this.farmer_animals = data.farmer_animals;
                this.current_production = data.current_production;
                this.delivery_companies = data.delivery_companies;
                this.finance_report = data.finance_report;
                this.stock = data.stock;
                var self = this;
                setInterval(function () {

                    // console.log(self.current_production)
                    for (let index in self.current_production) {
                        if (self.current_production[index].complete_in > 0) {
                            self.current_production[index].complete_in--
                        } else {
                            axios.post('/ajax/completeProduction', {
                                stock_id: self.current_production[index].id,
                            }).then(res => {
                                let data = res.data
                                self.current_production = data.current_production
                                self.stock = data.stock

                            }).catch(error => {
                                console.log(error)
                            })
                        }
                    }
                }, 1000);

            } else {
                this.is_doer = false;
                const {data} = await axios.post('/ajax/getFarmerJobDetailsForVisitor', {
                    job_id: this.$route.params.id,
                    farmer: this.$route.params.farmer,
                });
                this.job = data.job;
                this.farmer = data.farmer;
                this.farmer_animals = data.farmer_animals;
            }
        },
        methods: {
            startProduction() {
                this.create_product.farmer = this.farmer.id;
                let data = this.create_product;
                axios.post('/ajax/startProduction', data)
                    .then(res => {
                        let data = res.data;
                        this.current_production = data.current_production
                        this.farmer_animals = data.farmer_animals
                        alert(data.msg)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            sendProduct(event) {
                let data = $("#send-product-form").serialize();

                axios.post('/ajax/farmerSendProduct', data)
                    .then(res => {
                        $("#send-product-form").resetForm()
                        alert(res.data.msg)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            changePurQty($event) {
                console.log($($event.target).val())
                this.purchase_quantity = $($event.target).val()
            },
            buyAnimal(id) {
                axios.post('/ajax/buyAnimal', {id: id, qty: this.purchase_quantity, farmer: this.farmer.id})
                    .then(res => {
                        let data = res.data;
                        this.farmer_animals = data.farmer_animals
                        $('.purchase_quantity').val(1);
                        alert(data.msg)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            caress(animal) {
                alert('successful')
            },
            getJobs() {
                axios.post('/ajax/getJobs', {type: this.client_type})
                    .then(res => {
                        let data = res.data;
                        this.client_job = data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getClients() {
                axios.post('/ajax/getCharactersByJob', {id: this.client_job_selected})
                    .then(res => {
                        let data = res.data;
                        this.clients = data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
        },
        computed: {
            deliveryCharges() {
                if (this.delivery_selected.value) {
                    let value = this.delivery_selected.value.split('-');
                    console.log(value)
                    return parseFloat(value[1])
                }
                return 0;
            },
            deliveryID() {
                if (this.delivery_selected.value) {
                    let value = this.delivery_selected.value.split('-');
                    return parseFloat(value[0])
                }
                return 0;
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
    .animal-box {
        width:      100%;
        text-align: center;
    }

    .animal-box-label {

    }

    .animal-box-quantity {
    }

    .farmer-icon {
        position: absolute;
        width:    6%;
        height:   auto;
    }

    .farmer-icon img {
        width: 100%;
    }

    @media (min-width: 576px) {
        .farmer-icon {
            width: 10%;
        }
    }

    @media (min-width: 768px) {
        .farmer-icon {
            width: 6%;
        }
    }

    @media (max-width: 576px) {

    }
</style>
