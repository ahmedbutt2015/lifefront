<template>
    <section>
   
    <FlashMessage></FlashMessage>
        <section class="all-starups-area">

            <div v-if="this.character.partners != false" class="container-fluid p-0 ">

                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="partner-tab" data-toggle="tab" href="#partner"
                        role="tab" aria-controls="partner" aria-selected="true">My Partner</a></li>
                    <li class="nav-item"><a class="nav-link" id="relationship-tab" data-toggle="tab" href="#relationship"
                        role="tab" aria-controls="relationship" aria-selected="true">Relationship</a></li>
                    <li class="nav-item"><a class="nav-link" id="children-tab" data-toggle="tab" href="#children"
                        role="tab" aria-controls="children" aria-selected="true">Children</a></li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="partner" role="tabpanel">
                        <div class="sample-text-area">
                            <div class="container-fluid">


                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="/images/default-character.png" class="img" alt="">
                                    </div>
                                    <div class="col">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr>
                                                <th>Perso Name:</th>
                                                <td>{{partner.first_name +" " + partner.last_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Joined the city:</th>
                                                <td>{{partner.created_at}}</td>
                                            </tr>
                                            <tr>
                                                <th>Age:</th>
                                                <td>{{partner.age}}</td>
                                            </tr>
                                            <tr>
                                                <th>Current Job:</th>
                                                <td>{{partner.job}}</td>
                                            </tr>

                                            <tr>
                                                <th>Sexual Orientation:</th>
                                                <!--                                                <td v-if="isOwner()">-->
                                                <!--                                                    <select class="form-select" name="gender" v-model="character.gender">-->
                                                <!--                                                        <option v-for="g in this.gender_dropdown" :value="g.slug" :selected="character.gender == g.slug ? true  : false">{{g.title}}</option>-->
                                                <!--                                                    </select>-->
                                                <!--                                                </td>-->
                                                <!-- todo: slug to title -->
                                                <!--                                                <td v-else v-html="character.gender"></td>-->
                                                <td v-html="partner.gender"></td>
                                            </tr>
                                            <tr>
                                                <th>Family Situation:</th>
                                                <!--                                                <td v-if="isOwner()">-->
                                                <!--                                                    <select class="form-select" name="marriage_status" v-model="character.marriage_status">-->
                                                <!--                                                        <option v-for="f in this.family_situation_dropdown" :value="f.slug" :selected="character.marriage_status == f.slug ? true  : false">{{f.title}}</option>-->
                                                <!--                                                    </select>-->
                                                <!--                                                </td>-->
                                                <!--                                                &lt;!&ndash; todo: slug to title &ndash;&gt;-->
                                                <!--                                                <td v-else v-html="character.marriage_status"></td>-->
                                                <td v-html="partner.marriage_status"></td>
                                            </tr>
                                            <tr>
                                                <th>Pocket Amount:</th>
                                                <td>{{partner.cash}}</td>
                                            </tr>
                                            <tr>
                                                <th>Music of the moment:</th>
                                                <td>Coming Soon</td>
                                            </tr>
                                            <tr>
                                                <th>Current Mood:</th>
                                                <!--                                                <td v-if="isOwner()">-->
                                                <!--                                                    <select class="form-select" name="mood" v-model="character.mood">-->
                                                <!--                                                        <option v-for="m in this.mood_dropdown" :value="m.slug" :selected="character.mood == m.slug ? true  : false">{{m.title}}</option>-->
                                                <!--                                                    </select>-->
                                                <!--                                                </td>-->
                                                <!--                                                &lt;!&ndash; todo: slug to title &ndash;&gt;-->
                                                <!--                                                <td v-else v-html="character.mood"></td>-->
                                                <td v-html="partner.mood"></td>
                                            </tr>
                                            <tr>
                                                <th>Role Play Player:</th>
                                                <!--                                                <td v-if="isOwner()">-->
                                                <!--                                                    <select class="form-select" name="role" v-model="character.role">-->
                                                <!--                                                        <option v-for="r in this.role_dropdown" :value="r" :selected="character.role == r ? true  : false">{{r}}</option>-->
                                                <!--                                                    </select>-->
                                                <!--                                                </td>-->
                                                <!--                                                &lt;!&ndash; todo: slug to title &ndash;&gt;-->
                                                <!--                                                <td v-else v-html="character.role"></td>-->
                                                <td v-html="partner.role"></td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <!--                                                <td v-if="isOwner()">-->
                                                <!--                                                    <input type="text" name="user_status" class="form-control" value="xxx">-->
                                                <!--                                                </td>-->
                                                <!--                                                &lt;!&ndash; todo: slug to title &ndash;&gt;-->
                                                <!--                                                <td v-else v-html="character.user_status"></td>-->
                                                <td v-html="partner.user_status"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <p>Married since : {{partner.married_since}}</p>
                            </div><!--end container-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="relationship" role="tabpanel">
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>some description .......</p>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4>Intimate Relations</h4>
                                <form id="intimate-request-form">
                                    <input type="hidden" name="partner_id" v-model="partner.id">
                                    <input type="hidden" name="id" v-model="character.id">
                                    <div class="form-row">
                                        <b class="col form-row">

                                            <div class="confirm-radio">
                                                <input type="radio" name="with" id="with" value="1" checked>
                                                <label for="with"></label>
                                            </div>
                                            <span class="ml-2" style="line-height: 1">With Condoms</span>
                                        </b>
                                        <b class="col form-row">

                                            <div class="confirm-radio">
                                                <input type="radio" name="with" id="without" value="0">
                                                <label for="without"></label>
                                            </div>
                                            <span class="ml-2" style="line-height: 1">Without Condoms</span>
                                        </b>
                                        <div class="col">
                                            <!-- todo make max work by force -->
                                            <select class="form-control" name="qty">
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
                                            <!--                                            <input type="number" class="form-control" placeholder="Quantity" max="10" >-->
                                        </div>

                                        <button type="button" @click="requestIntimate()" class="genric-btn primary small">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4>Intimate Relations</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="intimate in intimate_list">
                                        <td>{{intimate.created_at}}</td>
                                        <td>
                                            <router-link class="text-primary" :to="intimate.sender_link">{{intimate.sender}}</router-link>
                                        </td>
                                        <td>
                                            <router-link class="text-primary" :to="intimate.receiver_link">{{intimate.receiver}}</router-link>
                                        </td>
                                        <td>{{intimate.quantity}}</td>
                                        <td v-if="intimate.requested_to == character.id && intimate.status =='pending'">
                                            <span class="text-success pointer" @click="acceptIntimate(intimate)">ACCEPT</span>
                                            /
                                            <span class="text-danger pointer" @click="rejectIntimate(intimate)">REJECT</span>
                                        </td>
                                        <td v-else-if="intimate.status =='accepted'">
                                            <span class="text-success">ACCEPTED</span>
                                        </td>
                                        <td v-else-if="intimate.status =='rejected'">
                                            <span class="text-danger">REJECTED</span>
                                        </td>
                                        <td v-else>
                                            Wait for response
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="children" role="tabpanel">
                        <div class="sample-text-area">
                            <div class="container-fluid">

                                <p>some description .......</p>

                                <section class="mb-20" v-for="child in children_list">
                                    <div class="row mb-10">
                                        <div class="col-4 img-thumbnail">
                                            <img src="" alt="img">
                                        </div>
                                        <div class="col-1">
                                        </div>
                                        <div class="col">

                                            <div class="form-row" v-if="child.age == 0">
                                                <div class="col"><b>Child Name: </b></div>
                                                <div class="col"><input type="text" v-model="child.first_name" class="form-control" placeholder="First Name"></div>
                                                <div class="col">
                                                    <select name="last_name" class="form-control" v-model="child.last_name">
                                                        <option :value="character.last_name" v-html="character.last_name"></option>
                                                        <option :value="partner.last_name" v-html="partner.last_name"></option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <button @click="saveChildName(child)" class="genric-btn success circle small">Save</button>
                                                </div>
                                            </div>

                                            <div v-else><b>Child Name: </b> {{ child.first_name }} {{ child.last_name }}</div>
                                            <div><b>Gender: </b> {{child.gender}}</div>
                                            <div><b>Age: </b> {{child.age}} YO</div>
                                            <br>
                                            <div v-if="child.age != 0">
                                                <div class="row mb-20">
                                                    <div class="col-4" v-for="indication in child.indications">
                                                        <div class="property">
                                                            <div><b class="number">{{indication.points}}</b><span class="scale">pts</span></div>
                                                            <p class="name">{{indication.english_name}}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div v-else>
                                                <div class="row mb-20">
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                </div>
                                                <div class="row mb-20">
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                    <div class="property">
                                                        <div><b class="number"> N/A </b></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="child.age != 0">
                                        <div class="col">
                                            <div class="action-box img-thumbnail pointer" @click="do_feed(child)">
                                                <img src="" alt="Feed" class="img">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="action-box img-thumbnail pointer" @click="do_drink(child)">
                                                <img src="" alt="Drink" class="img">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="action-box img-thumbnail pointer" @click="do_urinate(child)">
                                                <img src="" alt="Urinate" class="img">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="action-box img-thumbnail pointer" @click="do_poop(child)">
                                                <img src="" alt="poop" class="img">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="action-box img-thumbnail pointer" @click="do_shower(child)">
                                                <img src="" alt="shower" class="img">
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div v-else class="sample-text-area w-100" >
                <h3>Send Request For Marriage</h3>

                <div class="form-row positionset">
                    <div class="col">
                        <model-select :options="requestables" v-model="request_to" placeholder="Select Character to request"></model-select>
                    </div>
                    <div class="col-1">
                        <button @click="sendRequest()"  class="genric-btn primary-border medium">Send</button>
                    </div>
                </div>
            </div>


        </section>
    </section>
</template>

<script>

    export default {
   
        props: {},
        data: () => ({
            character: {},
            requestables: [],
            gender_dropdown: [],
            family_situation_dropdown: [],
            mood_dropdown: [],
            role_dropdown: [],
            job_dropdown: [],
            partner: {},
            intimate_list: [],
            children_list: null,
            request_to: {
                value: '',
                text: '',
            },
            
        }),

        async mounted() {
            this.init()
        },

        methods: {
            async init() {
                const {data} = await axios.post('/ajax/getFamilyDetails');
                this.character = data.character;
                this.intimate_list = data.intimates;
                if (!data.character.partners) {
                    const {data} = await axios.post('/ajax/getMarriageableCharacters');
                    this.requestables = data;
                } else {
                    this.partner = data.character.partners[0];
                    this.children_list = data.character.children_list;
                }
            },
            sendRequest() {
                console.log("aaa");
                
                let ID = this.request_to.value;
                axios.post('/ajax/addMarriageRequest', {id: ID})
                    .then(res => {
                                              
                        console.log("res",res)
                        if (res.data.status == 'ok') {
                            $("#req-" + ID).html('sent').attr('disabled', true).addClass('success disable').removeClass('primary-border');
                        }
                        // alert(res.data.msg) 
                                      this.flashMessage.show(
                {
                  status: 'success',
                  title: 'Success Message',
                  time: 3000,
                  message: res.data.msg,
                   blockClass: 'custom-block'
                }
              )
            
                    }).catch(error => {
                    
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
            requestIntimate() {
                if (this.canSendRequestForIntimate) {
                    let data = $('#intimate-request-form').serialize()
                    axios.post('/ajax/addIntimateRequest', data)
                        .then(res => {
                            this.intimate_list = res.data
                            alert("Added successfully")
                        })
                        .catch(error => {
                            alert("failed to save try later");
                            console.log(error.response)
                        })
                } else {
                    alert('You cant request for intimate right now try later.')
                }
            },
            acceptIntimate(intimate) {
                axios.post('/ajax/intimateAction', {do: 'accept', id: intimate.id})
                    .then(res => {
                        intimate.status = 'accepted'
                        alert(res.data.msg);
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            rejectIntimate(intimate) {
                axios.post('/ajax/intimateAction', {do: 'reject', id: intimate.id})
                    .then(res => {
                        intimate.status = 'rejected'
                        alert(res.data.msg);
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            saveChildName(child) {
                axios.post('/ajax/saveChildName', child)
                    .then(res => {
                        alert('Name Saved Successfully')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            do_feed(child) {
                axios.post('/ajax/childrenFeed', {child_id: child.id})
                    .then(res => {
                        child.indications = res.data.indications;
                        alert('done!')
                    })
                    .catch(error => {
                        alert('Later')
                    })
            },
            do_drink(child) {
                axios.post('/ajax/childrenDrink', {child_id: child.id})
                    .then(res => {
                        child.indications = res.data.indications;
                        alert('done!')
                    })
                    .catch(error => {
                        alert('Later')
                    })
            },
            do_urinate(child) {
                axios.post('/ajax/childrenUrinate', {child_id: child.id})
                    .then(res => {
                        child.indications = res.data.indications;

                        alert('done!')
                    })
                    .catch(error => {
                        alert('Later')
                    })
            },
            do_poop(child) {
                axios.post('/ajax/childrenPoop', {child_id: child.id})
                    .then(res => {
                        child.indications = res.data.indications;

                        alert('done!')
                    })
                    .catch(error => {
                        alert('Later')
                    })
            },
            do_shower(child) {
                axios.post('/ajax/childrenShower', {child_id: child.id})
                    .then(res => {
                        child.indications = res.data.indications;

                        alert('done!')
                    })
                    .catch(error => {
                        alert('Later')
                    })
            }
        },
        computed: {
            canSendRequestForIntimate() {
                let list = this.intimate_list;
                if (!list) {
                    return true;
                }
                const filter = list =>
                    list.status == 'pending'

                let remaining = list.filter(filter)

                if (remaining.length > 0) {
                    return false
                }
                return true;
            },
            childWithAge() {
                let children = this.children_list;
                if (!children) {
                    return children;
                }
                const filter = child =>
                    child.age > 0

                return children.filter(filter)
            }
        }
    }

</script>

<style scoped>
    .action-box {
        height: 12rem;
    }


    .property {
        color:       #FFFFFF;
        width:       7rem;
        height:      6rem;
        padding:     6px;
        background:  grey;
        margin-left: 1rem;
        text-align:  center;
    }


    /*.property:first-child {*/
    /*    margin-left: auto;*/
    /*}*/

    /*.property:last-child {*/
    /*    margin-right: auto;*/
    /*}*/

    .number {
        font-size:   2.7rem;
        color:       #FFFFFF;
        line-height: 1;
    }

    .scale {
        font-size: 1.4rem;
    }

    .name {
        margin:      0;
        font-size:   1.2rem;
        color:       #FFFFFF;
        line-height: 1.8;
        text-align:  center;
    }

    ._tool-bar button {
        text-align: center;
        padding:    2px 8px;
    }

    .action-box {
        height: 7rem;
    }
    .positionset{
        position: relative;
    }
    .custom-block{
        z-index:999;

    }
</style>
