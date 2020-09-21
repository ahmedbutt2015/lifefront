<template>


    <section class="all-starups-area">

        <div class="container-fluid p-0">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="habitation-tab" data-toggle="tab" href="#habitation" role="tab" aria-controls="habitation" aria-selected="true">Habitation</a></li>
                <li class="nav-item"><a class="nav-link" id="housemate-tab" data-toggle="tab" href="#housemate" role="tab" aria-controls="housemate" aria-selected="true">Housemate</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">House Info</a></li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="habitation" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">
                            <div class="action-box img-thumbnail w-100">
                                <img src="" alt="house image" class="img">
                            </div>


                            <h4>Actions</h4>
                            <div class="row">
                                <div class="col">
                                    <div class="action-box img-thumbnail pointer" @click="do_urine()">
                                        <img src="/images/wc.png" alt="Urinate" class="img1">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail pointer" @click="do_poop()">
                                        <img src="/images/toilet-paper (1).png" alt="Poop" class="img1">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail pointer" @click="do_shower()">
                                        <img src="/images/baby-shower.png" alt="Shower" class="img1">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail pointer" @click="do_clean()">
                                        <img src="/images/bathroom.png" alt="Clean" class="img1">
                                    </div>
                                </div>
                            </div>

                            <h4>House</h4>
                            <div class="row">
                                <div class="col">
                                    <div class="action-box img-thumbnail">
                                        <img src="" alt="" class="img">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail">
                                        <img src="" alt="" class="img">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail">
                                        <img src="" alt="" class="img">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="action-box img-thumbnail">
                                        <img src="" alt="" class="img">
                                    </div>
                                </div>
                            </div>

                        </div><!--end container-->
                    </div>
                </div>
                <div class="tab-pane fade" id="housemate" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">
                            <p>You are the House Master! You can hire or fire any housemate at anytime. Watchout, they might be some laws regulating shared houses.</p>

                            <b>Requests: </b> xxxx has requested to live with you.
                            <div class="text-center mb-20">
                                <button type="button" class="genric-btn success-border">Accept</button>
                                <button type="button" class="genric-btn danger-border">Reject</button>
                            </div>


                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="/images/default-character.png" class="img" alt="">
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr>
                                            <th>Perso Name:</th>
                                            <td>---</td>
                                        </tr>
                                        <tr>
                                            <th>Joined the city:</th>
                                            <td>---</td>
                                        </tr>
                                        <tr>
                                            <th>Age:</th>
                                            <td>--</td>
                                        </tr>

                                        <tr>
                                            <th>Sexual Orientation:</th>
                                            <td v-if="isOwner()">
                                                <select class="form-select" name="gender" v-model="character.gender">
                                                    <option v-for="g in this.gender_dropdown" :value="g.slug" :selected="character.gender == g.slug ? true  : false">{{g.title}}</option>
                                                </select>
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.gender"></td>
                                        </tr>
                                        <tr>
                                            <th>Family Situation:</th>
                                            <td v-if="isOwner()">
                                                <select class="form-select" name="marriage_status" v-model="character.marriage_status">
                                                    <option v-for="f in this.family_situation_dropdown" :value="f.slug" :selected="character.marriage_status == f.slug ? true  : false">{{f.title}}</option>
                                                </select>
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.marriage_status"></td>
                                        </tr>
                                        <tr>
                                            <th>Pocket Amount:</th>
                                            <td>{{character.cash}}</td>
                                        </tr>
                                        <tr>
                                            <th>Music of the moment:</th>
                                            <td>Coming Soon</td>
                                        </tr>
                                        <tr>
                                            <th>Current Mood:</th>
                                            <td v-if="isOwner()">
                                                <select class="form-select" name="mood" v-model="character.mood">
                                                    <option v-for="m in this.mood_dropdown" :value="m.slug" :selected="character.mood == m.slug ? true  : false">{{m.title}}</option>
                                                </select>
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.mood"></td>
                                        </tr>
                                        <tr>
                                            <th>Role Play Player:</th>
                                            <td v-if="isOwner()">
                                                <select class="form-select" name="role" v-model="character.role">
                                                    <option v-for="r in this.role_dropdown" :value="r" :selected="character.role == r ? true  : false">{{r}}</option>
                                                </select>
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.role"></td>
                                        </tr>
                                        <tr>
                                            <th>Your Discord:</th>
                                            <td v-if="isOwner()">
                                                <input type="text" name="discord" class="form-control" value="xxx">
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.user_status"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="info" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">

                            <p>This Habitation is located in neighborhood : xxxxxxxx</p>
                            <p>This Habitation is owned by xxxxxxxx</p>
                            <p>This Habitation is rented by xxxxxxxx for xxx <span style="">MO</span> per day</p>
                            <p>This Habitation can welcome x adults</p>
                            <p>There is currently x people living in this habitation</p>


                            <div class="row mb-20">
                                <div class="property" v-for="indication in indications">
                                    <div><b class="number">{{indication.points}}</b><span class="scale">pts</span></div>
                                    <p class="name">{{indication.english_name}}</p>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Rentee Name</th>
                                    <th>Points</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            character: {},
            gender_dropdown: [],
            family_situation_dropdown: [],
            mood_dropdown: [],
            role_dropdown: [],
            job_dropdown: [],
            indications: [],
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getHabitationDetails');
            this.indications = data
        },

        methods: {
            isOwner() {
                return true;
            },
            do_urine() {
                axios.post('/ajax/homeDoUrine', {
                    ch_id: this.$root.user.character.id,
                }).then(res => {
                    alert("done!")
                }).catch(error => {
                    console.log(error)
                })
            },
            do_poop() {
                axios.post('/ajax/homeDoPoop', {
                    ch_id: this.$root.user.character.id,
                }).then(res => {
                    alert("done!")
                }).catch(error => {
                    console.log(error)
                })
            },
            do_shower() {
                axios.post('/ajax/homeDoShower', {
                    ch_id: this.$root.user.character.id,
                }).then(res => {
                    this.indications = res.data
                    alert("done!")
                }).catch(error => {
                    console.log(error)
                })
            },
            do_clean() {
                axios.post('/ajax/homeDoClean', {
                    ch_id: this.$root.user.character.id,
                }).then(res => {
                    this.indications = res.data
                    alert("done!")
                }).catch(error => {
                    console.log(error)
                })
            }
        },

        computed: {}
    }

</script>

<style scoped>
    .action-box {
        height: 12rem;
    }


    .property {
        color:       #FFFFFF;
        width:       9rem;
        height:      9rem;
        padding:     1rem;
        background:  grey;
        margin-left: 1rem;
    }


    .property:first-child {
        margin-left: auto;
    }

    .property:last-child {
        margin-right: auto;
    }

    .number {
        font-size:   4rem;
        color:       #FFFFFF;
        line-height: 1;
    }

    .scale {
        font-size: 2rem;
    }

    .name {
        margin:      0;
        font-size:   1.3rem;
        color:       #FFFFFF;
        line-height: 3;
        text-align:  center;
    }

    ._tool-bar button {
        text-align: center;
        padding:    2px 8px;
    }
    .img1{
        height: 11rem;
    }
</style>
