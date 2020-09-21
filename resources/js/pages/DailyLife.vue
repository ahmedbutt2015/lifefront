<template>
    <section>

        <!--Hero End -->
        <section class="all-starups-area">

            <div class="container-fluid bg-white">

                <div class="table-responsive">
                    <table class="table w-100" id="action_table">
                        <thead>
                        <tr>
                            <th>Date Time</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Details</th>
                            <th>Action/Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="action in actions">
                            <td>{{action.created_at}}</td>
                            <td v-if="action.status == 'gift'">Mogalys Admin</td>
                            <td v-else><router-link class="text-primary" :to="action.from_profile">{{action.from_name}}</router-link></td>
                            <td><router-link class="text-primary" :to="action.to_profile">{{action.to_name}}</router-link></td>
                            <td v-html="action.action"></td>
                            <td v-if="action.status == 'pending' && action.action_to == getCharacterID() && action.callback">
                                <button @click="acceptAction(action)" class="genric-btn success radius small" data-dismiss="modal">Accept</button>
                                <button @click="rejectAction(action)" class="genric-btn danger radius small" data-dismiss="modal">Reject</button>
                            </td>
                            <td v-else-if="action.status == 'gift'"> Send Gift</td>
                            <td v-else-if="action.action.includes('Marriage')" v-html="action.status"></td>
                            <td v-else>Character Interaction</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </section>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            user_actions: [],
        }),

        async mounted() {
            const res = await axios.post('/ajax/getActionHistory');
            this.user_actions = res.data;


            setTimeout(() => {
                $('#action_table').DataTable();
            }, 2000)

        },

        methods: {
            isOwner(){

            },
            getCharacterID(){
                return user.character.id
            },
            acceptAction(action){
                console.log("action.callback",action.callback);
                axios.post('/ajax/'+action.callback, {do: 'accept',id:action.id,created_by:action.created_by})
                    .then(res => {
                        action.status = res.data.status
                        alert(res.data.msg);
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            rejectAction(action){
                axios.post('/ajax/'+action.callback, {do: 'reject',id:action.id,created_by:action.created_by})
                    .then(res => {
                        action.status = res.data.status
                        alert(res.data.msg);
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        },

        computed: {
            actions() {
               return this.user_actions;
            },
            marriage() {
                return 'test';
            },
        }
    }

</script>

<style scoped>

</style>
