<template>
    <section>
        <section class="all-starups-area">

            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="row">
                                <div class="property" v-for="indication in city.indications">
                                    <div><b class="number">{{indication.points}}</b><span class="scale">pts</span></div>
                                    <p class="name">{{indication.english_name}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <p>Welcome to district of {{city.neighbourhood_name}}</p>
                            <p>The current district mayor is : abc</p>
                            <div>
<!--                                <button class="genric-btn primary medium"></button>-->

                                <div class="genric-btn">
                                    <button class="genric-btn primary medium dropdown-toggle" type="button"
                                        id="" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                        <router-link :to="'/city/'+$root.user.character.prefix+'/employee_center'" class="dropdown-item">
                                            Employment Center
                                        </router-link>
                                    </div>
                                </div>


                                <button class="genric-btn primary medium" style="margin-left: 5px"
                                        v-for="place in city.places">{{place.place_name}}
                                </button>

                                <div class="genric-btn">
                                    <button class="genric-btn primary medium dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        {{city.neighbourhood_name}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" @click="changeCity(neighbourhood)"
                                                v-for="neighbourhood in neighbourhoods">
                                            {{neighbourhood.neighbourhood_name}}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Gender</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Job</th>
                            <th>Mood</th>
                            <th>Interactions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ch in online">
                            <td>{{ch.gender}}</td>
                            <td>
                                <router-link class="text-primary" :to="getProfileLink(ch)">{{ch.first_name}}
                                    {{ch.last_name}}
                                </router-link>
                            </td>
                            <td>{{ch.age}}</td>
                            
                            <td>
                                <span v-if="selfCharacter === ch.user_id">
                        <router-link  class="text-primary" :to="getJobLinkOwn(ch)">{{ch.job_name}}</router-link>
                                </span>
                                <span v-else>
                    <router-link  class="text-primary" :to="getJobLink(ch)">{{ch.job_name}}</router-link>
                                </span>
                            </td>
                            <td>{{ch.mood}}</td>
                            <td>
                                <button class="genric-btn info small" @click="interaction(ch)">Actions</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="ask" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">

                                Your are about to enter a dark district! <br>
                                <span class="text-danger">Are you sure you want to proceed?</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-10">
                                    Yes! I want to go to this district. <br>
                                    <small>You will lose (X) life points</small>
                                </div>
                                <div class="col"><input type="radio" value="1" name="ask" v-model="answer"></div>
                            </div>
                            <div class="form-row">
                                <div class="col-10">No! I want to go back.</div>
                                <div class="col"><input type="radio" value="0" name="ask" v-model="answer"></div>
                            </div>
                            <div class="form-row">
                                <div class="col-10">I just want to create my own mafia gang.</div>
                                <div class="col"><input type="radio" value="2" name="ask" v-model="answer"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="move()" class="genric-btn circle primary medium"
                                    data-dismiss="modal">Move
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="interaction-modal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Interaction to {{interaction_character.name}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row col-lg-12">
                                <div class="row col-lg-6"  style="margin-bottom: 5px"   v-for="ac in action_list">
                                        <div class="">
                                            <img :src="ac.icon" alt="" class="" height="80" style="width: 5rem">
                                        </div>
                                        <div class="" style="margin-left: 6px" >
                                            <button style="height: 80px" class="genric-btn primary" data-dismiss="modal"
                                                    @click="doInteraction(ac)">{{ac.action_name}}
                                            </button>
                                        </div>
                                </div>
                            </div>
                        </div>
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
            answer: 0,
            city: [],
            online: [],
            action_list: [],
            neighbourhoods: [],
            selectedNB: 0,
            interaction_character: {
                id: '',
                name: '',
                action_id: '',
            },
            selfCharacter:"",
        }),

        async mounted() {
            console.log("this.$root.user.character",this.$root.user.character);
            this.selfCharacter = this.$root.user.character.user_id;
            const {data} = await axios.post('/ajax/getCityDetails', {id: this.$root.user.character.neighbourhood_id});
            console.log("data",data);
            // prefix
            this.city = data.city;
            data.online.forEach(element => {
                if(this.$root.user.character.prefix == element.prefix){
                    this.online.push(element);
                }
            });
            // this.online = data.online;
            this.neighbourhoods = data.neighbourhoods
            this.action_list = data.actions
        },
        methods: {
            getJobLink(ch) {
                if (ch.job) {
                    let job = ch.job_name.toLowerCase();
                    if (job.includes('farmer')) {
                        return "/city/" + ch.prefix + "/farmer/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('restaurant')) {
                        return "/city/" + ch.prefix + "/restaurant/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('delivery')) {
                        return "/city/" + ch.prefix + "/delivery/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('shopkeeper')) {
                        return "/city/" + ch.prefix + "/shopkeeper/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('dustman')) {
                        return "/city/" + ch.prefix + "/dustman/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('sport')) {
                        return "/city/" + ch.prefix + "/sportcoach/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('practitioner')) {
                        return "/city/" + ch.prefix + "/doctor/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('pharmacist')) {
                        return "/city/" + ch.prefix + "/pharmacist/" + ch.job + "/visitor/" + ch.id;
                    }

                    if (job.includes('journalist')) {
                        return "/city/" + ch.prefix + "/journalist/" + ch.job + "/visitor/" + ch.id;
                    }
                    if (job.includes('phone')) {
                        return "/city/" + ch.prefix + "/phoneseller/" + ch.job + "/visitor/" + ch.id;
                    }
                }
                return ''
            },
             getJobLinkOwn(ch) {
                 console.log("xzczc");
                if (ch.job) {
                    let job = ch.job_name.toLowerCase();
                    if (job.includes('farmer')) {
                        return "/city/" + ch.prefix + "/farmer/" + this.$root.user.character.job;
                    }

                    if (job.includes('restaurant')) {
                        return "/city/" + ch.prefix + "/restaurant/" + this.$root.user.character.job;
                    }

                    if (job.includes('delivery')) {
                        return "/city/" + ch.prefix + "/delivery/" + this.$root.user.character.job;
                    }

                    if (job.includes('shopkeeper')) {
                        return "/city/" + ch.prefix + "/shopkeeper/" + this.$root.user.character.job;
                    }

                    if (job.includes('dustman')) {
                        return "/city/" + ch.prefix + "/dustman/" + this.$root.user.character.job;
                    }

                    if (job.includes('sport')) {
                        return "/city/" + ch.prefix + "/sportcoach/" + this.$root.user.character.job;
                    }

                    if (job.includes('practitioner')) {
                        return "/city/" + ch.prefix + "/doctor/" + this.$root.user.character.job;
                    }

                    if (job.includes('pharmacist')) {
                        return "/city/" + ch.prefix + "/pharmacist/" + this.$root.user.character.job;
                    }

                    if (job.includes('journalist')) {
                        return "/city/" + ch.prefix + "/journalist/" + this.$root.user.character.job;
                    }
                    if (job.includes('phone')) {
                        return "/city/" + ch.prefix + "/phoneseller/" + this.$root.user.character.job;
                    }
                }
                return ''
            },
            getProfileLink(ch) {
                return "/city/" + ch.prefix + "/" + ch.address;
            },
            move() {
                if (this.answer != 0) {
                    axios.post('/ajax/changeNeighbourhood', {
                        id: this.$root.user.character.id,
                        neighbourhood_id: this.selectedNB
                    })
                        .then(
                            res => {
                                if (res.data == 1)
                                    location.reload()

                            }
                        )
                        .catch(
                            error => {
                                console.log(error)
                            }
                        )
                }
            },
            changeCity(neighbourhood) {
                let allowChange = true;

                if (neighbourhood.neighbourhood_type == 0) {
                    allowChange = false;
                    $('#ask').modal('show')
                    this.selectedNB = neighbourhood.id;
                }
                if (allowChange) {

                    axios.post('/ajax/changeNeighbourhood', {
                        id: this.$root.user.character.id,
                        neighbourhood_id: neighbourhood.id
                    })
                        .then(
                            res => {
                                if (res.data == 1)
                                    location.reload()

                            }
                        )
                        .catch(
                            error => {
                                console.log(error)
                            }
                        )
                }
            },
            interaction(ch) {
                this.interaction_character.name = ch.first_name + " " + ch.last_name;
                this.interaction_character.id = ch.id;
                $('#interaction-modal').modal('show')
            },
            doInteraction(action) {

                let isSteal = false;
                if (action.action_name.toLowerCase() == 'steal') {
                    isSteal = true;
                }
                if (!isSteal || (this.interaction_character.id != this.$root.user.character.id)) {
                    axios.post('/ajax/cityInteraction', {
                        created_by: this.$root.user.character.id,
                        action_to: this.interaction_character.id,
                        action: action.action_name,
                    }).then(res => {

                        if (isSteal) {
                            if (res.data == true) {
                                alert("Cash Stool successfully")
                            } else {
                                alert("Better luck next time")
                            }
                        } else
                            alert('done!');
                    }).catch(error => {
                        console.log(error)
                    })
                } else {
                    alert('You cannot steal from your onw pocket')
                }
            }

        }
    }
</script>
<style scoped>
    .property {
        color: #FFFFFF;
        width: 9rem;
        height: 9rem;
        padding: 1rem;
        background: grey;
        margin-left: 1rem;
        text-align: center;
    }


    .property:first-child {
        margin-left: auto;
    }

    .property:last-child {
        margin-right: auto;
    }

    .number {
        font-size: 3rem;
        color: #FFFFFF;
        line-height: 1;
    }

    .scale {
        font-size: 2rem;
    }

    .name {
        margin: 0;
        font-size: 1.3rem;
        color: #FFFFFF;
        line-height: 3;
        text-align: center;
    }
</style>
