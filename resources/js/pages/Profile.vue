<template>
    <section>


        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Information</a></li>
            <li class="nav-item"><a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="true">Comments</a></li>
            <li class="nav-item"><a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="true">Friends</a></li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="information" role="tabpanel">

                <form id="character-profile-form">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="text-center">{{CharacterName}} Profile</h2>

                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="/images/default-character.png" class="img" alt="">
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr>
                                            <th>Perso Name:</th>
                                            <td>{{CharacterName}}</td>
                                        </tr>
                                        <tr>
                                            <th>Joined the city:</th>
                                            <td>{{character.created_at}}</td>
                                        </tr>
                                        <tr>
                                            <th>Age:</th>
                                            <td>{{character.age}}</td>
                                        </tr>
                                        <tr>
                                            <th>Job:</th>

                                            <td v-if="isOwner()">
                                                <select class="form-select" name="job" v-model="character.job">
                                                    <option v-for="j in this.job_dropdown" :value="j.id" :selected="character.job == j.id ? true  : false">{{j.job_name}}</option>
                                                </select>
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.job_name"></td>
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
                                            <th>Cash in Pocket:</th>
                                            <td>{{character.cash}} MO</td>
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
                                            <th>Status:</th>
                                            <td v-if="isOwner()">
                                                <input type="text" name="user_status" class="form-control" v-model="character.user_status">
                                            </td>
                                            <!-- todo: slug to title -->
                                            <td v-else v-html="character.user_status"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div v-if="isOwner()">
                                <input type="hidden" name="id" v-model="character.id">
                                <div class="form-group text-right">
                                    <button type="button" class="genric-btn info-border" @click="saveProfile()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p id="rating">
                                <i class="fa-star" :class="star1"></i><i class="fa-star" :class="star2"></i><i class="far fa-star" :class="star3"></i><i class="far fa-star" :class="star4"></i><i class="far fa-star" :class="star5"></i>
                            </p>
                            <div v-if="!isOwner()" class="text-right">
                                <button type="button" class="genric-btn info-border" data-toggle="modal" data-target="#rating_modal">Add Rating</button>
                            </div>
                        </div>
                    </div>

                </form>
                <form id="character-about-form">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div v-if="isOwner()">
                                <div class="form-group">
                                    <textarea id="editor" name="profile">{{character.profile}}</textarea>
                                </div>
                                <input type="hidden" name="id" v-model="character.id">
                                <div class="form-group text-right">
                                    <button type="button" class="genric-btn info-border" @click="saveAbout()">Save</button>
                                </div>
                            </div>
                            <!-- todo: slug to title -->
                            <div v-else v-html="character.profile"></div>
                        </div>
                    </div>
                </form>

                <div class="card mb-4">
                    <div class="card-body">
                        <form id="character-hobbies-form">
                            <div class="form-group">
                                <h3>My Hobbies</h3>
                                <select class="select2 form-control" name="hobbies[]" multiple="multiple" :readonly="!isOwner() ? 'readonly' : ''">
                                    <option v-for="h in this.hobbies_dropdown" :selected="isInArray(character.hobbies,h.slug)" :value="h.slug">{{h.title}}</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" v-model="character.id">
                            <div class="form-group text-right" v-if="isOwner()">
                                <button type="button" class="genric-btn info-border" @click="saveHobbies()">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <section v-if="isOwner()">
                            <h3 class="text-center text-upper">My character information</h3>
                            <div class="row">
                                <div class="property" v-for="property in character.indications">
                                    <div><b class="number">{{property.points}}</b><span class="scale">pts</span></div>
                                    <p class="name">{{property.english_name}}</p>
                                </div>
                            </div>
                            <h3>Pocket</h3>
                            <div class="row">
                                <div class="col-3">
                                    <div class="action-box img-thumbnail">
                                        <img src="" alt="cash" class="img">
                                        <div>{{character.cash}} MO</div>
                                        <div>Credit Quantity {{credit_quanty}} </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="card mb-4" v-if="!isOwner() && visitor.job_name && ( visitor.job_name.includes('Practitioner') || visitor.job_name.includes('practitioner'))">
                    <div class="card-body">
                        <h3 class="text-center text-upper">{{ character.first_name }} {{ character.last_name}} Health Information</h3>
                        <section >
                            <div class="row">
                                <div class="card" v-for="disease in diseases">
                                    <div class="card-body">
                                        <h4>{{disease.name}}</h4>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section v-if="children_diseases.length">
                        <h3 class="text-center text-upper">{{ character.first_name }} {{ character.last_name}} Children Health Information</h3>
                            <div class="row">
                                <div class="card" v-for="disease in children_diseases">
                                    <div class="card-body">
                                        <h4>{{disease.name}}</h4>
                                        <p>{{disease.full_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="comments" role="tabpanel">

                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="text-center">{{CharacterName}} Profile</h2>
                        <div v-if="allowedComments.length">
                            <div class="card" v-for="comt in allowedComments">
                                <div class="card-header">
                                    <div class="row">

                                        <div class="col">From <a class="text-primary" :href="$root.profile_link(comt)">{{comt.from_name}}</a> on {{comt.created_at}}</div>
                                        <div class="col-2 _tool-bar text-right">
                                            <button class="genric-btn success circle small" @click="likeComment(comt)"><i class="fa fa-heart"></i></button>
                                            ({{comt.likes}})
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" v-html="comt.body"></div>
                            </div>

                        </div>
                        <div v-else>
                            <h4 class="text-center">No comment yet</h4>
                        </div>
                    </div>
                </div>
                <div v-if="!isOwner()">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="commentForm">
                                <textarea name="body" id="commentEditor" cols="30" rows="10"></textarea>
                                <input type="hidden" name="to" :value="character.id">
                                <div class="form-group text-right">
                                    <button type="button" class="genric-btn success circle" @click="saveComment()">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div v-else-if="notAllowedComments.length">
                    <div class="card" v-for="comment in notAllowedComments">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">From {{comment.from_name}} on {{comment.created_at}}</div>
                                <div class="col-2 text-right _tool-bar">
                                    <button class="genric-btn success circle small" @click="allowComment(comment)">
                                        <span class="fa fa-check-circle"></span></button>
                                    <button class="genric-btn danger circle small" @click="deleteComment(comment)">
                                        <span class="fa fa-trash"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" v-html="comment.body"></div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="text-center">{{CharacterName}} Profile</h2>

                        <div v-if="isOwner()">
                            You can find here the list of the 30th best visitors of your profile by using <b class="text-uppercase">20 diamonds</b>
                            <div class="text-right">
                                <button type="button" class="genric-btn success circle" @click="showLastVisitors()">
                                    SHOW ME
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-right" v-if="!isOwner()">
                            <button type="button" class="genric-btn success circle" @click="addFriend()">
                                + ADD FRIEND
                            </button>
                        </div>
                        <h4 class="text-center">--- FRIENDS LIST ---</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Added On</th>
                                <th>Full Name</th>
                                <th>Job</th>
                                <th v-if="isOwner()">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="friend in friends">
                                <td v-html="friend.added_on"></td>
                                <td><a :href="'/city/'+friend.prefix+'/'+friend.address" class="text-primary">{{friend.full_name}}</a></td>
                                <td>
                                    <router-link :to="$root.job_visitor_link(friend)" class="text-primary">{{friend.job_name}}</router-link>
                                </td>
                                <td v-if="isOwner()"><b class="text-danger pointer" @click="deleteFriend(friend)">DELETE</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <section v-if="isOwner()">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="text-center">--- COMMENT RECEIVED LIKES ---</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th>Sender</th>
                                </tr>
                                </thead>
                                <tbody v-if="likedBy">
                                <tr v-for="lb in likedBy">
                                    <td v-html="lb.created_at"></td>
                                    <td><a class="text-primary" :href="$root.profile_link(lb)">{{lb.full_name}}</a></td>
                                    <td v-html="lb.sender_name"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="text-center">--- PROFILE RATINGS ---</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th>Sender</th>
                                    <th>Rate</th>
                                </tr>
                                </thead>
                                <tbody v-if="ratedBy">
                                <tr v-for="rtb in ratedBy">
                                    <td v-html="rtb.created_at"></td>
                                    <td><a :href="$root.profile_link(rtb)" class="text-primary">{{rtb.full_name}}</a></td>
                                    <td v-html="rtb.sender_name"></td>
                                    <td v-html="rtb.rating"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <!-- Rating Modal -->
        <div class="modal fade" id="rating_modal" tabindex="-1" role="dialog" aria-labelledby="Rating Modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Rate Profile "{{userRated}}"</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="range" class="form-control" min="0" max="5" step=".1" v-model="userRated"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn warning radius small" data-dismiss="modal">Cancel</button>
                        <button type="button" data-dismiss="modal" @click="saveRating()" class="genric-btn primary radius small">Rate</button>
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
            user: {},
            character: {},
            visitor: {},
            diseases: [],
            children_diseases: [],
            gender_dropdown: [],
            family_situation_dropdown: [],
            mood_dropdown: [],
            role_dropdown: [],
            job_dropdown: [],
            hobbies_dropdown: [],
            comments: [],
            friends: [],
            likedBy: [],
            ratedBy: [],
            userRated: 0,
            credit_quanty:0,
        }),

        async mounted() {
            const {data} = await axios.post('/ajax/getCharacterProfile', {
                address: this.$route.params.address,
            });
            console.log("check data",data);
            this.user = data.user;
            this.$root.$data.user = data.user;
            this.character = data.character;
            this.visitor = data.visitor;
            this.diseases = data.diseases;
            this.children_diseases = data.children_diseases;
            this.gender_dropdown = data.gender_dropdown;
            this.family_situation_dropdown = data.family_situation_dropdown;
            this.mood_dropdown = data.mood_dropdown;
            this.role_dropdown = data.role_dropdown;
            this.hobbies_dropdown = data.hobbies_dropdown;
            this.job_dropdown = data.job_dropdown;
            this.comments = data.comments;
            this.friends = data.friends;
            this.likedBy = data.likedBy;
            this.ratedBy = data.ratedBy;
            console.log(data.credit_quantiy.quantity);
            this.credit_quanty = data.credit_quantiy.quantity;
            console.log("this.credit_quanty",this.credit_quanty);
            
            setTimeout(() => {
                $('#editor').summernote();
                $('#commentEditor').summernote();
                $('.select2').select2();
            }, 1000)

        },

        methods: {
            saveProfile() {
                let data = $('#character-profile-form').serialize();
                let self = this;
                axios.post('/ajax/updateCharacterProfile', data).then(res => {
                    self.$root.user = res.data.user
                    alert(res.data.msg)
                }).catch(error => {
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
            saveAbout() {
                let data = $('#character-about-form').serialize();
                let self = this;
                axios.post('/ajax/updateCharacterProfile', data).then(res => {
                    self.$root.user = res.data.user
                    alert(res.data.msg)
                }).catch(error => {
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
            saveHobbies() {
                let data = $('#character-hobbies-form').serialize();
                axios.post('/ajax/updateCharacterHobbies', data).then(res => {
                    alert(res.data.msg)
                }).catch(error => {
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
            isInArray: function (ar, key) {
                for (var i = 0; i < ar.length; i++) {
                    if (ar[i] == key) {
                        return true
                    }
                }
                return false
            },
            allowComment(comment) {
                axios.post('/ajax/allowComment', {
                    id: comment.id
                }).then(
                    comment.allow = 1
                ).catch()
            },
            deleteComment(comment) {
                axios.post('/ajax/deleteComment', {
                    id: comment.id
                }).then(
                    this.comments.splice(this.comments.indexOf(comment), 1)
                ).catch()
            },
            likeComment(comment) {

                axios.post('/ajax/likeComment', {
                    id: comment.id
                }).then(
                    res => {
                        if (res.data.status == 'ok') {
                            comment.likes++
                        } else {
                            alert(res.data.msg)
                        }

                    }
                ).catch()

            },

            saveRating() {

                axios.post('/ajax/addRating', {
                    id: this.character.id,
                    rating: this.userRated
                }).then(
                    res => {
                        if (res.data.status == 'ok') {
                            this.character.rating = res.data.rating
                        } else {
                            alert(res.data.msg)
                        }

                    }
                ).catch()

            },
            isOwner() {
                return this.user.id == this.character.user_id
            },
            saveComment() {
                let data = $('#commentForm').serialize();
                axios.post('/ajax/saveComment', data).then(
                    res => {
                        $('#commentForm').resetForm();
                        alert(res.data.msg);
                    }
                ).catch(
                    error => console.log(error)
                )
            },
            showLastVisitors() {
                let data = $('#commentForm').serialize();
                axios.post('/ajax/saveComment', data).then(
                    res => {
                        alert(res.data.msg);
                        $('#commentForm').resetForm();
                    }
                ).catch(
                    error => console.log(error)
                )
            },
            addFriend() {
                axios.post('/ajax/addFriend', {
                    id: this.character.id
                }).then(res => {
                    if (res.data.status == 'ok') {
                        this.friends = res.data.friends
                        alert("Friend added successfully")
                    } else {
                        alert(res.data.msg)
                    }
                }).catch(error => {
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
            deleteFriend(friend) {
                axios.post('/ajax/deleteFriend', {
                    id: friend.friend_id
                }).then(res => {
                    alert(res.data.msg)
                }).catch(error => {
                    alert("failed to save try later");
                    console.log(error.response)
                })
            },
        },

        computed: {
            CharacterName() {
                if (!this.character) {
                    return ''
                }
                return this.character.first_name + " " + this.character.last_name;
            },
            allowedComments() {
                let comments = this.comments;
                if (!comments) {
                    return comments;
                }
                const filter = comment =>
                    comment.allow == 1

                return comments.filter(filter)
            },
            notAllowedComments() {
                let comments = this.comments;
                if (!comments) {
                    return comments;
                }
                const filter = comment =>
                    comment.allow == 0

                return comments.filter(filter)
            },
            star1() {
                if (this.character.rating > 0 && this.character.rating < 1) {
                    // return 'fa fa-star-half'
                } else if (this.character.rating >= 1) {
                    return 'fa'
                }
                return 'far'
            },
            star2() {
                if (this.character.rating >= 2) {
                    return 'fa'
                }
                return 'far'
            },
            star3() {
                if (this.character.rating >= 3) {
                    return 'fa'
                }
                return 'far'
            },
            star4() {
                if (this.character.rating >= 4) {
                    return 'fa'
                }
                return 'far'
            },
            star5() {
                if (this.character.rating >= 5) {
                    return 'fa'
                }
                return 'far'
            },

        }
    }

</script>

<style scoped>
    table th {
        vertical-align: bottom;
    }

    #rating {
        font-size:  3rem;
        text-align: center;
        color:      gold;
    }

    .ck .ck-content {
        height: 20rem !important;
    }

    .ck.ck-editor__main > .ck-editor__editable * {
        color: #000000;
    }

    .property {
        color:       #FFFFFF;
        width:       11rem;
        height:      9rem;
        padding:     1rem;
        background:  grey;
        margin-left: 1rem;
        text-align:  center;
    }


    .property:first-child {
        margin-left: auto;
    }

    .property:last-child {
        margin-right: auto;
    }

    .number {
        font-size:   2.8rem;
        color:       #FFFFFF;
        line-height: 1;
    }

    .scale {
        font-size: 1.6rem;
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

    .action-box {
        height: 12rem;
    }

</style>
