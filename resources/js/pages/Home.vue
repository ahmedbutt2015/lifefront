<template>
    <section class="all-starups-area">

        <div class="container-fluid p-0">

            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="rules-tab" data-toggle="tab" href="#rules" role="tab" aria-controls="home" aria-selected="true">Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{disabled :!dateAccepted }" id="character-tab" data-toggle="tab" href="#character" role="tab" aria-controls="profile" aria-selected="false">Character</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{disabled :!dateAccepted }" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="contact" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{disabled :!dateAccepted }" id="premium-tab" data-toggle="tab" href="#premium" role="tab" aria-controls="contact" aria-selected="false">Premium</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="rules" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">
                            <h4>Welcome {{user.username}}</h4>
                            <ol class="ordered-list text-white">
                                <li v-for="rule in rules" v-text="rule.rule"></li>
                            </ol>


                            <div class="lead" id="check-rules" style="margin-left: 30px">
                                <div v-if="user.rules_accepted_at">
                                    Rules accepted on {{user.rules_accepted_at}}
                                </div>

                                <div v-else>I have read the rules
                                    <button class="genric-btn primary-border small" @click="acceptRules()">I accept the rules</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="character" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">
                            <div class="row">
                                <div v-if="user.character && user.character.status === 'live'">
                                    <router-link :to="link" class="box-link">
                                        <div class="character-box">
                                            <div class="name">
                                                <div>{{user.character.first_name }}</div>
                                                <div>{{ user.character.last_name}}</div>
                                            </div>
                                            <div class="status">{{user.character.status}}</div>
                                        </div>
                                    </router-link>
                                    <div class="mt-5">
                                        <button class="genric-btn danger-border circle small" @click="deleteCharacter()">Delete</button>
                                    </div>
                                </div>
                                <div v-else-if="user.character && user.character.status === 'dead'">
                                    <div class="character-box">
                                        <div class="rip">
                                            R.I.P
                                        </div>
                                        <div class="status">
                                            Passed Away
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button class="genric-btn info-border circle small" @click="reviveCharacter()">Revive {cost}</button>
                                        <button class="genric-btn danger-border circle small" @click="deleteCharacter()">Delete</button>
                                    </div>
                                </div>

                                <div class="character-box" v-else="user.character">
                                    <router-link to="create-character" class="text-dark">Create New Character</router-link>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">

                            <div class="col-lg-2 col-md-3 col-8 mb-20">
                                <img v-bind:src="profile" alt="images" class="img-thumbnail">
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <form id="profile-form" enctype="multipart/form-data">
                                        <h4>Profile</h4>
                                        <div class="form-group">
                                            <!--                                            <label for="username">Username</label>-->
                                            <input type="text" class="form-control" id="username" name="username" v-model="updateUser.username">
                                        </div>

                                        <div class="form-group">
                                            <!--                                            <label for="email">Email</label>-->
                                            <input type="text" class="form-control" id="email" name="email" v-model="updateUser.email">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="button" class="genric-btn info-border circle small" @click="profile_update">Update</button>
                                            <button type="button" class="genric-btn danger-border circle small" @click="profile_remove">Remove Profile</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <h4>Change Password</h4>
                                    <div class="form-group">
                                        <input type="password" class="form-control" v-model="updatePassword.old" placeholder="Current Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" v-model="updatePassword.new" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" v-model="updatePassword.confirm" placeholder="Confirm Password">
                                    </div>
                                    <div>
                                        <button class="genric-btn info-border circle small" :class="{disable :!canUpdatePassword}" @click="password_update">Change</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-sm-12">
                                    <h4>Notifications</h4>
                                    <div class="form-group form-row">
                                        <div style="line-height:0.8;">I allow Mogalys to send me updates :</div>
                                        <input type="checkbox" class="form-check" :checked="isCheckedUpdates" @change="saveNotify($event,'notify_updates')">

                                    </div>
                                    <div class="form-group form-row">
                                        <div style="line-height:0.8;">I allow Mogalys to send me newsletters :</div>
                                        <input type="checkbox" class="form-check" :checked="isCheckedNewLetter" @change="saveNotify($event,'notify_new_letter')">
                                    </div>
                                    <div class="form-group form-row">
                                        <div style="line-height:0.8;">I allow Mogalys to send me Job Opportunities :</div>
                                        <input type="checkbox" class="form-check" :checked="isCheckedOpportunity" @change="saveNotify($event,'notify_opportunity')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="premium" role="tabpanel">
                    <div class="sample-text-area">
                        <div class="container-fluid">
                            <div class="card mb-3">
                                <div class="card-body text-center">

                                    <p>You currently have {{user.diamonds}} diamonds.
                                        <small>Get more Diamonds
                                            <a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#buy-diamonds">here</a>
                                        </small></p>
                                    <p>Your are not subscribed to any plan.</p>


                                </div>
                            </div>

                            <!-- todo: Add plans etc for subscribe -->
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h4>PLAN 1</h4>
                                            <h3>$5 <small>/ month</small></h3>
                                        </div>
                                        <div class="card-body">
                                            details soon
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h4>PLAN 2</h4>
                                            <h3>$25 <small>/ 6 months</small></h3>
                                        </div>
                                        <div class="card-body">
                                            details soon
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h4>PLAN 3</h4>
                                            <h3>$50 <small>/ year</small></h3>
                                        </div>
                                        <div class="card-body">
                                            details soon
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!--  Buy Diamonds Model -->
        <div class="modal" tabindex="-1" id="buy-diamonds" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buy Diamonds</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Buy 100 diamonds</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="buy()" class="genric-btn circle primary medium"
                            data-dismiss="modal">Buy
                        </button>
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
            rules: {},
            user: {
                username: ''
            },
            updateUser: {},
            updatePassword: {
                old: '',
                new: '',
                confirm: '',
            },
            notifications: [],
        }),

        async mounted() {
            const res = await axios.post('/ajax/getUser');
            this.user = res.data;
            this.updateUser = this.user;
            const {data} = await axios.post('/ajax/getRules');
            this.rules = data;
            const n_data = await axios.post('/ajax/getNotifications');
            this.notifications = n_data.data;
        },

        methods: {
            acceptRules() {
                axios.post('/ajax/acceptRules')
                    .then(res => {
                        $("#check-rules").html("Rules accepted on " + res.data);
                        this.user.rules_accepted_at = res.data;
                    })
                    .catch(error => {
                        console.log(error.response)
                    })

            },
            password_update() {
                axios.post('/ajax/updatePassword', {
                    'email': this.user.email,
                    'old': this.updatePassword.old,
                    'new': this.updatePassword.new,
                    'confirm': this.updatePassword.confirm,
                })
                    .then(res => {
                        let data = res.data
                        if (data.status) {
                            this.updatePassword.old = '';
                            this.updatePassword.new = '';
                            this.updatePassword.confirm = '';
                        }
                        alert(data.msg);
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            profile_update() {
                let self = this;
                let formData = new FormData($("#profile-form")[0]);
                axios.post('/ajax/updateProfile', formData)
                    .then(res => {
                        let data = res.data;
                        this.user = data.user;
                        self.$root.user = data.user;
                        $("#profile-form").resetForm();
                        alert(data.msg);
                    })
                    .catch(error => {

                        if (error.response.data.errors) {
                            let msg = "";
                            console.log(error.response.data.errors);

                            this.alertErrors(error.response.data.errors)

                        }
                    })
            },
            profile_remove() {
                axios.post('/ajax/removeProfile')
                    .then(res => {
                        let data = res.data;
                        this.user.image = null;
                        alert(data.msg);
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            saveNotify($event, column) {
                const checked = $event.target.checked
                let self = this;
                axios.post('/ajax/notificationCharacter', {
                    ch_id: this.$root.user.character.id,
                    value: checked,
                    column: column,
                })
                    .then(res => {
                        self.$root.user.character.notification_on = checked;
                        // alert("Character deleted Successfully");
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            deleteCharacter() {
                if (confirm("Are you sure, you want to delete ?")) {
                    axios.post('/ajax/deleteCharacter')
                        .then(res => {
                            this.user.character = null;
                            alert("Character deleted Successfully");
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                }
            },
            reviveCharacter() {
                if (confirm("Are you sure, you want to revive it will cost {cost} ?")) {
                    axios.post('/ajax/reviveCharacter')
                        .then(res => {
                            let data = res.data;
                            console.log(res);
                            console.log(data);

                            this.user = data;
                            alert("Character Revived Successfully");
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                }
            },
            alertErrors(errors) {
                let msg = "";

                let er = Object.keys(errors).map(function (key) {
                    return errors[key][0];
                });

                er.forEach(function (item, index) {
                    msg += item + " ";
                })
                alert(msg);
            },
            notificationMarkRead(row) {

                axios.post('/ajax/markNotificationRead', {
                    id: row.id
                })
                    .then(res => {
                        this.notifications = res.data;
                    })
                    .catch(error => {
                        console.log(error.response)
                    })


                // this.notifications.splice(this.notifications.indexOf(row), 1);
            },
            buy() {
                axios.post('/ajax/buyDiamonds', {})
                .then(res => {
                    this.user = res.data
                    alert('brought');
                }).catch(error => {
                    console.log(error.response)
                })
            }
        },

        computed: {
            dateAccepted() {
                if (this.user && this.user.rules_accepted_at) {
                    return true;
                }
                return false;
            },
            canUpdatePassword() {
                let pas = this.updatePassword;
                if (pas.old != '' && pas.new != '' && pas.confirm != '' && pas.new == pas.confirm) {
                    return true;
                }
                return false;
            },
            profile() {
                if (!this.user || this.user.pic == null || this.user.pic == '') {
                    return '/images/user-default.png'
                }
                return "/" + this.user.pic;
            },
            link() {
                if (this.user.character) {
                    let ch = this.user.character
                    return "/city/" + ch.prefix + "/" + ch.address;
                }
                return "";
            },
            isCheckedUpdates() {
                if (this.$root.user.character) {
                    return this.$root.user.character.notify_update
                }
                return false
            },
            isCheckedNewLetter() {
                if (this.$root.user.character) {
                    return this.$root.user.character.notify_new_letter
                }
                return false
            },
            isCheckedOpportunity() {
                if (this.$root.user.character) {
                    return this.$root.user.character.notify_opportunity
                }
                return false
            }
        }
    }

</script>

<style scoped>
    #myTab .nav-link, .box-link {
        color: #635C5C !important;
    }

    .character-box {
        font-size:      1.7rem;
        padding:        2rem 1rem;
        width:          15rem;
        height:         11rem;
        border:         2px solid #17A2B8 !important;
        text-align:     justify;
        text-transform: uppercase;
        position:       relative;
        margin-right:   1rem;
    }

    .character-box .rip {
        font-size:  2.2rem;
        text-align: center;
    }

    .character-box .status {
        font-size:  1.3rem;
        position:   absolute;
        bottom:     -2rem;
        width:      100%;
        text-align: center;
        left:       0;
    }

    small {
        font-size: .8rem;
    }

</style>
