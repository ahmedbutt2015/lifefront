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
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="action in actions">
                            <td>{{action.created_at}}</td>
                            <td v-if="action.status == 'gift'">Mogalys Admin</td>
                            <td>{{action.to_name}}</td>
                            <td>{{action.description}}</td>
                            <td v-if="action.status == 'gift'"> Send Gift</td>
                            
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
            const res = await axios.post('/ajax/getMyGift');
            this.user_actions = res.data;
            console.log("this.user_actions",this.user_actions);


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
